<?php

namespace app\common\model;

/**
 * 幻灯片 - 模型
 * Class SwiperModel
 * @package app\common\model
 */
class SwiperModel extends BaseModel
{
    protected $name = 'swiper';
    protected $json = ['image_list_json']; //json 字段

    /**
     * 构造方法
     * SwiperModel constructor.
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
            'image_list_json' => [],
            'sort' => $this->get_site_sort()
        ];
    }
}