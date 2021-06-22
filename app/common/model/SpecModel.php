<?php

namespace app\common\model;

/**
 * 规格 - 模型
 * Class SpecModel
 * @package app\common\model
 */
class SpecModel extends BaseModel
{
    protected $name = 'spec';

    /**
     * 构造方法
     * SpecModel constructor.
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