<?php

namespace app\common\model;

/**
 * 适用人群 - 模型
 * Class PeopleModel
 * @package app\common\model
 */
class PeopleModel extends BaseModel
{
    protected $name = 'people';

    /**
     * 构造方法
     * PeopleModel constructor.
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