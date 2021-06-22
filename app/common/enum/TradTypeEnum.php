<?php

namespace app\common\enum;

/**
 * 交易类型 - 枚举
 * Class TradTypeEnum
 * @package app\common\enum
 */
class TradTypeEnum extends BaseEnum
{
    const order = ['enum_number' => 1, 'enum_name' => '充值', 'enum_type' => 'order'];
    const recharge = ['enum_number' => 1, 'enum_name' => '充值', 'enum_type' => 'recharge'];
}