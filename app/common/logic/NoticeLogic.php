<?php

namespace app\common\logic;

/**
 * 通知公告 - 逻辑
 * Class NoticeLogic
 * @package app\common\logic
 */
class NoticeLogic extends BaseLogic
{
    /**
     * 构造方法
     * NoticeLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'notice_name' => 'require',
            'content' => 'require'
        ];

        $this->validate_message = [
            'notice_name.require' => '公告标题为空',
            'content.require' => '公告内容为空'
        ];
    }
}