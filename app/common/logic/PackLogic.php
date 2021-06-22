<?php

namespace app\common\logic;

/**
 * 包装单位 - 逻辑
 * Class PackLogic
 * @package app\common\logic
 */
class PackLogic extends BaseLogic
{
    /**
     * 构造方法
     * PackLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'pack_name' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'pack_name.require' => '包装单位为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}