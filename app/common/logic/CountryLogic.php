<?php

namespace app\common\logic;

/**
 * 国家 - 逻辑
 * Class AdLogic
 * @package app\common\logic
 */
class CountryLogic extends BaseLogic
{
    /**
     * 构造方法
     * CountryLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'country_name' => 'require',
            'country_code' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'country_name.require' => '国家名称为空',
            'country_code.require' => '国家编码为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}