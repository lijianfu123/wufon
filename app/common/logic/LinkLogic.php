<?php

namespace app\common\logic;

/**
 * 友情链接 - 逻辑
 * Class LinkLogic
 * @package app\common\logic
 */
class LinkLogic extends BaseLogic
{
    /**
     * 构造方法
     * LinkLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'link_name' => 'require',
            'url' => 'require',
            'width' => 'require|integer',
            'height' => 'require|integer',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'link_name.require' => '链接名称为空',
            'url.require' => '链接地址为空',

            'width.require' => '宽度为空',
            'width.integer' => '宽度必须是数字',

            'height.require' => '高度为空',
            'height.integer' => '高度必须是数字',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}