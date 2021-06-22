<?php

namespace app\common\model;

/**
 * 友情链接 - 模型
 * Class LinkModel
 * @package app\common\model
 */
class LinkModel extends BaseModel
{
    protected $name = 'link';

    /**
     * 构造方法
     * LinkModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->order = 'sort ace, id asc'; //排序
    }

    /**
     * 获取 添加 默认数据
     * @return array
     */
    public function get_insert_default_detail()
    {
        return [
            'id' => 0,
            'width' => 0,
            'height' => 0,
            'is_pass' => 1,
            'image' => '',
            'sort' => $this->get_site_sort()
        ];
    }
}