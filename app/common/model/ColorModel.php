<?php

namespace app\common\model;

/**
 * 颜色 - 模型
 * Class ColorModel
 * @package app\common\model
 */
class ColorModel extends BaseModel
{
    protected $name = 'color';

    /**
     * 构造方法
     * ColorModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->order = 'sort ace, id asc';
    }

    /**
     * 获取 添加 默认数据
     * @return array
     */
    public function get_insert_default_detail()
    {
        return [
            'id' => 0,
            'is_pass' => 1,
            'sort' => $this->get_site_sort()
        ];
    }
}