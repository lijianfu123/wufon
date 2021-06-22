<?php

namespace app\common\logic;

/**
 * 规格 - 逻辑
 * Class SpecLogic
 * @package app\common\logic
 */
class SpecLogic extends BaseLogic
{
    /**
     * 构造方法
     * SpecLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'spec_name' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'spec_name.require' => '规格名称为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}