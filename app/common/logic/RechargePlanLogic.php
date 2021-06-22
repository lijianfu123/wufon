<?php

namespace app\common\logic;

/**
 * 充值套餐 - 逻辑
 * Class RechargePlanLogic
 * @package app\common\logic
 */
class RechargePlanLogic extends BaseLogic
{
    /**
     * 构造方法
     * RechargePlanLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'recharge_plan_name' => 'require',
            'recharge_money' => 'require|float|gt:0',
            'account_money' => 'require|float|gt:0',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'recharge_plan_name.require' => '充值套餐为空',

            'recharge_money.require' => '充值金额为空',
            'recharge_money.float' => '充值金额必须是数字',
            'recharge_money.gt' => '充值金额应大于 0',

            'account_money.require' => '到账金额为空',
            'account_money.float' => '到账金额必须是数字',
            'account_money.gt' => '到账金额应大于 0',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}