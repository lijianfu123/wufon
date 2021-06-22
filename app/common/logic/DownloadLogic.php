<?php

namespace app\common\logic;

/**
 * 下载 - 逻辑
 * Class DownloadLogic
 * @package app\common\logic
 */
class DownloadLogic extends BaseLogic
{
    /**
     * 构造方法
     * DownloadLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'download_name' => 'require'
        ];

        $this->validate_message = [
            'download_name.require' => '下载标题为空'
        ];
    }
}