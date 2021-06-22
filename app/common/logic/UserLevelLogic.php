<?php

namespace app\common\logic;

/**
 * 会员级别 - 逻辑
 * Class UserLevelLogic
 * @package app\common\logic
 */
class UserLevelLogic extends BaseLogic
{
    /**
     * 构造方法
     * UserLevelLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'user_level_name' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'user_level_name.require' => '会员级别为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}