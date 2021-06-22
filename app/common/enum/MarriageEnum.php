<?php

namespace app\common\enum;

/**
 * 婚姻状况 - 枚举
 * Class MarriageEnum
 * @package app\common\enum
 */
class MarriageEnum extends BaseEnum
{
    const single = ['enum_number' => 1, 'enum_name' => '未婚', 'enum_type' => 'single'];
    const married = ['enum_number' => 2, 'enum_name' => '已婚', 'enum_type' => 'married'];
    const divorced = ['enum_number' => 3, 'enum_name' => '离异', 'enum_type' => 'divorced'];
    const widowed = ['enum_number' => 4, 'enum_name' => '丧偶', 'enum_type' => 'widowed'];
}