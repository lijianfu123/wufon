<?php

namespace app\common\model;

/**
 * 来源 - 模型
 * Class SourceModel
 * @package app\common\model
 */
class SourceModel extends BaseModel
{
    protected $name = 'source';

    /**
     * 构造方法
     * AuthorModel constructor.
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