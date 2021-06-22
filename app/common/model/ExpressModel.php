<?php

namespace app\common\model;

/**
 * 快递 - 模型
 * Class ExpressModel
 * @package app\common\model
 */
class ExpressModel extends BaseModel
{
    protected $name = 'express';

    /**
     * 构造方法
     * ExpressModel constructor.
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
            'is_pass' => 1,
            'sort' => $this->get_site_sort()
        ];
    }
}