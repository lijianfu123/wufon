<?php

namespace app\common\logic;

/**
 * 省 / 市 / 县 - 逻辑
 * Class CityLogic
 * @package app\common\logic
 */
class CityLogic extends BaseLogic
{
    /**
     * 构造方法
     * CityLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'city_name' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'city_name.require' => '名称为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}