<?php

namespace app\common\model;

/**
 * 通知公告 - 模型
 * Class NoticeModel
 * @package app\common\model
 */
class NoticeModel extends BaseModel
{
    protected $name = 'notice';

    /**
     * 构造方法
     * NoticeModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->order = 'id desc'; //排序
    }

    /**
     * 获取 添加 默认数据
     * @return array
     */
    public function get_insert_default_detail()
    {
        return [
            'id' => 0,
            'is_pass' => 1
        ];
    }
}