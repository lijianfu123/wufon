<?php

namespace app\common\model;

/**
 * 银行 - 模型
 * Class BankModel
 * @package app\common\model
 */
class BankModel extends BaseModel
{
    protected $name = 'bank';

    /**
     * 构造方法
     * BankModel constructor.
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