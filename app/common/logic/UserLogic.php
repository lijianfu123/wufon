<?php

namespace app\common\logic;

/**
 * 会员 - 逻辑
 * Class UserLogic
 * @package app\common\logic
 */
class UserLogic extends BaseLogic
{
    /**
     * 构造方法
     * UserLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            //'user_level_id' => 'require|integer|gt:0',
            'username' => 'require|min:3|unique:user',
            //'password' => 'require|min:6|confirm',

            //'tel' => 'require|unique:user',
        ];

        $this->validate_message = [
            //'user_level_id.require' => '会员级别 id 为空',
            //'user_level_id.integer' => '会员级别 id 必须是数字',
            //'user_level_id.gt' => '请选择会员级别',

            'username.require' => '用户名为空',
            'username.min' => '用户名小于 3 位',
            'username.unique' => '已存在的用户名',

            'password.require' => '密码为空',
            'password.min' => '密码小于 6 位',
            'password.confirm' => '两次输入的密码不同',

            //'tel.require' => '手机号码为空',
            //'tel.unique' => '已注册的手机号'
        ];
    }
}