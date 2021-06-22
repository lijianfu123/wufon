<?php

namespace app\common\enum;

/**
 * 缓存 json - 枚举
 * Class CacheJsonEnum
 * @package app\common\enum
 */
class CacheJsonEnum extends BaseEnum
{
    const option = ['enum_number' => 1, 'enum_name' => '选项', 'enum_type' => 'option'];
    const cascader = ['enum_number' => 2, 'enum_name' => '联级', 'enum_type' => 'cascader'];
}