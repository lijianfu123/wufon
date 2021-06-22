<?php

namespace app\common\service;

use think\facade\Cache;
use think\facade\Cookie;
use app\common\logic\UserLogic;

/**
 * 微信 - Service
 * Class WechatService
 * @package app\common\service
 */
class WechatService extends BaseService
{
    private $get;
    private $UserLogic;
    private $CookieService; //cookie
    private $ImageService; //图片类
    private $rand_code = ''; //随机字符串
    private $current_time = 0; //当前时间
    private $expires_time = 3600; //超时 时长（1个小时，微信官方为：2小时）
    private $wechat_name, $wechat_app_id, $wechat_app_secret, $wechat_token, $wechat_pay_id, $wechat_pay_key, $wechat_logo;

    /**
     * 构造方法
     */
    public function __construct()
    {
        parent::__construct();

        $this->get = $this->request->get();

        $this->current_time = time();
        $this->ImageService = new ImageService();
        $this->UserLogic = new UserLogic();
        $this->rand_code = get_rand_code();
        $this->CookieService = new CookieService();

        $this->wechat_name = $config['wechat_name'];
        $this->wechat_app_id = $config['wechat_app_id'];
        $this->wechat_app_secret = $config['wechat_app_secret'];
        $this->wechat_token = $config['wechat_token'];
        $this->wechat_pay_id = $config['wechat_pay_id'];
        $this->wechat_pay_key = $config['wechat_pay_key'];
        //$this->wechat_logo = $config['wechat_logo'];
    }

    /**
     * 验证 微信加密签名
     */
    public function valid()
    {
        $echo_str = $this->request['echostr']; //微信随机字符串
        $signature = $this->request['signature']; //微信加密签名
        $timestamp = $this->request['timestamp']; //时间戳
        $nonce = $this->request['nonce']; //随机数
        $arr = [$this->wechat_token, $timestamp, $nonce];

        sort($arr, SORT_STRING); //进行字典序排序
        $str = sha1(implode($arr));

        //sha1加密后与签名对比
        if ($str == $signature) {
            echo $echo_str;
        }
    }

    /**
     * 被动发送消息
     */
    public function response_message()
    {
        $post_str = file_get_contents('php://input');
        if ($post_str != '') {
            //libxml_disable_entity_loader(true); //部分服务器不支持该权限，请联系空间商请开启

            $post_object = simplexml_load_string($post_str, 'SimpleXMLElement', LIBXML_NOCDATA);
            switch (trim($post_object->MsgType)) {
                case ('event'): //事件
                    $this->receive_event($post_object);

                    break;
                case ('text'): //文本
                    $this->receive_text($post_object);

                    break;
                case ('image'): //图片
                    $this->receive_image($post_object);

                    break;
                case ('voice'): //语音
                    $this->receive_voice($post_object);

                    break;
                case ('video'): //视频
                    $this->receive_video($post_object);

                    break;
                case ('location'): //位置
                    $this->receive_location($post_object);

                    break;
                case ('link'): //链接
                    $this->receive_link($post_object);

                    break;
                default:

                    break;
            }
        }
    }

    /**
     * 主动推送消息
     * @param $wechat_openid
     * @param $content
     * @return mixed
     */
    public function send_message($wechat_openid, $content)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=" . $this->get_access_token();

        $arr['msgtype'] = 'text';
        $arr['touser'] = $wechat_openid;
        $arr['text']['content'] = $content;

        $json = json($arr);

        return https_request($url, $json);
    }

    /**
     * 接收文本
     * @param $object
     */
    private function receive_text($object)
    {
        $content = '';

        switch ($object->Content) {
            case (1):
                //$content = '文本：' . $object->Content;

                break;
            case (2):
//                $content[] = [
//                    'Title' => '单图文标题',
//                    'Description' => '单图文内容',
//                    'PicUrl' => 'http://discuz.comli.com/weixin/weather/icon/cartoon.jpg',
//                    'Url' => 'http://m.cnblogs.com/?u=txw1958'
//                ];

                break;
            case (3):
//                $content[] = [
//                    'Title' => '多图文标题_1',
//                    'Description' => '',
//                    'PicUrl' => 'http://discuz.comli.com/weixin/weather/icon/cartoon.jpg',
//                    'Url' => 'http://m.cnblogs.com/?u=txw1958'
//                ];
//
//                $content[] = [
//                    'Title' => '多图文标题_2',
//                    'Description' => '',
//                    'PicUrl' => 'http://d.hiphotos.bdimg.com/wisegame/pic/item/f3529822720e0cf3ac9f1ada0846f21fbe09aaa3.jpg',
//                    'Url' => 'http://m.cnblogs.com/?u=txw1958'
//                ];

                break;
            default:
                //$content = '您输入的内容是：' . $object->Content;

                break;
        }

        if (is_array($content)) {
            if (isset($content[0]['PicUrl'])) {
                $result = $this->transmit_news($object, $content);
            } else if (isset($content['MusicUrl'])) {
                $result = $this->transmitMusic($object, $content);
            }
        } else {
            $result = $this->transmit_text($object, $content);
        }
    }

    /**
     * 接收图片
     * @param $object
     */
    private function receive_image($object)
    {

    }

    /**
     * 接收音频
     * @param $object
     */
    private function receive_voice($object)
    {

    }

    /**
     * 接收视频
     * @param $object
     */
    private function receive_video($object)
    {

    }

    /**
     * 接收位置
     * @param $object
     */
    private function receive_location($object)
    {

    }

    /**
     * 接收链接
     * @param $object
     */
    private function receive_link($object)
    {

    }

    /**
     * 接收事件
     * @param $object
     */
    private function receive_event($object)
    {
        $content = '';

        switch ($object->Event) {
            case ('scancode_waitmsg'): //扫码带提醒
                $wechat_openid = (string)$object->FromUserName;
                $content = "扫码带提示：类型 " . $object->ScanCodeInfo->ScanType . " wechat_openid:" . $wechat_openid . " 结果：" . $object->ScanCodeInfo->ScanResult;

                break;
            case ('scancode_push'): //扫码推事件
                $content = '扫码推事件';

                break;
            case ('SCAN'): //场景
                $ticket = (int)$object->EventKey;
                //$this->auto_add_user($object, $ticket);

                break;
            case ('subscribe'): //关注
                $ticket = $object->EventKey;
                if ($ticket == '') {
                    $ticket = 0;
                } else {
                    $ticket = str_replace('qrscene_', '', $ticket);
                }

                //$this->auto_add_user($object, $ticket);

                break;
            case ('unsubscribe'): //取消关注
                $content = '取消关注';

                break;
            case ('VIEW'): //点击菜单 跳转到页面
                $content = "跳转链接 " . $object->EventKey;

                break;
            case ('CLICK'): //点击菜单，公众号首页显示的 数据
                switch ($object->EventKey) {
                    case('key_3_1'):
                        $content = '消费成股东，股东消费有优惠';

                        break;
                    case('key_3_2'):
                        $content = '邯山街与贸易街口东南角二楼';

                        break;
                }

                break;
            default:

                break;
        }

        if ($content != '') {
            $this->transmit_text($object, $content);
        }
    }

    /**
     * 会员关注 自动入库
     * @param $object
     * @param int $ticket
     * @return mixed
     * @throws \think\exception\PDOException
     */
    private function auto_add_user($object, $ticket = 0)
    {
        if (is_array($object)) {
            $data = $object;
        } else {
            if (is_object($object)) {
                $data = $this->get_wechat_info((string)$object->FromUserName);
            } else {
                $data = $this->get_wechat_info($object);
            }
        }

        $data['commend_user_id_1'] = $ticket;

        //会员注册
        //if ($data['wechat_openid'] !== '') {
        //$user_id = (new UserLogic())->save_register($data);
        //if ($user_id > 0) {
        //给推荐人发送消息
        //}
        //}
    }

    /**
     * 回复消息
     * @param $object
     * @param $content
     * @param int $flag
     */
    private function transmit_text($object, $content, $flag = 0)
    {
        $xmlTpl = '
            <xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                <FuncFlag>%d</FuncFlag>
            </xml>
        ';

        if ($content != '') {
            $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, $this->current_time, $content, $flag);

            echo $result;
        }
    }

    /**
     * 回复图文消息
     * @param $object
     * @param $newsArray
     */
    private function transmit_news($object, $newsArray)
    {
        if (!is_array($newsArray)) {
            return;
        }

        $itemTpl = '
            <item>
                <Title><![CDATA[%s]]></Title>
                <Description><![CDATA[%s]]></Description>
                <PicUrl><![CDATA[%s]]></PicUrl>
                <Url><![CDATA[%s]]></Url>
            </item>
        ';

        $item_str = '';

        foreach ($newsArray as $item) {
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }

        $xmlTpl = "
            <xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>%s</ArticleCount>
                <Articles>$item_str</Articles>
            </xml>
        ";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, $this->current_time, count($newsArray));

        echo $result;
    }

    /**
     * 获取微信远程多媒体文件
     * @param $media_id
     * @return bool|string
     */
    public function get_media_file($media_id)
    {
        $access_token = $this->get_access_token();

        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$media_id";

        //文件保存地址
        $headers = get_headers($url, 1);
        $file_name = substr($headers['Content-disposition'], strpos($headers['Content-disposition'], '"') + 1, -1);
        $file_path = "./upload/wechat_media/$file_name";

        //获取图片
        $img = https_request($url);
        $file = fopen($file_path, 'w');
        fwrite($file, $img);
        fclose($file);

        return substr($file_path, 1);
    }

    /**
     * 获取场景图片
     * @param $id
     * @return string
     */
    public function get_user_ticket($id)
    {
        $access_token = $this->get_access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$access_token";

        $arr = [
            'action_name' => 'QR_LIMIT_SCENE',
            'action_info' => [
                'scene' => [
                    'scene_id' => $id
                ]
            ]
        ];

        $json = json($arr);

        $result = https_request($url, $json);
        $result = json_decode($result, true);

        $ticket = $result['ticket'];

        //保存场景
        $url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
        $image = get_http_request_file($url);

        $folder = './upload/wechat_ticket/';
        $file = $folder . $id . '.png';

        create_folder($folder);

        $local_file = fopen($file, 'w');
        if ($local_file != false) {
            if (fwrite($local_file, $image['body']) != false) {
                fclose($local_file);
            }
        }

        //二维码上增加 logo
        //if ($this->wechat_logo != '') {
        //$this->ImageService->water($file, '.' . $this->wechat_logo, $file, 5);
        //}

        return true;
    }

    /**
     * 获取 H5 页面 jsapi
     * @return array|mixed
     */
    public function get_wechat_h5_jsapi()
    {
        $arr_wechat_h5_jsapi = Cache::get('wechat_h5_jsapi');
        if (($arr_wechat_h5_jsapi == '') || ($arr_wechat_h5_jsapi['expires_time'] < $this->current_time)) {
            $noncestr = get_rand_code();
            $access_token = $this->get_access_token();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$access_token&type=jsapi";
            $json_ticket = https_request($url);

            $arr_ticket = json_decode($json_ticket, true);
            $jsapi_ticket = $arr_ticket['ticket'];

            $arr_signature = [
                'noncestr' => $noncestr,
                'jsapi_ticket' => $jsapi_ticket,
                'timestamp' => $this->current_time,
                'url' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
            ];

            ksort($arr_signature);

            $signature = '';

            foreach ($arr_signature as $key => $value) {
                if ($signature != '') {
                    $signature .= '&';
                }

                $signature .= "$key=$value";
            }

            $signature = sha1($signature);

            $arr_wechat_h5_jsapi = [
                'noncestr' => $noncestr,
                'jsapi_ticket' => $jsapi_ticket,
                'timestamp' => $this->current_time,
                'expires_time' => $this->current_time + $this->expires_time,
                'signature' => $signature
            ];

            Cache::set('wechat_h5_jsapi', $arr_wechat_h5_jsapi);
        }

        return $arr_wechat_h5_jsapi;
    }

    /**
     * 获取 access_token
     * @return mixed
     */
    private function get_access_token()
    {
        $arr = Cache::get('wechat_access_token');
        if (($arr == '') || ($arr['expires_time'] < $this->current_time)) {
            $grant_type = 'client_credential';

            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=$grant_type&appid=$this->wechat_app_id&secret=$this->wechat_app_secret";
            $result = https_request($url);
            $json = json_decode($result, true);

            $arr = [
                'access_token' => $json['access_token'],
                'expires_time' => $this->current_time + $this->expires_time
            ];

            Cache::set('wechat_access_token', $arr);
        } else {
            $access_token = $arr['access_token'];
        }

        return $access_token;
    }

    /**
     * 获取 微信 openid
     * @return mixed
     */
    public function get_wechat_openid()
    {
        $wechat_openid = $this->CookieService->get_wechat_openid();
        if ($wechat_openid == '') {
            $code = $this->request['code'];
            if ($code == '') {
                $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->wechat_app_id&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_base&state=1#wechat_redirect";

                header("Location:$url");
                die();
            } else {
                $url = "https://api.weixin.qq.com/sns/oauth2/access_token?grant_type=authorization_code&appid=$this->wechat_app_id&secret=$this->wechat_app_secret&code=$code";
                $request = https_request($url);
                $json = json_decode($request, true);
                $wechat_openid = $json['openid'];

                Cookie::set('wechat_openid', $wechat_openid);
            }
        }

        return $wechat_openid;
    }

    /**
     * 获取 已关注公众号 用户信息
     * @param $wechat_openid
     * @return mixed
     */
    public function get_wechat_info($wechat_openid)
    {
        $access_token = $this->get_access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$wechat_openid";
        $request = https_request($url);

        $json = json_decode($request, true);
        if ($json['subscribe'] == 1) {
            $result = [
                'wechat_nickname' => $json['nickname'],
                'wechat_face' => $json['headimgurl'],
                'wechat_sex' => $json['sex'],
                'wechat_language' => $json['language'],
                'wechat_country' => $json['country'], //国家
                'wechat_province' => $json['province'],
                'wechat_city' => $json['city'],
                'is_subscribe_wechat' => $json['subscribe'] //是否关注微信公众号
            ];

            if (isset($json['unionvid'])) {
                $result['wechat_unionv_id'] = $json['unionvid'];
            }
        } else {
            $result['is_subscribe_wechat'] = 0; //是否关注微信公众号
        }

        $result['wechat_openid'] = $wechat_openid;

        return $result;
    }

    /**
     * 获取 未关注公众号 用户授权信息
     */
    public function get_wechat_authorize_info()
    {
        $code = $this->request['code'];
        if ($code == '') {
            $rand_code = get_rand_code();
            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $authorize_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->wechat_app_id&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=$rand_code#wechat_redirect";

            header("Location:" . $authorize_url);
            die();
        } else {
            $oauth2_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$this->wechat_app_id&secret=$this->wechat_app_secret&code=$code&grant_type=authorization_code";

            $result_oauth2 = https_request($oauth2_url);
            $arr_oauth2 = json_decode($result_oauth2, true);

            //code 重复使用，报次错误
            if (isset($arr_oauth2['errcode'])) {
                $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'];

                header("Location:" . $redirect_uri);
                die();
            }

            $access_token = $arr_oauth2['access_token'];
            $openid = $arr_oauth2['openid'];
            $user_info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";

            $result_user_info = https_request($user_info_url);
            $arr_user_info = json_decode($result_user_info, true);

            $data = [
                'wechat_openid' => $arr_user_info['openid'],
                'wechat_nickname' => $arr_user_info['nickname'],
                'wechat_face' => $arr_user_info['headimgurl'],
                'wechat_sex' => $arr_user_info['sex'],
                'wechat_language' => $arr_user_info['language'],
                'wechat_country' => $arr_user_info['country'],
                'wechat_province' => $arr_user_info['province'],
                'wechat_city' => $arr_user_info['city']
            ];

            //$result_update_wechat_info = $this->UserLogic->update_wechat_info($data);

            return $data;
        }
    }

    /**
     * 获取 微信支付
     * @param $app_enum_type
     * @param $pay_data
     * @param $wechat_openid
     * @return false|mixed|string
     */
    public function get_pay_order($app_enum_type, $pay_data, $wechat_openid)
    {
        if (is_wechat()) {
            $result = $this->get_pay_order_wechat($app_enum_type, $pay_data, $wechat_openid);
        } else {
            if ($this->request->isMobile()) {
                $result = $this->get_pay_order_mobile($app_enum_type, $pay_data);
            } else {
                $result = $this->get_pay_order_pc($app_enum_type, $pay_data);
            }
        }

        return $result;
    }

    /**
     * 获取 微信统一下单
     * @param $app_enum_type
     * @param $pay_data
     * @param $pay_type
     * @param string $wechat_openid
     * @return mixed
     */
    private function get_pay_unified_order($app_enum_type, $pay_data, $pay_type, $wechat_openid = '')
    {
        $paid = $pay_data['paid_money'];
        //$paid = 0.01;

        switch ($app_enum_type) {
            case('recharge'): //充值
                $out_trade_no = $pay_data['recharge_code'];

                break;
            case('order'): //订单
                $out_trade_no = $pay_data['order_code'];

                break;
        }

        $arr_unified_param = [
            'appid' => $this->wechat_app_id,
            'mch_id' => $this->wechat_pay_id,
            'out_trade_no' => $out_trade_no,
            'total_fee' => $paid * 100,
            'body' => ' ',
            'nonce_str' => $this->rand_code,
            'spbill_create_ip' => $this->request->ip(),
            'trade_type' => $pay_type,
            'notify_url' => $this->get_pay_notify_url($app_enum_type, $pay_data['id']),
        ];

        if ($wechat_openid != '') {
            $arr_unified_param['openid'] = $wechat_openid;
        }

        $arr_unified_param['sign'] = $this->get_sign($arr_unified_param);

        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $post_xml = array_to_xml($arr_unified_param);
        $result_xml = post_xml_curl($url, $post_xml);
        $arr_unified_order = xml_to_array($result_xml);

        return $arr_unified_order;
    }

    /**
     * 获取 微信支付 jsapi（微信端）
     * @param $app_enum_type
     * @param $pay_data
     * @param $wechat_openid
     * @return false|string
     */
    private function get_pay_order_wechat($app_enum_type, $pay_data, $wechat_openid)
    {
        $arr_unified_order = $this->get_pay_unified_order($app_enum_type, $pay_data, 'JSAPI', $wechat_openid);

        $arr_js_api = [
            'appId' => $this->wechat_app_id,
            'timeStamp' => "$this->current_time",
            'nonceStr' => $this->rand_code,
            'package' => 'prepay_id=' . $arr_unified_order['prepay_id'],
            'signType' => 'MD5'
        ];

        $arr_js_api['paySign'] = $this->get_sign($arr_js_api);

        $js_api_parameters = json($arr_js_api);

        return $js_api_parameters;
    }

    /**
     * 获取 微信支付二维码（手机端）
     * @param $app_enum_type
     * @param $pay_data
     * @return mixed
     */
    private function get_pay_order_mobile($app_enum_type, $pay_data)
    {
        $result = $this->get_pay_unified_order($app_enum_type, $pay_data, 'MWEB');

        return $result;
    }

    /**
     * 获取 微信支付二维码（电脑）
     * @param $app_enum_type
     * @param $pay_data
     * @return mixed
     */
    private function get_pay_order_pc($app_enum_type, $pay_data)
    {
        $result = $this->get_pay_unified_order($app_enum_type, $pay_data, 'NATIVE');

        return $result;
    }

    /**
     * 获取 刷卡支付 返回值
     * @param $arr
     * @return mixed
     */
    public function get_pay_micropay($arr)
    {
        $url = 'https://api.mch.weixin.qq.com/pay/micropay';
        $post_xml = array_to_xml($arr);

        $result_xml = post_xml_curl($url, $post_xml);
        $result = xml_to_array($result_xml);

        return $result;
    }

    /**
     * 获取 发送红包
     * @param $wechat_openid
     * @param $order_code
     * @param $money
     * @return mixed
     */
    public function get_send_red_pack($wechat_openid, $order_code, $money)
    {
        $arr_xml = [
            'nonce_str' => $this->rand_code,
            'mch_billno' => $order_code,
            'mch_id' => $this->wechat_pay_id,
            'wxappid' => $this->wechat_app_id,
            'send_name' => $this->wechat_name,
            're_openid' => $wechat_openid,
            'total_amount' => $money * 100,
            'client_ip' => $this->request->ip(),
            'total_num' => 1, //红包发放总人数
            'wishing' => ' ', //红包祝福语
            'act_name' => ' ', //活动名称
            'remark' => '', //备注
        ];

        $arr_xml['sign'] = $this->get_sign($arr_xml);

        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
        $post_xml = array_to_xml($arr_xml);
        $result_xml = $this->curl_post_ssl($url, $post_xml);
        $arr_result = xml_to_array($result_xml);

        return $arr_result;
    }

    /**
     * 获取 企业付款
     * @param $wechat_openid
     * @param $order_code
     * @param $money
     * @return mixed
     */
    public function get_transfers_money($wechat_openid, $order_code, $money)
    {
        //$money = 0.30; //测试使用

        $arr_xml = [
            'mch_appid' => $this->wechat_app_id, //wechat_app_id
            'mchid' => $this->wechat_pay_id, //商户号
            'nonce_str' => $this->rand_code, //随机字符串
            'partner_trade_no' => $order_code, //商户订单号
            'openid' => $wechat_openid, //用户openid
            'check_name' => 'NO_CHECK', //校验用户姓名选项
            'amount' => $money * 100, //金额
            'desc' => ' ', //备注
            'spbill_create_ip' => $this->request->ip() //ip 地址
        ];

        $arr_xml['sign'] = $this->get_sign($arr_xml); //签名

        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
        $post_xml = array_to_xml($arr_xml);
        $result_xml = $this->curl_post_ssl($url, $post_xml);
        $arr_result = xml_to_array($result_xml);

        return $arr_result;
    }

    /**
     * 获取微信支付签名
     * @param $param
     * @return string
     */
    private function get_sign($param)
    {
        $str = '';
        $arr = $param;

        ksort($arr);

        foreach ($arr as $k => $v) {
            if ($v != '') {
                $str .= $k . '=' . $v . '&';
            }
        }

        $str .= 'key=' . $this->wechat_pay_key;
        $str = md5($str);
        $str = strtoupper($str);

        return $str;
    }

    /**
     * 使用证书，以post方式提交xml到对应的接口url
     * @param $url
     * @param $vars
     * @param int $second
     * @return bool|mixed
     */
    private function curl_post_ssl($url, $vars, $second = 30)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSLCERT, "./wechat_cert/apiclient_cert.pem");
        curl_setopt($ch, CURLOPT_SSLKEY, "./wechat_cert/apiclient_key.pem");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);

        $data = curl_exec($ch);
        if ($data) {
            curl_close($ch);

            return $data;
        } else {
            $error = curl_errno($ch);

            echo "call faild, errorCode:$error";

            curl_close($ch);

            return false;
        }
    }
}