<?php

namespace app\common\logic;

/**
 * 银行 - 逻辑
 * Class BankLogic
 * @package app\common\logic
 */
class BankLogic extends BaseLogic
{
    /**
     * 构造方法
     * BankLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'bank_name' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'bank_name.require' => '银行名称为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}