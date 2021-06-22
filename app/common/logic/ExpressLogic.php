<?php

namespace app\common\logic;

/**
 * 快递 - 逻辑
 * Class ExpressLogic
 * @package app\common\logic
 */
class ExpressLogic extends BaseLogic
{
    /**
     * 构造方法
     * ExpressLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'express_name' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'express_name.require' => '快递名称为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}