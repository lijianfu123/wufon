<?php

namespace app\common\enum;

/**
 * 政治面貌 - 枚举
 * Class PoliticalEnum
 * @package app\common\enum
 */
class PoliticalEnum extends BaseEnum
{
    const people = ['enum_number' => 1, 'enum_name' => '群众', 'enum_type' => 'people'];
    const league = ['enum_number' => 2, 'enum_name' => '团员', 'enum_type' => 'league'];
    const communist = ['enum_number' => 3, 'enum_name' => '党员', 'enum_type' => 'communist'];
    const democratic = ['enum_number' => 4, 'enum_name' => '民主党派', 'enum_type' => 'democratic'];
}