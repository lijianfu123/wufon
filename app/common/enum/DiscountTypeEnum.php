<?php

namespace app\common\enum;

/**
 * 优惠类型 - 枚举
 * Class DiscountTypeEnum
 * @package app\common\enum
 */
class DiscountTypeEnum
{
    const discount_plan = ['enum_number' => 1, 'enum_name' => '优惠套餐', 'enum_type' => 'discount_plan'];
    const full_minus = ['enum_number' => 2, 'enum_name' => '满减', 'alias' => '满额立减', 'enum_type' => 'full_minus'];
    const coupon = ['enum_number' => 3, 'enum_name' => '优惠券', 'enum_type' => 'coupon'];
    const group = ['enum_number' => 4, 'enum_name' => '团购', 'enum_type' => 'group'];
    const flash_buy = ['enum_number' => 5, 'enum_name' => '秒杀', 'enum_type' => 'flash_buy'];
}