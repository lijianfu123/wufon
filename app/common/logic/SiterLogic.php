<?php

namespace app\common\logic;

/**
 * 站点 管理员 - 逻辑
 * Class SiterLogic
 * @package app\common\logic
 */
class SiterLogic extends BaseLogic
{
    /**
     * 构造方法
     * SiterLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'role_id' => 'require|integer|gt:0',
            'username' => 'require|unique:siter',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'role_id.require' => '角色 id 为空',
            'role_id.integer' => '角色 id 必须是数字',
            'role_id.gt' => '请选择角色',

            'username.require' => '用户名为空',
            'username.unique' => '用户名已存在',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}