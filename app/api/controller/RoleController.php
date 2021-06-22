<?php

namespace app\api\controller;

use app\common\enum\AppEnum;

/**
 * api > 角色
 * Class RoleController
 * @package app\api\controller
 */
class RoleController extends BaseController
{
    /**
     * 获取 基础 应用 任意 列表
     * @param $app_enum_type
     * @return mixed
     */
    private function get_base_app_any_list($app_enum_type)
    {
        $action = 'get_' . $app_enum_type . '_app_any_list';
        $list = $this->Model->$action();
        $result = $this->get_api_result($list);

        return $result;
    }

    /**
     * 获取 后台 应用 任意 列表
     * @return mixed
     */
    public function get_admin_app_any_list()
    {
        $list = $this->get_base_app_any_list(AppEnum::admin['enum_type']);

        return $list;
    }

    /**
     * 获取 后台 应用 任意 列表
     * @return mixed
     */
    public function get_user_app_any_list()
    {
        $list = $this->get_base_app_any_list(AppEnum::user['enum_type']);

        return $list;
    }

    /**
     * 获取 基础 应用 审核 option
     * @param $app_enum_type
     * @return array
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
     * @return array
     */
    public function get_admin_app_pass_option()
    {
        $option = $this->get_base_app_pass_option(AppEnum::admin['enum_type']);

        return $option;
    }

    /**
     * 获取 站点 应用 审核 option
     * @return array
     */
    public function get_site_app_pass_option()
    {
        $option = $this->get_base_app_pass_option(AppEnum::site['enum_type']);

        return $option;
    }

    /**
     * 获取 会员 应用 审核 option
     * @return array
     */
    public function get_user_app_pass_option()
    {
        $option = $this->get_base_app_pass_option(AppEnum::user['enum_type']);

        return $option;
    }
}