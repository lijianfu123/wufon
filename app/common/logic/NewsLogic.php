<?php

namespace app\common\logic;

/**
 * 新闻 - 逻辑
 * Class NewsLogic
 * @package app\common\logic
 */
class NewsLogic extends BaseLogic
{
    /**
     * 构造方法
     * NewsClassLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'news_name' => 'require'
        ];

        $this->validate_message = [
            'news_name.require' => '标题为空'
        ];
    }
}