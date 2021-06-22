<?php

namespace app\api\controller;

use think\Request;
use app\common\enum\AppEnum;
use app\common\controller\CommonController;

/**
 * api > 基类
 * Class BaseController
 * @package app\api\controller
 */
class BaseController extends CommonController
{
    protected $Model, $Logic, $Enum;

    /**
     * 构造方法
     * BaseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        //是否 post 请求模式
        if (!request()->isPost()) {
            $result = $this->get_api_result('请求模式错误');
            $result = json_decode($result->getContent(), true);
            $json = json_encode($result, JSON_UNESCAPED_UNICODE);

            echo $json;
            die();
        }

        //验证 api 权限
        $api_role = $this->check_api_role();
        if ($api_role !== true) {
            $result = $this->get_api_result($api_role);
            $result = json_decode($result->getContent(), true);
            $json = json_encode($result, JSON_UNESCAPED_UNICODE);

            echo $json;
            die();
        }

        //实例化 Model、Logic、Enum 类
        if (!in_array($this->app['controller'], ['File'])) {
            if (substr($this->app['controller'], -4) == 'Enum') {
                $this->Enum = $this->get_common_class_path('enum');
            } else {
                $logic_path = $this->get_common_class_path('logic') . "Logic";
                $this->Logic = new $logic_path();

                $model_path = $this->get_common_class_path() . "Model";
                $this->Model = new $model_path();
            }
        }
    }

    /**
     * 返回 api 结果
     * @param $data
     * @return array
     */
    protected function get_api_result($data)
    {
        if (($data === 0) || ($data === false)) {
            $result = [
                'error_code' => 1,
                'error_message' => '操作失败'
            ];
        } else {
            if (($data === true) || is_numeric($data) || is_array($data) || is_object($data)) {
                $result = [
                    'error_code' => 0,
                    'data' => $data
                ];
            } else {
                $result = [
                    'error_code' => 1,
                    'error_message' => $data
                ];
            }
        }

        $result = json($result);

        return $result;
    }

    /**
     * 验证 api 权限
     * @return array|bool
     */
    private function check_api_role()
    {
        $token = isset($this->post['token']) ? $this->post['token'] : '';
        if ($token == '') {
            if ($this->app['referer_url'] == '') {
                return '请求地址为空';
            }

            $request_url = substr($this->app['referer_url'], (strpos($this->app['referer_url'], '//') + 2));

            $request_domain = substr($request_url, 0, (strpos($request_url, '/')));
            if (strpos($request_domain, ':')) {
                $request_domain = substr($request_domain, 0, (strpos($request_domain, ':')));
            }

            if ($request_domain != $_SERVER['HTTP_HOST']) {
                return '非法的请求地址';
            }

            //判断权限
            //if (is_has_role($request_url) == false) {
            //return '权限不足';
            //}
        } else {
            //验证 token 是否正确
            if ($token != md5($this->app['host'])) {
                return 'token 错误';
            }

            //验证 时间区间误差 1 分钟
            $server_time = time();
            $deviation_time = MINUTE_SECONDS;

            $time = isset($this->post['time']) ? $this->post['time'] : 0;
            if (($time < ($server_time - ($server_time - $deviation_time))) || ($time > ($server_time + $deviation_time))) {
                return '请求超时';
            }

            //验证 sign
            $sign = isset($this->post['sign']) ? $this->post['sign'] : '';
            if ($sign != md5($token . $time)) {
                return 'sign 错误';
            }
        }

        return true;
    }

    /**
     * 注册
     */
    public function register()
    {

    }

    /**
     * 登录
     * @return array
     */
    public function login()
    {
        $result = $this->Logic->login($this->post);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 忘记 密码
     */
    public function forgot_password()
    {

    }

    /**
     * 获取 枚举 tree
     * @return array
     */
    public function get_enum_tree()
    {
        $result = $this->Enum::get_enum_tree();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 枚举 列表
     * @return array
     */
    public function get_enum_list()
    {
        $result = $this->Enum::get_enum_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 枚举 option
     * @return array
     */
    public function get_enum_option()
    {
        $result = $this->Enum::get_enum_option();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 搜索 默认 数据
     * @return array
     */
    public function get_search_default_data()
    {
        $result = $this->Model->get_search_default_data();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 任意列表
     * @return mixed
     */
    public function get_any_list()
    {
        $result = $this->Model->get_any_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 站点 任意列表
     * @return mixed
     */
    public function get_site_any_list()
    {
        $result = $this->Model->get_site_any_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 会员 任意列表
     * @return mixed
     */
    public function get_user_any_list()
    {
        $result = $this->Model->get_user_any_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 任意 tree 列表
     * @return array
     */
    public function get_any_tree_list()
    {
        $result = $this->Model->get_any_tree_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 任意 第一层 tree 列表
     * @return array
     */
    public function get_any_first_level_tree_list()
    {
        $tree_list = $this->Model->get_any_first_level_tree_list();
        $result = $this->get_api_result($tree_list);

        return $result;
    }

    /**
     * 获取 任意 第二层 tree 列表
     * @return array
     */
    public function get_any_second_level_tree_list()
    {
        $parent_id = isset($this->post['parent_id']) ? $this->post['parent_id'] : 0;

        $result = $this->Model->get_any_second_level_tree_list($parent_id);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 任意 第三层 tree 列表
     * @return array
     */
    public function get_any_third_level_tree_list()
    {
        $parent_id = isset($this->post['parent_id']) ? $this->post['parent_id'] : 0;

        $result = $this->Model->get_any_third_level_tree_list($parent_id);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 站点 任意 tree 列表
     * @return array
     */
    public function get_site_any_tree_list()
    {
        $result = $this->Model->get_site_any_tree_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 会员 任意 tree 列表
     * @return array
     */
    public function get_user_any_tree_list()
    {
        $result = $this->Model->get_user_any_tree_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 任意分页
     * @return mixed
     */
    public function get_any_page()
    {
        $result = $this->Model->get_any_page($this->post);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 站点 任意分页
     * @return mixed
     */
    public function get_site_any_page()
    {
        $result = $this->Model->get_site_any_page($this->post);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 会员 任意分页
     * @return mixed
     */
    public function get_user_any_page()
    {
        $result = $this->Model->get_user_any_page($this->post);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 任意数据
     * @return array
     */
    public function get_any_detail()
    {
        $id = isset($this->post['id']) ? $this->post['id'] : 0;

        $result = $this->Model->get_any_detail($id);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 站点 任意数据
     * @return array
     */
    public function get_site_any_detail()
    {
        $id = isset($this->post['id']) ? $this->post['id'] : 0;

        $result = $this->Model->get_site_any_detail($id);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 会员 任意数据
     * @return array
     */
    public function get_user_any_detail()
    {
        $id = isset($this->post['id']) ? $this->post['id'] : 0;

        $result = $this->Model->get_user_any_detail($id);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 审核 列表
     * @return array
     */
    public function get_pass_list()
    {
        $result = $this->Model->get_pass_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 站点 审核列表
     * @return mixed
     */
    public function get_site_pass_list()
    {
        $result = $this->Model->get_site_pass_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 会员 审核列表
     * @return mixed
     */
    public function get_user_pass_list()
    {
        $result = $this->Model->get_user_pass_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 审核 tree 列表
     * @return array
     */
    public function get_pass_tree_list()
    {
        $result = $this->Model->get_pass_tree_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 站点 审核 tree 列表
     * @return array
     */
    public function get_site_pass_tree_list()
    {
        $result = $this->Model->get_site_passr_tree_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 会员 审核 tree 列表
     * @return array
     */
    public function get_user_pass_tree_list()
    {
        $result = $this->Model->get_user_pass_tree_list();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 审核 分页
     * @return array
     */
    public function get_pass_page()
    {
        $result = $this->Model->get_pass_page($this->post);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 站点 审核分页
     * @return mixed
     */
    public function get_site_pass_page()
    {
        $result = $this->Model->get_site_pass_page($this->post);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 会员 审核分页
     * @return mixed
     */
    public function get_user_pass_page()
    {
        $result = $this->Model->get_user_pass_page($this->post);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 审核 数据
     * @return array
     */
    public function get_pass_detail()
    {
        $id = isset($this->post['id']) ? $this->post['id'] : 0;

        $result = $this->Model->get_pass_detail($id);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 站点 审核数据
     * @return array
     */
    public function get_site_pass_detail()
    {
        $id = isset($this->post['id']) ? $this->post['id'] : 0;

        $result = $this->Model->get_site_pass_detail($id);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 会员 审核数据
     * @return array
     */
    public function get_user_pass_detail()
    {
        $id = isset($this->post['id']) ? $this->post['id'] : 0;

        $result = $this->Model->get_user_pass_detail($id);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 审核 option
     * @return array
     */
    public function get_pass_option()
    {
        $result = $this->Model->get_pass_option();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 站点 审核 option
     * @return array
     */
    public function get_site_pass_option()
    {
        $result = $this->Model->get_site_pass_option();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 会员 审核 option
     * @return array
     */
    public function get_user_pass_option()
    {
        $result = $this->Model->get_user_pass_option();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 审核 第一层 option
     * @return array
     */
    public function get_pass_first_level_option()
    {
        $result = $this->Model->get_pass_first_level_option();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 站点 审核 第一层 option
     * @return array
     */
    public function get_site_pass_first_level_option()
    {
        $result = $this->Model->get_site_pass_first_level_option();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 用户 审核 第一层 option
     * @return array
     */
    public function get_user_pass_first_level_option()
    {
        $result = $this->Model->get_user_pass_first_level_option();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 审核 tree
     * @return array
     */
    public function get_pass_tree()
    {
        $result = $this->Model->get_pass_tree();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 站点 审核 tree
     * @return array
     */
    public function get_site_pass_tree()
    {
        $result = $this->Model->get_site_pass_tree();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 会员 审核 tree
     * @return array
     */
    public function get_user_pass_tree()
    {
        $result = $this->Model->get_user_pass_tree();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 审核 cascader
     * @return array
     */
    public function get_pass_cascader()
    {
        $result = $this->Model->get_pass_cascader();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 站点 审核 cascader
     * @return array
     */
    public function get_site_pass_cascader()
    {
        $result = $this->Model->get_site_pass_cascader();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 获取 会员 审核 cascader
     * @return array
     */
    public function get_user_pass_cascader()
    {
        $result = $this->Model->get_user_pass_cascader();
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 基础 更新 密码
     * @param $app_enum_type
     * @return array
     */
    private function base_update_password($app_enum_type)
    {
        $action = $app_enum_type . '_update_password';

        $result = $this->Logic->$action($this->post);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 后台 更新 密码
     * @return array
     */
    public function admin_update_password()
    {
        $result = $this->base_update_password(AppEnum::admin['enum_type']);

        return $result;
    }

    /**
     * 站点 更新 密码
     * @return array
     */
    public function site_update_password()
    {
        $result = $this->base_update_password(AppEnum::site['enum_type']);

        return $result;
    }

    /**
     * 会员 更新 密码
     * @return array
     */
    public function user_update_password()
    {
        $result = $this->base_update_password(AppEnum::user['enum_type']);

        return $result;
    }

    /**
     * 基础 保存 数据
     * @param $app_enum_type
     * @return array
     */
    private function base_save_data($app_enum_type)
    {
        $action = $app_enum_type . '_save_data';

        $result = $this->Logic->$action($this->post);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 后台 保存 数据
     * @return array
     */
    public function admin_save_data()
    {
        $result = $this->base_save_data(AppEnum::admin['enum_type']);

        return $result;
    }

    /**
     * 站点 保存 数据
     * @return array
     */
    public function site_save_data()
    {
        $result = $this->base_save_data(AppEnum::site['enum_type']);

        return $result;
    }

    /**
     * 会员 保存 数据
     * @return array
     */
    public function user_save_data()
    {
        $result = $this->base_save_data(AppEnum::user['enum_type']);

        return $result;
    }

    /**
     * 基础 删除 数据
     * @param $app_enum_type
     * @return array
     */
    private function base_delete_data($app_enum_type)
    {
        $id = isset($this->post['id']) ? $this->post['id'] : 0;
        $action = $app_enum_type . '_delete_data';

        $result = $this->Logic->$action($id);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 后台 删除 数据
     * @return array
     */
    public function admin_delete_data()
    {
        $result = $this->base_delete_data(AppEnum::admin['enum_type']);

        return $result;
    }

    /**
     * 站点 删除 数据
     * @return array
     */
    public function site_delete_data()
    {
        $result = $this->base_delete_data(AppEnum::site['enum_type']);

        return $result;
    }

    /**
     * 会员 删除 数据
     * @return array
     */
    public function user_delete_data()
    {
        $result = $this->base_delete_data(AppEnum::user['enum_type']);

        return $result;
    }

    /**
     * 基础 更新 排序
     * @param $app_enum_type
     * @return array
     */
    private function base_update_sort($app_enum_type)
    {
        $action = $app_enum_type . '_update_sort';

        $result = $this->Logic->$action($this->post);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 后台 更新 排序
     * @return array
     */
    public function admin_update_sort()
    {
        $result = $this->base_update_sort(AppEnum::admin['enum_type']);

        return $result;
    }

    /**
     * 站点 更新 排序
     * @return array
     */
    public function site_update_sort()
    {
        $result = $this->base_update_sort(AppEnum::site['enum_type']);

        return $result;
    }

    /**
     * 会员 更新 排序
     * @return array
     */
    public function user_update_sort()
    {
        $result = $this->base_update_sort(AppEnum::user['enum_type']);

        return $result;
    }

    /**
     * 基础 更新 是否 审核
     * @param $app_enum_type
     * @return array
     */
    private function base_update_is_pass($app_enum_type)
    {
        $id = $this->post['id'];
        $is_pass = $this->post['is_pass'];

        $action = $app_enum_type . '_update_is_pass';

        $result = $this->Logic->$action($id, $is_pass);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 后台 更新 是否 审核
     * @return array
     */
    public function admin_update_is_pass()
    {
        $result = $this->base_update_is_pass(AppEnum::admin['enum_type']);

        return $result;
    }

    /**
     * 站点 更新 是否 审核
     * @return array
     */
    public function site_update_is_pass()
    {
        $result = $this->base_update_is_pass(AppEnum::site['enum_type']);

        return $result;
    }

    /**
     * 会员 更新 是否 审核
     * @return array
     */
    public function user_update_is_pass()
    {
        $result = $this->base_update_is_pass(AppEnum::user['enum_type']);

        return $result;
    }

    /**
     * 基础 更新 是否 推荐
     * @param $app_enum_type
     * @return array
     */
    private function base_update_is_commend($app_enum_type)
    {
        $id = $this->post['id'];
        $is_commend = $this->post['is_commend'];

        $action = $app_enum_type . '_update_is_commend';

        $result = $this->Logic->$action($id, $is_commend);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 后台 更新 是否 推荐
     * @return array
     */
    public function admin_update_is_commend()
    {
        $result = $this->base_update_is_commend(AppEnum::admin['enum_type']);

        return $result;
    }

    /**
     * 站点 更新 是否 推荐
     * @return array
     */
    public function site_update_is_commend()
    {
        $result = $this->base_update_is_commend(AppEnum::site['enum_type']);

        return $result;
    }

    /**
     * 会员 更新 是否 推荐
     * @return array
     */
    public function user_update_is_commend()
    {
        $result = $this->base_update_is_commend(AppEnum::user['enum_type']);

        return $result;
    }

    /**
     * 基础 更新 是否 最新、新品
     * @param $app_enum_type
     * @return array
     */
    private function base_update_is_new($app_enum_type)
    {
        $id = $this->post['id'];
        $is_new = $this->post['is_new'];

        $action = $app_enum_type . '_update_is_new';

        $result = $this->Logic->$action($id, $is_new);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 后台 更新 是否 最新、新品
     * @return array
     */
    public function admin_update_is_new()
    {
        $result = $this->base_update_is_new(AppEnum::admin['enum_type']);

        return $result;
    }

    /**
     * 站点 更新 是否 最新、新品
     * @return array
     */
    public function site_update_is_new()
    {
        $result = $this->base_update_is_new(AppEnum::site['enum_type']);

        return $result;
    }

    /**
     * 会员 更新 是否 最新、新品
     * @return array
     */
    public function user_update_is_new()
    {
        $result = $this->base_update_is_new(AppEnum::user['enum_type']);

        return $result;
    }

    /**
     * 基础 更新 是否 热点、热卖
     * @param $app_enum_type
     * @return array
     */
    private function base_update_is_hot($app_enum_type)
    {
        $id = $this->post['id'];
        $is_hot = $this->post['is_hot'];

        $action = $app_enum_type . '_update_is_hot';

        $result = $this->Logic->$action($id, $is_hot);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 后台 更新 是否 热点、热卖
     * @return array
     */
    public function admin_update_is_hot()
    {
        $result = $this->base_update_is_hot(AppEnum::admin['enum_type']);

        return $result;
    }

    /**
     * 站点 更新 是否 热点、热卖
     * @return array
     */
    public function site_update_is_hot()
    {
        $result = $this->base_update_is_hot(AppEnum::site['enum_type']);

        return $result;
    }

    /**
     * 会员 更新 是否 热点、热卖
     * @return array
     */
    public function user_update_is_hot()
    {
        $result = $this->base_update_is_hot(AppEnum::user['enum_type']);

        return $result;
    }

    /**
     * 基础 更新 是否 置顶
     * @param $app_enum_type
     * @return array
     */
    private function base_update_is_top($app_enum_type)
    {
        $id = $this->post['id'];
        $is_top = $this->post['is_top'];

        $action = $app_enum_type . '_update_is_top';

        $result = $this->Logic->$action($id, $is_top);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 后台 更新 是否 置顶
     * @return array
     */
    public function admin_update_is_top()
    {
        $result = $this->base_update_is_top(AppEnum::admin['enum_type']);

        return $result;
    }

    /**
     * 站点 更新 是否 置顶
     * @return array
     */
    public function site_update_is_top()
    {
        $result = $this->base_update_is_top(AppEnum::site['enum_type']);

        return $result;
    }

    /**
     * 会员 更新 是否 置顶
     * @return array
     */
    public function user_update_is_top()
    {
        $result = $this->base_update_is_top(AppEnum::user['enum_type']);

        return $result;
    }

    /**
     * 基础 更新 是否 首页显示
     * @param $app_enum_type
     * @return array
     */
    private function base_update_is_index($app_enum_type)
    {
        $id = $this->post['id'];
        $is_index = $this->post['is_index'];

        $action = $app_enum_type . '_update_is_index';

        $result = $this->Logic->$action($id, $is_index);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 后台 更新 是否 首页显示
     * @return array
     */
    public function admin_update_is_index()
    {
        $result = $this->base_update_is_index(AppEnum::admin['enum_type']);

        return $result;
    }

    /**
     * 站点 更新 是否 首页显示
     * @return array
     */
    public function site_update_is_index()
    {
        $result = $this->base_update_is_index(AppEnum::site['enum_type']);

        return $result;
    }

    /**
     * 基础 更新 是否 默认
     * @param $app_enum_type
     * @return array
     */
    private function base_update_is_default($app_enum_type)
    {
        $id = $this->post['id'];
        $is_default = $this->post['is_default'];

        $action = $app_enum_type . '_update_is_default';

        $result = $this->Logic->$action($id, $is_default);
        $result = $this->get_api_result($result);

        return $result;
    }

    /**
     * 后台 更新 是否 默认
     * @return array
     */
    public function admin_update_is_default()
    {
        $result = $this->base_update_is_default(AppEnum::admin['enum_type']);

        return $result;
    }

    /**
     * 站点 更新 是否 默认
     * @return array
     */
    public function site_update_is_default()
    {
        $result = $this->base_update_is_default(AppEnum::site['enum_type']);

        return $result;
    }

    /**
     * 会员 更新 是否 默认
     * @return array
     */
    public function user_update_is_default()
    {
        $result = $this->base_update_is_default(AppEnum::user['enum_type']);

        return $result;
    }
}