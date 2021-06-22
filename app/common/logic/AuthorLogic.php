<?php

namespace app\common\logic;

/**
 * 作者 - 逻辑
 * Class AuthorLogic
 * @package app\common\logic
 */
class AuthorLogic extends BaseLogic
{
    /**
     * 构造方法
     * AuthorLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'author_name' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'author_name.require' => '作者名称为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}