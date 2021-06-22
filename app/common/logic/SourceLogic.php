<?php

namespace app\common\logic;

/**
 * 来源 - 逻辑
 * Class SourceLogic
 * @package app\common\logic
 */
class SourceLogic extends BaseLogic
{
    /**
     * 构造方法
     * SourceLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'source_name' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'source_name.require' => '来源名称为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}