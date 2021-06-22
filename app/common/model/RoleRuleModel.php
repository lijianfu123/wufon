<?php

namespace app\common\model;

use app\common\enum\AppEnum;
use think\facade\Db;

/**
 * 权限规则 - 模型
 * Class RoleRuleModel
 * @package app\common\model
 */
class RoleRuleModel extends BaseModel
{
    protected $name = 'role_rule';

    /**
     * 构造方法
     * RoleRuleModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->max_level = 3; //最大层级数
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
            'first_role_rule_id' => 0,
            'second_role_rule_id' => 0,
            'sort' => $this->get_any_sort()
        ];
    }

    /**
     * 获取 面包屑
     * @param $module_url
     * @return array
     */
    public function get_breadcrumb($module_url)
    {
        $role_rule_table = DB_PREFIX . 'role_rule';

        $sql = "select role_rule_name as third_role_rule_name,
                (select role_rule_name from $role_rule_table where id = role_rule.first_role_rule_id) as first_role_rule_name,
                (select role_rule_name from $role_rule_table where id = role_rule.second_role_rule_id) as second_role_rule_name
            from $role_rule_table as role_rule
            where (`level` = 3) and (module_url = '$module_url')";

        $list = Db::query($sql);

        if (count($list) == 0) {
            return [
                'first_role_rule_name' => '',
                'second_role_rule_name' => '',
                'third_role_rule_name' => ''
            ];
        } else {
            return $list[0];
        }
    }

    /**
     * 获取 基础 应用 任意 tree 列表
     * @param $app_enum_number
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function get_base_app_any_tree_list($app_enum_number)
    {
        $where = [
            ['app_enum_number', '=', $app_enum_number]
        ];

        $tree_list = $this->get_base_tree_list($where);

        return $tree_list;
    }

    /**
     * 获取 后台 应用 任意 tree 列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_admin_app_any_tree_list()
    {
        $tree_list = $this->get_base_app_any_tree_list(AppEnum::admin['enum_number']);

        return $tree_list;
    }

    /**
     * 获取 站点 应用 任意 tree 列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_site_app_any_tree_list()
    {
        $tree_list = $this->get_base_app_any_tree_list(AppEnum::site['enum_number']);

        return $tree_list;
    }

    /**
     * 获取 会员 应用 任意 tree 列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_user_app_any_tree_list()
    {
        $tree_list = $this->get_base_app_any_tree_list(AppEnum::user['enum_number']);

        return $tree_list;
    }

    /**
     * 获取 基础 应用 审核 tree
     * @param $app_enum_number
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function get_base_app_pass_tree($app_enum_number)
    {
        $where = [
            ['is_pass', '=', 1],
            ['app_enum_number', '=', $app_enum_number]
        ];

        $tree = $this->get_base_tree($where);

        return $tree;
    }

    /**
     * 获取 后台 应用 审核 tree
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_admin_app_pass_tree()
    {
        $tree = $this->get_base_app_pass_tree(AppEnum::admin['enum_number']);

        return $tree;
    }

    /**
     * 获取 站点 应用 审核 tree
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_site_app_pass_tree()
    {
        $tree = $this->get_base_app_pass_tree(AppEnum::site['enum_number']);

        return $tree;
    }

    /**
     * 获取 会员 应用 审核 tree
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_user_app_pass_tree()
    {
        $tree = $this->get_base_app_pass_tree(AppEnum::user['enum_number']);

        return $tree;
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
            ['is_pass', '=', 1],
            ['level', 'in', [1, 2]],
            ['app_enum_number', '=', $app_enum_number]
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