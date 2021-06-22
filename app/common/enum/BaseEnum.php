<?php

namespace app\common\enum;

use ReflectionClass;

/**
 * 基类 - 枚举
 * Class BaseEnum
 * @package app\common\enum
 */
class BaseEnum
{
    protected static $list = [];

    /**
     * 构造方法
     * BaseEnum constructor.
     * @param string $class_name
     * @throws \ReflectionException
     */
    public function __construct($class_name)
    {
        $class = new ReflectionClass($class_name);
        self::$list = $class->getConstants();
    }

    /**
     * 获取 枚举 tree
     * @return array
     * @throws \ReflectionException
     */
    public static function get_enum_tree()
    {
        new self(static::class);

        $arr = [];

        foreach (self::$list as $key => $value) {
            $arr[] = [
                'enum_number' => $value['enum_number'],
                'value' => $value['enum_number'],
                'label' => $value['enum_name'],
            ];
        }

        $arr_0 = [[
            'enum_number' => 0,
            'value' => 0,
            'label' => '全部',
            'children' => $arr
        ]];

        return $arr_0;
    }

    /**
     * 获取 枚举 列表
     * @return array
     * @throws \ReflectionException
     */
    public static function get_enum_list()
    {
        new self(static::class);

        $arr = [];

        foreach (self::$list as $key => $value) {
            $arr[] = $value;
        }

        return $arr;
    }

    /**
     * 获取 枚举 option
     * @return array
     * @throws \ReflectionException
     */
    public static function get_enum_option()
    {
        new self(static::class);

        $arr = [];

        foreach (self::$list as $key => $value) {
            $arr[] = $value;
        }

        return $arr;
    }

    /**
     * 获取 枚举 名称
     * @param $enum_number
     * @return string
     * @throws \ReflectionException
     */
    public static function get_enum_name($enum_number)
    {
        new self(static::class);

        $name = '';

        foreach (self::$list as $value) {
            if ($value['enum_number'] == $enum_number) {
                $name = $value['enum_name'];

                break;
            }
        }

        return $name;
    }
}