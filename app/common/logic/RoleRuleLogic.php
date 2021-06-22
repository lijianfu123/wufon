<?php

namespace app\common\logic;

/**
 * 权限规则 - 逻辑
 * Class RoleRuleLogic
 * @package app\common\logic
 */
class RoleRuleLogic extends BaseLogic
{
    /**
     * 构造方法
     * RoleRuleLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'role_rule_name' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'role_rule_name.require' => '权限规则名称为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }

    /**
     * 保存 权限规则
     * @param $data
     * @return array|bool
     */
    public function save_role_rule($data)
    {
        //数据验证
        $validate_data = $this->validate_data($data);
        if ($validate_data !== true) {
            return $validate_data;
        }

        //level 层级
        if (($data['root_id'] == 0) && ($data['parent_id'] == 0)) {
            $data['level'] = 1;
        } else {
            if ($data['parent_id'] == 0) {
                $data['level'] = 2;
            } else {
                $data['level'] = 3;
            }
        }

        $result = $this->Model->save_data($data);

        return $result;
    }
}