<?php

namespace app\common\logic;

/**
 * 适用人群 - 逻辑
 * Class PeopleLogic
 * @package app\common\logic
 */
class PeopleLogic extends BaseLogic
{
    /**
     * 构造方法
     * PeopleLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'people_name' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'people_name.require' => '适用人群为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}