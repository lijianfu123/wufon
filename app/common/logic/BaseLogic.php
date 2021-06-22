<?php

namespace app\common\logic;

use think\facade\Cookie;
use think\facade\Validate;
use app\common\enum\DiscountTypeEnum;
use app\common\enum\ExpressMoneyTypeEnum;
use app\common\enum\MoneyTypeEnum;
use app\common\enum\OrderStateEnum;
use app\common\enum\PayTypeEnum;
use app\common\enum\PointTypeEnum;
use app\common\enum\TradTypeEnum;
use app\common\enum\UserTypeEnum;
use app\common\enum\MarriageEnum;
use app\common\enum\NationEnum;
use app\common\enum\PoliticalEnum;
use app\common\enum\SexEnum;
use app\common\enum\AppEnum;
use app\common\enum\CacheJsonEnum;
use app\common\service\CookieService;

/**
 * 基类 - 逻辑
 * Class BaseLogic
 * @package app\common\logic
 */
class BaseLogic
{
    protected $Model; //模型
    protected $CookieService; //cookie

    protected $validate_rule = []; //验证规则
    protected $validate_message = []; //验证提示

    protected $admin_id = 0; //后台 管理员 id
    protected $site_id = 0; //站点 id
    protected $siter_id = 0; //站点 管理员 id
    protected $siter_login_name = 0; //站点 管理员 登录名
    protected $user_id = 0; //会员 id

    /**
     * 构造方法
     * BaseLogic constructor.
     */
    public function __construct()
    {
        $current_logic = $this->get_current_logic(); //当前逻辑

        //当前模型
        $model_path = "\\app\\common\model\\" . $current_logic . "Model";
        $this->Model = new $model_path();

        $this->CookieService = new CookieService();
    }

    /**
     * 获取 当前 Logic 层名称
     */
    private function get_current_logic()
    {
        $model_name = get_class($this);
        $model_name = str_replace('\\', '/', $model_name);
        $model_name = basename($model_name);
        $model_name = substr($model_name, 0, -5);

        return $model_name;
    }

    /**
     * 获取 后台 管理员 信息
     */
    protected function get_admin_info()
    {
        $this->admin_id = $this->CookieService->get_admin_id();
    }

    /**
     * 获取 站点、站点管理员 信息
     */
    protected function get_siter_info()
    {
        $this->site_id = $this->CookieService->get_site_id();
        $this->siter_id = $this->CookieService->get_siter_id();
    }

    /**
     * 获取 会员 信息
     */
    protected function get_user_info()
    {
        $this->user_id = $this->CookieService->get_user_id();
    }

    /**
     * 验证 数据
     * @param $data
     * @param null $validate_rule
     * @param null $validate_message
     * @return array|bool
     */
    protected function validate_data($data, $validate_rule = null, $validate_message = null)
    {
        if (is_null($validate_rule)) {
            $validate_rule = $this->validate_rule;
        }

        if (is_null($validate_message)) {
            $validate_message = $this->validate_message;
        }

        $validate = Validate::rule($validate_rule)->message($validate_message);

        $result = $validate->check($data);
        if (!$result) {
            return $validate->getError();
        } else {
            return true;
        }
    }

    /**
     * 注册
     * @param $data
     */
    public function register($data)
    {

    }

    /**
     * 登录
     * @param $data
     * @return string
     */
    public function login($data)
    {
        $username = isset($data['username']) ? $data['username'] : '';
        if ($username == '') {
            return '用户名为空';
        } else {
            $username = strtolower(trim($username));
        }

        $password = isset($data['password']) ? $data['password'] : '';
        if ($password == '') {
            return '密码为空';
        }

        if (isset($data['captcha'])) {
            $captcha = isset($data['captcha']) ? $data['captcha'] : '';
            if ($captcha == '') {
                return '验证码为空';
            } elseif (!captcha_check($captcha)) {
                return '验证码错误';
            }
        }

        $detail = $this->Model->get_login_detail($username, $password); //获取 登录数据(未登录)
        if ($detail->isEmpty()) {
            return '账户禁用 或 会员名密码错误';
        } else {
            switch ($this->Model->name) {
                case AppEnum::admin['enum_type']:
                    Cookie::set('admin_id', encode($detail['id']));
                    Cookie::set('admin_login_name', encode($detail['login_name']));

                    break;
                case AppEnum::site['enum_type'] . 'r':
                    Cookie::set('siter_id', encode($detail['id']));
                    Cookie::set('siter_login_name', encode($detail['login_name']));
                    Cookie::set('site_id', encode($detail['site_id'])); //站点

                    break;
                case AppEnum::user['enum_type']:
                    Cookie::set('user_id', encode($detail['id']));
                    Cookie::set('user_login_name', encode($detail['login_name']));

                    break;
            }

            $result = $detail['id'];

            return $result;
        }
    }

    /**
     * 基础 更新密码
     * @param $data
     * @return string
     */
    private function base_update_password($data)
    {
        if (strlen($data['password']) < 6) {
            return '原密码小于 6 为';
        } else {
            $original_password = md5($data['password']);
        }

        if (!isset($data['new_password'])) {
            return '新密码为空';
        } else if (strlen($data['new_password']) < 6) {
            return '新密码长度小于 6 位';
        }

        if (!isset($data['confirm_password'])) {
            return '确认密码为空';
        } else if ($data['confirm_password'] != $data['new_password']) {
            return '确认密码错误';
        } else {
            $new_password = md5($data['new_password']);
        }

        //原密码是否正确
        $original_data = $this->Model->find($data['id']);
        if ($original_password != $original_data['password']) {
            return '原密码错误';
        }

        //保存新密码
        $new_data['id'] = $data['id'];
        $new_data['password'] = $original_password;

        $result = $this->Model->save_data($new_data);

        return $result;
    }

    /**
     * 后台 更新密码
     * @param $data
     * @return string
     */
    public function admin_update_password($data)
    {
        $this->get_admin_info();
        $result = $this->base_update_password($data);

        return $result;
    }

    /**
     * 站点 更新密码
     * @param $data
     * @return string
     */
    public function site_update_password($data)
    {
        $this->get_siter_info();
        $result = $this->base_update_password($data);

        return $result;
    }

    /**
     * 会员 更新密码
     * @param $data
     * @return string
     */
    public function user_update_password($data)
    {
        $this->get_user_info();
        $result = $this->base_update_password($data);

        return $result;
    }

    /**
     * 生成 缓存 json
     */
    private function create_cache_json()
    {
        if (count($this->Model->cache_json_array) > 0) {
            foreach ($this->Model->cache_json_array as $cache_json) {
                $list = [];
                $json_type = '';

                switch ($cache_json) {
                    case CacheJsonEnum::option['enum_number']:
                        $list = $this->Model->get_pass_option();
                        $json_type = CacheJsonEnum::option['enum_type'];

                        break;
                    case CacheJsonEnum::cascader['enum_number']:
                        $list = $this->Model->get_pass_cascader();
                        $json_type = CacheJsonEnum::cascader['enum_type'];

                        break;
                }

                $json_name = $this->Model->name . '_pass_' . $json_type . '_json';
                $json_code = 'let ' . $json_name . ' = ' . json_encode($list, JSON_UNESCAPED_UNICODE) . ';';
                $file_path = './static/renhe-ui/json/' . $json_name . '.js';

                write_file($file_path, $json_code);
            }
        }
    }

    /**
     * 获取 解析后 数据
     * @param array $data
     * @return array|string
     * @throws \ReflectionException
     */
    protected function get_parse_data(array $data)
    {
        //获取 省 / 市 / 县 数据
        $get_city_detail = function (array $data) {
            if (isset($data['city_ids_json'])) {
                $data['province_id'] = isset($data['city_ids_json'][0]) ? $data['city_ids_json'][0] : 0;
                $data['city_id'] = isset($data['city_ids_json'][1]) ? $data['city_ids_json'][1] : 0;
                $data['county_id'] = isset($data['city_ids_json'][2]) ? $data['city_ids_json'][2] : 0;
                $data['city_ids'] = ',' . implode(',', $data['city_ids_json']) . ',';
            }

            return $data;
        };

        //购物车类型
        if (isset($data['pay_type_enum_number'])) {
            $data['pay_type'] = PayTypeEnum::get_enum_name($data['pay_type_enum_number']);
        }

        //优惠类型
        if (isset($data['discount_type_enum_number'])) {
            $data['discount_type'] = DiscountTypeEnum::get_enum_name($data['discount_type_enum_number']);
        }

        //运费类型
        if (isset($data['express_money_type_enum_number'])) {
            $data['express_money_type'] = ExpressMoneyTypeEnum::get_enum_name($data['express_money_type_enum_number']);
        }

        //财务类型
        if (isset($data['money_type_enum_number'])) {
            $data['money_type'] = MoneyTypeEnum::get_enum_name($data['money_type_enum_number']);
        }

        //付款方式
        if (isset($data['pay_type_enum_number'])) {
            $data['pay_type'] = PayTypeEnum::get_enum_name($data['pay_type_enum_number']);
        }

        //积分类型
        if (isset($data['point_type_enum_number'])) {
            $data['point_type'] = PointTypeEnum::get_enum_name($data['point_type_enum_number']);
        }

        //交易类型
        if (isset($data['trad_type_enum_number'])) {
            $data['trad_type'] = TradTypeEnum::get_enum_name($data['trad_type_enum_number']);
        }

        //会员类型
        if (isset($data['user_type_enum_number'])) {
            $data['user_type'] = UserTypeEnum::get_enum_name($data['user_type_enum_number']);
        }

        //订单状态
        if (isset($data['order_state_enum_number'])) {
            $data['order_state'] = OrderStateEnum::get_enum_name($data['order_state_enum_number']);
        }

        //性别
        if (isset($data['sex_enum_number'])) {
            $data['sex'] = SexEnum::get_enum_name($data['sex_enum_number']);
        }

        //民族
        if (isset($data['nation_enum_number'])) {
            $data['nation'] = NationEnum::get_enum_name($data['nation_enum_number']);
        }

        //婚姻状况
        if (isset($data['marriage_enum_number'])) {
            $data['marriage'] = MarriageEnum::get_enum_name($data['marriage_enum_number']);
        }

        //政治面貌
        if (isset($data['political_enum_number'])) {
            $data['political'] = PoliticalEnum::get_enum_name($data['political_enum_number']);
        }

        //省 / 市 / 县
        if (isset($data['country_id'])) {
            if ($data['country_id'] == 1) {
                $data = $get_city_detail($data);
            } else {
                $data['province_id'] = 0;
                $data['city_id'] = 0;
                $data['county_id'] = 0;
            }
        } else {
            $data = $get_city_detail($data);
        }

        //用户名、登录名、密码
        if ($data['id'] == 0) {
            if (isset($data['username'])) {
                $data['username'] = strtolower(trim($data['username']));
                $data['login_name'] = md5($data['username']);

                if (isset($data['password'])) {
                    if (strlen($data['password']) < 6) {
                        return '密码小于 6 位';
                    } else {
                        $data['password'] = md5($data['password']);
                    }
                } else {
                    return '密码为空';
                }
            }
        } else {
            if (isset($data['password'])) {
                $data['password'] = trim($data['password']);
                if ($data['password'] == '') {
                    unset($data['password']);
                } else {
                    if (strlen($data['password']) < 6) {
                        return '密码小于 6 位';
                    } else {
                        $data['password'] = md5($data['password']);
                    }
                }
            }
        }

        //层级
        if (isset($data['parent_id'])) {
            if ($data['parent_id'] == 0) {
                $data['level'] = 1;
            } else {
                $data['level'] = 2;
            }
        }

        //权限规则
        if (isset($data['first_role_rule_id'])) {
            if ($data['first_role_rule_id'] == 0) {
                $data['parent_id'] = 0;
                $data['level'] = 1;
                $data['role_rule_ids'] = '';
            } else {
                if ($data['second_role_rule_id'] == 0) {
                    $data['parent_id'] = $data['first_role_rule_id'];
                    $data['level'] = 2;
                    $data['role_rule_ids'] = ',' . $data['first_role_rule_id'] . ',';
                } else {
                    $data['parent_id'] = $data['second_role_rule_id'];
                    $data['level'] = 3;
                    $data['role_rule_ids'] = ',' . $data['first_role_rule_id'] . ',' . $data['second_role_rule_id'] . ',';
                }
            }
        }

        //新闻
        if (isset($data['first_news_class_id'])) {
            if (isset($data['second_news_class_id'])) {
                if ($data['second_news_class_id'] == 0) {
                    $data['news_class_ids'] = ',' . $data['first_news_class_id'] . ',';
                } else {
                    $data['news_class_ids'] = ',' . $data['first_news_class_id'] . ',' . $data['second_news_class_id'] . ',';
                }
            } else {
                $data['news_class_ids'] = ',' . $data['first_news_class_id'] . ',';
            }
        }

        //商品
        if (isset($data['first_product_class_id'])) {
            if (isset($data['second_product_class_id'])) {
                if ($data['second_product_class_id'] == 0) {
                    $data['product_class_ids'] = ',' . $data['first_product_class_id'] . ',';
                } else {
                    $data['product_class_ids'] = ',' . $data['first_product_class_id'] . ',' . $data['second_product_class_id'] . ',';
                }
            } else {
                $data['product_class_ids'] = ',' . $data['first_product_class_id'] . ',';
            }
        }

        return $data;
    }

    /**
     * 基础 保存 数据
     * @param $data
     * @return array|bool
     * @throws \ReflectionException
     */
    private function base_save_data($data)
    {
        $data = $this->get_parse_data($data);

        //数据验证
        $validate_data = $this->validate_data($data);
        if ($validate_data !== true) {
            return $validate_data;
        }

        $result = $this->Model->save_data($data);
        if ($result !== false) {
            $this->create_cache_json(); //生成 缓存 json
        }

        return $result;
    }

    /**
     * 后台 保存 数据
     * @param $data
     * @return array|bool
     * @throws \ReflectionException
     */
    public function admin_save_data($data)
    {
        $this->get_admin_info();

        $data['admin_id'] = $this->admin_id;

        $result = $this->base_save_data($data);

        return $result;
    }

    /**
     * 站点 保存 数据
     * @param $data
     * @return array|bool
     * @throws \ReflectionException
     */
    public function site_save_data($data)
    {
        $this->get_siter_info();

        $data['site_id'] = $this->site_id;
        $data['siter_id'] = $this->siter_id;

        $result = $this->base_save_data($data);

        return $result;
    }

    /**
     * 会员 保存 数据
     * @param $data
     * @return array|bool
     * @throws \ReflectionException
     */
    public function user_save_data($data)
    {
        $this->get_user_info();

        $data['user_id'] = $this->user_id;

        $result = $this->base_save_data($data);

        return $result;
    }

    /**
     * 基础 删除 数据
     * @param $app_enum_type
     * @param $id
     * @return string
     */
    private function base_delete_data($app_enum_type, $id)
    {
        $result = $this->Model->delete_data($id);
        if ($result === false) {
            return '删除失败';
        } else {
            $this->create_cache_json(); //生成 缓存 json

            return $result;
        }
    }

    /**
     * 后台 删除 数据
     * @param $id
     * @return string
     */
    public function admin_delete_data($id)
    {
        $result = $this->base_delete_data(AppEnum::admin['enum_type'], $id);

        return $result;
    }

    /**
     * 站点 删除 数据
     * @param $id
     * @return string
     */
    public function site_delete_data($id)
    {
        $result = $this->base_delete_data(AppEnum::site['enum_type'], $id);

        return $result;
    }

    /**
     * 会员 删除 数据
     * @param $id
     * @return string
     */
    public function user_delete_data($id)
    {
        $result = $this->base_delete_data(AppEnum::user['enum_type'], $id);

        return $result;
    }

    /**
     * 基础 更新 排序
     * @param $array
     * @return string
     */
    private function base_update_sort($array)
    {
        $data = [];
        $is_valid_data = true; //是否 有效数据

        foreach ($array as $key => $value) {
            $data[$key]['id'] = $value['id'];

            if (isset($value['sort'])) {
                $data[$key]['sort'] = $value['sort'];
            } else {
                $is_valid_data = false;
            }
        }

        if ($is_valid_data) {
            $result = $this->Model->update_all_data($data);
            if ($result === false) {
                return '操作失败';
            } else {
                $this->create_cache_json(); //生成 缓存 json

                return $result;
            }
        } else {
            return '非法数据';
        }
    }

    /**
     * 后台 更新 排序
     * @param $array
     * @return string
     */
    public function admin_update_sort($array)
    {
        $result = $this->base_update_sort($array);

        return $result;
    }

    /**
     * 站点 更新 排序
     * @param $array
     * @return string
     */
    public function site_update_sort($array)
    {
        $result = $this->base_update_sort($array);

        return $result;
    }

    /**
     * 会员 更新 排序
     * @param $array
     * @return string
     */
    public function user_update_sort($array)
    {
        $result = $this->base_update_sort($array);

        return $result;
    }

    /**
     * 基础 更新 是否 审核
     * @param $id
     * @param $is_pass
     * @return string
     */
    private function base_update_is_pass($id, $is_pass)
    {
        $data['id'] = $id;
        $data['is_pass'] = $is_pass;

        $result = $this->Model->update_data($data);
        if ($result === false) {
            return '操作失败';
        } else {
            $this->create_cache_json(); //生成 缓存 json

            return $result;
        }
    }

    /**
     * 后台 更新 是否 审核
     * @param $id
     * @param $is_pass
     * @return string
     */
    public function admin_update_is_pass($id, $is_pass)
    {
        $result = $this->base_update_is_pass($id, $is_pass);

        return $result;
    }

    /**
     * 站点 更新 是否 审核
     * @param $id
     * @param $is_pass
     * @return string
     */
    public function site_update_is_pass($id, $is_pass)
    {
        $result = $this->base_update_is_pass($id, $is_pass);

        return $result;
    }

    /**
     * 会员 更新 是否 审核
     * @param $id
     * @param $is_pass
     * @return string
     */
    public function user_update_is_pass($id, $is_pass)
    {
        $result = $this->base_update_is_pass($id, $is_pass);

        return $result;
    }

    /**
     * 基础 更新 是否 推荐
     * @param $id
     * @param $is_commend
     * @return string
     */
    private function base_update_is_commend($id, $is_commend)
    {
        $data['id'] = $id;
        $data['is_commend'] = $is_commend;

        $result = $this->Model->update_data($data);
        if ($result === false) {
            return '操作失败';
        } else {
            return $result;
        }
    }

    /**
     * 后台 更新 是否 推荐
     * @param $id
     * @param $is_commend
     * @return string
     */
    public function admin_update_is_commend($id, $is_commend)
    {
        $result = $this->base_update_is_commend($id, $is_commend);

        return $result;
    }

    /**
     * 站点 更新 是否 推荐
     * @param $id
     * @param $is_commend
     * @return string
     */
    public function site_update_is_commend($id, $is_commend)
    {
        $result = $this->base_update_is_commend($id, $is_commend);

        return $result;
    }

    /**
     * 会员 更新 是否 推荐
     * @param $id
     * @param $is_commend
     * @return string
     */
    public function user_update_is_commend($id, $is_commend)
    {
        $result = $this->base_update_is_commend($id, $is_commend);

        return $result;
    }

    /**
     * 基础 更新 是否 最新、新品
     * @param $id
     * @param $is_new
     * @return string
     */
    private function base_update_is_new($id, $is_new)
    {
        $data['id'] = $id;
        $data['is_new'] = $is_new;

        $result = $this->Model->update_data($data);
        if ($result === false) {
            return '操作失败';
        } else {
            return $result;
        }
    }

    /**
     * 后台 更新 是否 最新、新品
     * @param $id
     * @param $is_new
     * @return string
     */
    public function admin_update_is_new($id, $is_new)
    {
        $result = $this->base_update_is_new($id, $is_new);

        return $result;
    }

    /**
     * 站点 更新 是否 最新、新品
     * @param $id
     * @param $is_new
     * @return string
     */
    public function site_update_is_new($id, $is_new)
    {
        $result = $this->base_update_is_new($id, $is_new);

        return $result;
    }

    /**
     * 会员 更新 是否 最新、新品
     * @param $id
     * @param $is_new
     * @return string
     */
    public function user_update_is_new($id, $is_new)
    {
        $result = $this->base_update_is_new($id, $is_new);

        return $result;
    }

    /**
     * 基础 更新 是否 热点、热卖
     * @param $id
     * @param $is_hot
     * @return string
     */
    private function base_update_is_hot($id, $is_hot)
    {
        $data['id'] = $id;
        $data['is_hot'] = $is_hot;

        $result = $this->Model->update_data($data);
        if ($result === false) {
            return '操作失败';
        } else {
            return $result;
        }
    }

    /**
     * 后台 更新 是否 热点、热卖
     * @param $id
     * @param $is_hot
     * @return string
     */
    public function admin_update_is_hot($id, $is_hot)
    {
        $result = $this->base_update_is_hot($id, $is_hot);

        return $result;
    }

    /**
     * 站点 更新 是否 热点、热卖
     * @param $id
     * @param $is_hot
     * @return string
     */
    public function site_update_is_hot($id, $is_hot)
    {
        $result = $this->base_update_is_hot($id, $is_hot);

        return $result;
    }

    /**
     * 会员 更新 是否 热点、热卖
     * @param $id
     * @param $is_hot
     * @return string
     */
    public function user_update_is_hot($id, $is_hot)
    {
        $result = $this->base_update_is_hot($id, $is_hot);

        return $result;
    }

    /**
     * 基础 更新 是否 置顶
     * @param $id
     * @param $is_top
     * @return string
     */
    private function base_update_is_top($id, $is_top)
    {
        $data['id'] = $id;
        $data['is_top'] = $is_top;

        $result = $this->Model->update_data($data);
        if ($result === false) {
            return '操作失败';
        } else {
            return $result;
        }
    }

    /**
     * 后台 更新 是否 置顶
     * @param $id
     * @param $is_top
     * @return string
     */
    public function admin_update_is_top($id, $is_top)
    {
        $result = $this->base_update_is_top($id, $is_top);

        return $result;
    }

    /**
     * 站点 更新 是否 置顶
     * @param $id
     * @param $is_top
     * @return string
     */
    public function site_update_is_top($id, $is_top)
    {
        $result = $this->base_update_is_top($id, $is_top);

        return $result;
    }

    /**
     * 会员 更新 是否 置顶
     * @param $id
     * @param $is_top
     * @return string
     */
    public function user_update_is_top($id, $is_top)
    {
        $result = $this->base_update_is_top($id, $is_top);

        return $result;
    }

    /**
     * 基础 更新 是否 首页显示
     * @param $id
     * @param $is_index
     * @return string
     */
    private function base_update_is_index($id, $is_index)
    {
        $data['id'] = $id;
        $data['is_index'] = $is_index;

        $result = $this->Model->update_data($data);
        if ($result === false) {
            return '操作失败';
        } else {
            return $result;
        }
    }

    /**
     * 后台 更新 是否 首页显示
     * @param $id
     * @param $is_index
     * @return string
     */
    public function admin_update_is_index($id, $is_index)
    {
        $result = $this->base_update_is_index($id, $is_index);

        return $result;
    }

    /**
     * 站点 更新 是否 首页显示
     * @param $id
     * @param $is_index
     * @return string
     */
    public function site_update_is_index($id, $is_index)
    {
        $result = $this->base_update_is_index($id, $is_index);

        return $result;
    }

    /**
     * 会员 更新 是否 首页显示
     * @param $id
     * @param $is_index
     * @return string
     */
    public function user_update_is_index($id, $is_index)
    {
        $result = $this->base_update_is_index($id, $is_index);

        return $result;
    }

    /**
     * 基础 更新 是否 默认
     * @param $id
     * @param $is_default
     * @return string
     */
    private function base_update_is_default($id, $is_default)
    {
        $data['id'] = $id;
        $data['is_default'] = $is_default;

        $result = $this->Model->update_data($data);
        if ($result === false) {
            return '操作失败';
        } else {
            return $result;
        }
    }

    /**
     * 后台 更新 是否 默认
     * @param $id
     * @param $is_default
     * @return string
     */
    public function admin_update_is_default($id, $is_default)
    {
        $result = $this->base_update_is_default($id, $is_default);

        return $result;
    }

    /**
     * 站点 更新 是否 默认
     * @param $id
     * @param $is_default
     * @return string
     */
    public function site_update_is_default($id, $is_default)
    {
        $result = $this->base_update_is_default($id, $is_default);

        return $result;
    }

    /**
     * 会员 更新 是否 默认
     * @param $id
     * @param $is_default
     * @return string
     */
    public function user_update_is_default($id, $is_default)
    {
        $result = $this->base_update_is_default($id, $is_default);

        return $result;
    }
}