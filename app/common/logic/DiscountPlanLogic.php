<?php

namespace app\common\logic;

/**
 * 优惠套餐 - 逻辑
 * Class DiscountPlanLogic
 * @package app\common\logic
 */
class DiscountPlanLogic extends BaseLogic
{
    /**
     * 构造方法
     * DiscountPlanLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'discount_plan_name' => 'require',
            'product_money' => 'require|float|gt:0',
            'discount_money' => 'require|float|gt:0',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'discount_plan_name.require' => '优惠套餐为空',

            'product_money.require' => '订单商品金额为空',
            'product_money.float' => '订单商品金额必须是数字',
            'product_money.gt' => '订单商品金额最小为 0.1',

            'discount_money.require' => '优惠金额为空',
            'discount_money.float' => '优惠金额必须是数字',
            'discount_money.gt' => '优惠金额最小为 0.01',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}