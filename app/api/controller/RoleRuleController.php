<?php

namespace app\api\controller;

use app\common\enum\AppEnum;

/**
 * api > 权限规则
 * Class RoleRuleController
 * @package app\api\controller
 */
class RoleRuleController extends BaseController
{
    /**
     * 获取 面包屑
     * @return array
     * @throws \think\db\exception\BindParamException
     * @throws \think\db\exception\PDOException
     */
    public function get_breadcrumb()
    {
        $arr = explode('/', $this->app['referer_url']);

        $app_enum_type = $arr['3'];
        $controller = $arr[4];

        if (count($arr) >= 6) {
            $action = $arr[5];
            if ($action == '') {
                $action = 'index';
            }
        } else {
            $action = 'index';
        }

        $module_url = '/' . $app_enum_type . '/' . $controller . '/' . $action;
        $breadcrumb = $this->Model->get_breadcrumb($module_url);
        $result = $this->get_api_result($breadcrumb);

        return $result;
    }

    /**
     * 获取 基础 应用 任意 tree 列表
     * @param $app_enum_type
     * @return mixed
     */
    private function get_base_app_any_tree_list($app_enum_type)
    {
        $action = 'get_' . $app_enum_type . '_app_any_tree_list';
        $tree_list = $this->Model->$action();

        $result = $this->get_api_result($tree_list);

        return $result;
    }

    /**
     * 获取 后台 应用 任意 tree 列表
     * @return mixed
     */
    public function get_admin_app_any_tree_list()
    {
        $tree_list = $this->get_base_app_any_tree_list(AppEnum::admin['enum_type']);

        return $tree_list;
    }

    /**
     * 获取 站点 应用 任意 tree 列表
     * @return mixed
     */
    public function get_site_app_any_tree_list()
    {
        $tree_list = $this->get_base_app_any_tree_list(AppEnum::site['enum_type']);

        return $tree_list;
    }

    /**
     * 获取 会员 应用 任意 tree 列表
     * @return mixed
     */
    public function get_user_app_any_tree_list()
    {
        $tree_list = $this->get_base_app_any_tree_list(AppEnum::user['enum_type']);

        return $tree_list;
    }

    /**
     * 获取 基础 应用 审核 tree
     * @param $app_enum_type
     * @return mixed
     */
    private function get_base_app_pass_tree($app_enum_type)
    {
        $action = 'get_' . $app_enum_type . '_app_pass_tree';
        $tree_list = $this->Model->$action();
        $result = $this->get_api_result($tree_list);

        return $result;
    }

    /**
     * 获取 后台 应用 审核 tree
     * @return mixed
     */
    public function get_admin_app_pass_tree()
    {
        $tree_list = $this->get_base_app_pass_tree(AppEnum::admin['enum_type']);

        return $tree_list;
    }

    /**
     * 获取 站点 应用 审核 tree
     * @return mixed
     */
    public function get_site_app_pass_tree()
    {
        $tree_list = $this->get_base_app_pass_tree(AppEnum::site['enum_type']);

        return $tree_list;
    }

    /**
     * 获取 会员 应用 审核 tree
     * @return mixed
     */
    public function get_user_app_pass_tree()
    {
        $tree_list = $this->get_base_app_pass_tree(AppEnum::user['enum_type']);

        return $tree_list;
    }

    /**
     * 获取 基础 应用 审核 option
     * @param $app_enum_type
     * @return mixed
     */
    private function get_base_app_pass_option($app_enum_type)
    {
        $action = 'get_' . $app_enum_type . '_app_pass_option';
        $option = $this->Model->$action();
        $result = $this->get_api_result($option);

        return $result;
    }

    /**
     * 获取 后台 应用 审核 option
     * @return mixed
     */
    public function get_admin_app_pass_option()
    {
        $option = $this->get_base_app_pass_option(AppEnum::admin['enum_type']);

        return $option;
    }

    /**
     * 获取 站点 应用 审核 option
     * @return mixed
     */
    public function get_site_app_pass_option()
    {
        $option = $this->get_base_app_pass_option(AppEnum::site['enum_type']);

        return $option;
    }

    /**
     * 获取 会员 应用 审核 option
     * @return mixed
     */
    public function get_user_app_pass_option()
    {
        $option = $this->get_base_app_pass_option(AppEnum::user['enum_type']);

        return $option;
    }

    /**
     * 保存 权限规则
     * @return array
     */
    public function save_role_rule()
    {
        $result = $this->Logic->save_role_rule($this->post);
        $result = $this->get_api_result($result);

        return $result;
    }
}