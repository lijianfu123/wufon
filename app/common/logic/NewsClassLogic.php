<?php

namespace app\common\logic;

/**
 * 新闻分类 - 逻辑
 * Class NewsClassLogic
 * @package app\common\logic
 */
class NewsClassLogic extends BaseLogic
{
    /**
     * 构造方法
     * NewsClassLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'news_class_name' => 'require',
            'list_view_path' => 'require',
            'detail_view_path' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'news_class_name.require' => '新闻分类名称为空',
            'list_view_path.require' => '列表页模板为空',
            'detail_view_path.require' => '详情页模板为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}