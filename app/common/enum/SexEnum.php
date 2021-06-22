<?php

namespace app\common\enum;

/**
 * 性别 - 枚举
 * Class SexEnum
 * @package app\common\enum
 */
class SexEnum extends BaseEnum
{
    const man = ['enum_number' => 1, 'enum_name' => '男', 'enum_type' => 'man'];
    const woman = ['enum_number' => 2, 'enum_name' => '女', 'enum_type' => 'woman'];
}