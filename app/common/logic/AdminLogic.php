<?php

namespace app\common\logic;

/**
 * 后台管理员 - 逻辑
 * Class AdminLogic
 * @package app\common\logic
 */
class AdminLogic extends BaseLogic
{
    /**
     * 构造方法
     * AdminLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'username' => 'require|unique:admin',
            'role_id' => 'require|integer|gt:0',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'username.require' => '用户名为空',
            'username.unique' => '用户名已存在',

            'role_id.require' => '角色 id 为空',
            'role_id.integer' => '角色 id 必须是数字',
            'role_id.gt' => '请选择角色',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}