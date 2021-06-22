<?php

namespace app\common\logic;

/**
 * 颜色 - 逻辑
 * Class ColorLogic
 * @package app\common\logic
 */
class ColorLogic extends BaseLogic
{
    /**
     * 构造方法
     * ColorLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'color_name' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'color_name.require' => '颜色名称为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}