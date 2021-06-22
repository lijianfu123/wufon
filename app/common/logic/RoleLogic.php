<?php

namespace app\common\logic;

/**
 * 角色 - 逻辑
 * Class RoleLogic
 * @package app\common\logic
 */
class RoleLogic extends BaseLogic
{
    /**
     * 构造方法
     * RoleLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'role_name' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'role_name.require' => '角色名称为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}