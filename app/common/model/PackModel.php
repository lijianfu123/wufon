<?php

namespace app\common\model;

/**
 * 包装单位 - 模型
 * Class PackModel
 * @package app\common\model
 */
class PackModel extends BaseModel
{
    protected $name = 'pack';

    /**
     * 构造方法
     * PackModel constructor.
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
            'is_pass' => 1,
            'sort' => $this->get_any_sort()
        ];
    }
}