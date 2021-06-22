<?php

namespace app\common\enum;

/**
 * 购物车类型 - 枚举
 * Class CartTypeEnum
 * @package app\common\enum
 */
class CartTypeEnum extends BaseEnum
{
    const buy = ['enum_number' => 1, 'enum_name' => '直接购买', 'enum_type' => 'buy'];
    const cart = ['enum_number' => 2, 'enum_name' => '购物车', 'enum_type' => 'cart'];
}