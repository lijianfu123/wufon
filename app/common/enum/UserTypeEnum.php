<?php

namespace app\common\enum;

/**
 * 会员类型 - 枚举
 * Class UserTypeEnum
 * @package app\common\enum
 */
class UserTypeEnum extends BaseEnum
{
    const user = ['enum_number' => 1, 'enum_name' => '会员', 'enum_type' => 'user'];
    const shop = ['enum_number' => 2, 'enum_name' => '商家', 'enum_type' => 'shop'];
}