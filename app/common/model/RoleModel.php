<?php

namespace app\common\model;

use app\common\enum\AppEnum;

/**
 * 角色 - 模型
 * Class RoleModel
 * @package app\common\model
 */
class RoleModel extends BaseModel
{
    protected $name = 'role';

    /**
     * 构造方法
     * RoleModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->order = 'sort asc, id asc'; //排序
    }

    /**
     * 获取 添加 默认数据
     * @return array
     */
    public function get_insert_default_detail()
    {
        return [
            'id' => 0,
            'is_pass' => 1,
            'is_main_admin' => 0,
            'role_rule_ids' => '',
            'sort' => $this->get_site_sort()
        ];
    }

    /**
     * 获取 基础 应用 任意 列表
     * @param $app_enum_number
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function get_base_app_any_list($app_enum_number)
    {
        $where['app_enum_number'] = $app_enum_number;
        $list = $this->get_base_list($where);

        return $list;
    }

    /**
     * 获取 后台 应用 任意 列表
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_admin_app_any_list()
    {
        $list = $this->get_base_app_any_list(AppEnum::admin['enum_number']);

        return $list;
    }

    /**
     * 获取 站点 应用 任意 列表
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_site_app_any_list()
    {
        $list = $this->get_base_app_any_list(AppEnum::site['enum_number']);

        return $list;
    }

    /**
     * 获取 会员 应用 任意 列表
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_user_app_any_list()
    {
        $list = $this->get_base_app_any_list(AppEnum::user['enum_number']);

        return $list;
    }

    /**
     * 获取 基础 应用 审核 option
     * @param $app_enum_number
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function get_base_app_pass_option($app_enum_number)
    {
        $where = [
            'is_pass' => 1,
            'app_enum_number' => $app_enum_number
        ];

        $option = $this->get_base_option($where);

        return $option;
    }

    /**
     * 获取 后台 应用 审核 option
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_admin_app_pass_option()
    {
        $option = $this->get_base_app_pass_option(AppEnum::admin['enum_number']);

        return $option;
    }

    /**
     * 获取 站点 应用 审核 option
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_site_app_pass_option()
    {
        $option = $this->get_base_app_pass_option(AppEnum::site['enum_number']);

        return $option;
    }

    /**
     * 获取 会员 应用 审核 option
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_user_app_pass_option()
    {
        $option = $this->get_base_app_pass_option(AppEnum::user['enum_number']);

        return $option;
    }
}