<?php


namespace app\api2\model;


class UserController extends CommonController
{
    public function initialize()
    {
        parent::initialize();
        $this->pk = 'id';
        $this->name = 'user';
        $this->table = config('database.prefix') . $this->name;
    }

    public function userLists($where = '', $limit = 1, $order = '', $field = '', $whereOr = '')
    {
        $data = $this->getLists($where, $limit, $order, $field, $whereOr);
        $list = $data['list'];
        if (is_array($list)){
            foreach ($list as $key=>$val){
                if (!empty($val['create_time'])) {
                    $list[$key]['create_time'] = date('Y-m-d H:i:s',$val['create_time']);
                }
                if (!empty($val['update_time'])) {
                    $list[$key]['update_time'] = date('Y-m-d H:i:s',$val['update_time']);
                }
            }
        }
        $data['list'] = $list;
        return $data;
    }

    public function userAccount()
    {
        $account = $this->order('account desc')->value('account');
        if (empty($account)) return 10000;
        return $account + 1;
    }

    // 获取用户token
    public function getWxAuth($code)
    {
        if (!empty($code)){
            $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=wx87d93d9ca8a459f6&secret=8c893df3074798645d1cdb7928259271&js_code=' . $code . '&grant_type=authorization_code';
            $data = file_get_contents($url);
            $json_data = json_decode($data, true);
            if (empty($json_data['openid'])){
                return false;
            }
            return $json_data;
        }
        return false;
    }

    // 验证微信授权手机号
    public function verifyWxMobile($param = [])
    {
        if (!empty($param['encryptedData']) && !empty($param['iv'])){
            if (empty($param['session_key'])) return false;
            require './extend/wx/wxBizDataCrypt.php';
            $pc = new \WXBizDataCrypt('wx87d93d9ca8a459f6', $param['session_key']);
            $errCode = $pc->decryptData($param['encryptedData'], $param['iv'], $data);
            if ($errCode == 0) {
                return $data;
            }
        }
        return false;
    }

    // 用户注册
    public function memberRegister($param = [])
    {
        if (!empty($param['mobile'])){
            if ($this->exists(['mobile'=>$param['mobile']])){
                $this->error = '该账户已经注册';
                // $this->error = 'The account has been registered';
                return false;
            }
        }
        if (!empty($param['openid'])){
            if ($this->exists(['openid'=>$param['openid']])){
                $this->error = '该账户已经注册';
                // $this->error = 'The account has been registered';
                return false;
            }
        }
        // 其他操作如发生短信，增加信息
        $param['account'] = $this->memberAccount();
        if (!empty($param['mobile'])){
            $param['nickname'] = 'eGo' . sub_str($param['mobile'], 7, 4);
        }
        if (empty($param['face'])){
            $param['face'] = 'default.png';
        }
        if (empty($param['create_ip'])){
            $param['create_ip'] = get_client_ip();
        }
        if (empty($param['create_time'])){
            $param['create_time'] = NEW_TIME;
        }
        $member_id = $this->insert($param, false, true);
        if (empty($member_id)){
            return false;
        }
        // 写入账户信息
        $member_balance = new MemberBalance();
        $member_balance->insert(['member_id'=>$member_id]);
        // 获取赠送优惠券信息
        $coupon_model = new Coupon();
        $coupon_model->fields = 'coupon_id,type,type_id,name,describe,picture,sell_type,money,price,sell_price,total,area_id';
        $coupon_list = $coupon_model->couponList(['is_open'=>1,'sell_type'=>3]);
        $coupon_data = [];
        if (!empty($coupon_list)){
            if (is_array($coupon_list)){
                foreach ($coupon_list as $key=>$val){
                    $val['order_code'] = order_code();
                    $val['create_time'] = NEW_TIME;
                    $val['member_id'] = $member_id;
                    $coupon_data[] = $val;
                }
            }
        }
        if (!empty($coupon_data)){
            $member_coupon = new MemberCoupon();
            $member_coupon->couponOperation($coupon_data, false, true);
        }

        return true;
    }

    // 用户登录
    public function memberLogin($param = [], $out = false, $is_update = true)
    {
        $this->fields = 'member_id,account,email,password,mobile,nickname,name,card,face,token,is_account,is_partner,state';
        if (empty($param['member_id'])){
            if (is_mobile($param['account'])){
                $member_data = $this->memberFind(['mobile'=>$param['account']]);
            }else{
                $member_data = $this->memberFind(['email'=>$param['account']]);
            }
        }else{
            $member_data = $this->memberFind($param['member_id']);
        }
        if (empty($member_data)){
            $this->error = '该账户尚未注册';
            // $this->error = 'The account has not been registered';
            return false;
        }
        if ($member_data['state'] == 2){
            $this->error = '该账户已被锁定';
            // $this->error = 'Your account is locked';
            return false;
        }
        if ($member_data['state'] == 3){
            $this->error = '该账户已被冻结';
            // $this->error = 'Your account is freeze';
            return false;
        }
        $token = '';
        if (!empty($param['device_number'])){
            $token = md5(base64_encode($param['device_number'] . $member_data['account']));
            // 是否有多台设备同时登录
            if (!empty($member_data['token']) && $member_data['token'] != $token){
                if ($out){
                    $this->error = '您的帐户已登录到其他设备上，您被迫下线';
                    // $this->error = 'Your account is freeze';
                    return false;
                }
                // 发送推送信息
                $extras = [
                    'type'=>'login_out',
                    'contents'=>'您的帐户已登录到其他设备上，您被迫下线',
                    'ids'=>$member_data['token']
                ];
                $setting_model = new Setting();
                $setting_model->ruleExec('温馨提示', $member_data['token'], $extras);
            }
        }
        $member_data['token'] = $token;
        $save_data['member_id'] = $member_data['member_id'];
        if (!empty($token)){
            $save_data['token'] = $token;
        }
        if ($is_update){
            // set member token
            $member_token = new MemberToken();
            $token = $member_token->getToken($member_data['account'], $member_data['member_id']);
            $member_data['member_token'] = $token;
            $save_data['member_token'] = $token;
            $save_data['last_ip'] = get_client_ip();
            $save_data['last_time'] = NEW_TIME;
            $this->isUpdate(true)->memberOperation($save_data, false);
        }else{
            // set member token
            $member_token = new MemberToken();
            $token = $member_token->getToken($member_data['account'], $member_data['member_id'], true);
            $member_data['member_token'] = $token;
        }
        // hide card and name
        if (!empty($member_data['name']) && !empty($member_data['card'])){
            $member_data['name'] = substr_cut($member_data['name']);
            $member_data['card'] = str_encrypt($member_data['card'], 0, mb_strlen($member_data['card'])-1);
        }
        // hide mobile
        if (!empty($member_data['mobile'])){
            $member_data['mobile'] = hide_tel($member_data['mobile']);
        }
        // Obtain deposit information
        $balance_model = new MemberBalance();
        $deposit = $balance_model->balanceField(['member_id'=>$member_data['member_id']], 'deposit');
        // $member_data['is_deposit'] = floatval($deposit) == 0 ? 0 : 1;
        $member_data['is_deposit'] = 1;
        if ($member_data['is_account'] == 1){
            $member_data['is_deposit'] = 1;
        }
        // Obtain authentication information
        $member_card = new MemberCard();
        $count = $member_card->where('member_id', $member_data['member_id'])->count();
        $member_data['is_bank_card'] = $count; // Whether there is bound bank card
        // get server tel
        $site_model = new Setting();
        $site = $site_model->settingFind('site');
        $member_data['remark'] = '工作时间: 早上八点到凌晨两点（8:00-02:00）。如有紧急情况可以拨打客服电话。';
        $member_data['join_tel'] = $site['join_tel'];
        $member_data['service_tel'] = $site['service_tel'];

        return $member_data;
    }

    // 账户检测
    public function issetAccount($member_id, $vehicle_id)
    {
        if (empty($member_id)){
            $this->error = 'member_info';
            return ['state'=>0];
        }
        if (empty($vehicle_id)){
            $this->error = 'vehicle_info';
            return ['state'=>0];
        }
        // 查询账户是否有违章
        $violation_model = new Violation();
        if ($violation_model->exists(['member_id'=>$member_id, 'state'=>['in', '0,1,2']])){
            $this->error = 'You have violation of regulations and have not been dealt with, please deal with it in time';
            return ['state'=>3];
        }
        // 查询账户是否认证
        $setting_model = new Setting();
        $setting_data = $setting_model->settingFind('basic');
        $member_data = $this->memberFind($member_id, 'is_account,card,zhima_credit,state');
        if (empty($member_data)){
            $this->error = 'member_info';
            return ['state'=>0];
        }
        if ($member_data['is_account'] != 1){
            if ($member_data['state'] == 1){
                $this->error = 'member_blocked';
                return ['state'=>0];
            }
            if ($member_data['state'] == 2){
                $this->error = 'member_locked';
                return ['state'=>0];
            }
            if ($member_data['state'] == 3){
                $this->error = 'member_freeze';
                return ['state'=>0];
            }
            if (empty($member_data['card'])){
                $this->error = 'member_auth';
                return ['state'=>1];
            }else{
                // 获取允许骑行年龄段
                if (!empty($setting_data['min_age']) && !empty($setting_data['max_age'])){
                    if (floatval($setting_data['min_age']) > 0 && floatval($setting_data['max_age']) > floatval($setting_data['min_age'])){
                        // 获取身份证年龄
                        import('card.card');
                        $card = new \card();
                        $age = $card->get_age($member_data['card']);
                        if (floatval($setting_data['min_age']) > $age || floatval($setting_data['max_age']) < $age){
                            $this->error = '允许用车年龄' . floatval($setting_data['min_age']) . '-' . floatval($setting_data['max_age']) . '周岁';
                            return ['state'=>0];
                        }
                    }
                }
            }
            // 获取设备所属区域和设备类型
            $vehicle_model = new Vehicle();
            $vehicle_data = $vehicle_model->vehicleFind($vehicle_id, 'vehicle_id,area_id,type_id');
            // 获取区域是否设置押金
            $billing_setting = new BillingSetting();
            $billing_data = $billing_setting->settingFind(['type_id'=>$vehicle_data['type_id'],'area_id'=>$vehicle_data['area_id']]);
            if (!empty($billing_data) && floatval($billing_data['deposit']) > 0){
                $deposit_where['area_id'] = $vehicle_data['area_id'];
                $deposit_where['type_id'] = $vehicle_data['type_id'];
            }else{
                // 获取系统默认押金设置
                $billing_data = $billing_setting->settingFind(['type_id'=>$vehicle_data['type_id'],'area_id'=>0]);
                // 获取系统设置
                $deposit_where['area_id'] = 0;
                $deposit_where['type_id'] = $vehicle_data['type_id'];
            }
            // 获取是否要交押金
            if (floatval($billing_data['deposit']) > 0){
                // 判断用户芝麻信用是否足够
                if (floatval($member_data['zhima_credit']) < floatval($setting_data['zhima_credit'])){
                    // 获取用户押金是否交了押金
                    $deposit_where['member_id'] = $member_id;
                    $member_deposit = new MemberDeposit();
                    $deposit_data = $member_deposit->depositFind($deposit_where);
                    if (!empty($deposit_data['deposit'])){
                        if (floatval($deposit_data['deposit']) >= floatval($billing_data['deposit']) || floatval($deposit_data['freeze_deposit']) >= floatval($billing_data['deposit'])){
                            return [];
                        }
                    }
                    // 获取用户是否有免押金优惠券
                    $member_coupon = new MemberCoupon();
                    // 1满减券，2现金券，3折扣券，4免押金券，5免费骑行
                    $coupon_where['type'] = 4;
                    $coupon_where['member_id'] = $member_id;
                    $coupon_where['type_id'] = $vehicle_data['type_id'];
                    // $coupon_where['area_id'] = $vehicle_data['area_id'];
                    if (!$member_coupon->validCoupon($coupon_where)){
                        $this->error = 'member_deposit';
                        return ['state'=>2,'setting_id'=>$billing_data['setting_id'],'deposit'=>$billing_data['deposit']];
                    }
                }
            }
        }
        return [];
    }

    // 查看账户信息
    public function showMember($member_id)
    {
        $member_data = $this->getFind($member_id);
        if (empty($member_data)) return [];
        $member_data['create_time'] = date('Y-m-d H:i:s', $member_data['create_time']);
        // 获取钱包信息
        $member_balance = new MemberBalance();
        $member_balance->fields =  'balance_id,balance,deposit,platform_balance';
        $balance_data = $member_balance->balanceFind(['member_id'=>$member_id]);
        // 获取押金信息
        $member_deposit = new MemberDeposit();
        $deposit = $member_deposit->where('member_id', $member_data['member_id'])->sum('deposit');
        $member_data['balance'] = $balance_data['balance'];
        $member_data['deposit'] = empty($deposit) ? 0.00 : floatval($deposit);
        // 获取骑行次数
        $order_model = new Order();
        $order_count = $order_model->where('member_id', $member_data['member_id'])->count();
        $member_data['order_count'] = intval($order_count);
        // 获取违章次数
        $violation_model = new Violation();
        $violation_count = $violation_model->where('member_id', $member_data['member_id'])->count();
        $member_data['violation_count'] = intval($violation_count);

        return $member_data;
    }

}