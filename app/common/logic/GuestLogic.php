<?php

namespace app\common\logic;

/**
 * 留言
 * Class GuestLogic
 * @package app\common\logic
 */
class GuestLogic extends BaseLogic
{
    /**
     * 构造方法
     * DownloadLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'content' => 'require'
        ];

        $this->validate_message = [
            'content.require' => '留言内容为空'
        ];
    }
}