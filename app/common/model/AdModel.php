<?php

namespace app\common\model;

/**
 * 广告 - 模型
 * Class AdModel
 * @package app\common\model
 */
class AdModel extends BaseModel
{
    protected $name = 'ad';

    /**
     * 构造方法
     * AdModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->order = 'sort asc, id asc'; //排序
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