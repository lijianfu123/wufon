<?php

namespace app\common\logic;

/**
 * 下载分类 - 逻辑
 * Class DownloadClassLogic
 * @package app\common\logic
 */
class DownloadClassLogic extends BaseLogic
{
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'download_class_name' => 'require',
            'list_view_path' => 'require',
            'detail_view_path' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'download_class_name.require' => '下载分类名称为空',
            'list_view_path.require' => '列表页模板为空',
            'detail_view_path.require' => '详情页模板为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}