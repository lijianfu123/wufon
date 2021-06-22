<?php

namespace app\common\enum;

/**
 * 运费类型 - 枚举
 * Class ExpressMoneyTypeEnum
 * @package app\common\enum
 */
class ExpressMoneyTypeEnum extends BaseEnum
{
    const free = ['enum_number' => 1, 'enum_name' => '包邮', 'enum_type' => 'free'];
    const paid = ['enum_number' => 2, 'enum_name' => '实付', 'enum_type' => 'paid'];
    const deliver = ['enum_number' => 3, 'enum_name' => '到付', 'enum_type' => 'collect'];
    const full_free = ['enum_number' => 4, 'enum_name' => '满额包邮', 'enum_type' => 'full_free'];
}