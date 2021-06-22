<?php

namespace app\common\model;

/**
 * 优惠套餐 - 模型
 * Class DiscountPlanModel
 * @package app\common\model
 */
class DiscountPlanModel extends BaseModel
{
    protected $name = 'discount_plan';

    /**
     * 构造方法
     * DiscountPlanModel constructor.
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
            'product_money' => 0,
            'discount_money' => 0,
            'sort' => $this->get_site_sort()
        ];
    }
}