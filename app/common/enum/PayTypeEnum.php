<?php

namespace app\common\enum;

/**
 * 付款方式 - 枚举
 * Class PayTypeEnum
 * @package app\common\enum
 */
class PayTypeEnum extends BaseEnum
{
    const wechat = ['enum_number' => 1, 'enum_name' => '微信', 'enum_type' => 'wechat'];
    const alipay = ['enum_number' => 2, 'enum_name' => '支付宝', 'enum_type' => 'alipay'];
    const cash = ['enum_number' => 3, 'enum_name' => '现金', 'enum_type' => 'cash'];
    const bank_pay = ['enum_number' => 4, 'enum_name' => '网银', 'enum_type' => 'bank_card'];
    const balance = ['enum_number' => 5, 'enum_name' => '余额', 'enum_type' => 'balance'];
    const point = ['enum_number' => 6, 'enum_name' => '积分', 'enum_type' => 'point'];
    const coupon = ['enum_number' => 7, 'enum_name' => '优惠券', 'enum_type' => 'coupon'];
    const deliver = ['enum_number' => 8, 'enum_name' => '货到付款', 'enum_type' => 'deliver'];
    const balance_point = ['enum_number' => 9, 'enum_name' => '余额+积分', 'enum_type' => 'balance_point'];
    const balance_coupon = ['enum_number' => 10, 'enum_name' => '余额+优惠券', 'enum_type' => 'balance_coupon'];
}