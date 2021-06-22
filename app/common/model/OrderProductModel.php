<?php

namespace app\common\model;

/**
 * 订单商品 - 模型
 * Class OrderProductModel
 * @package app\common\model
 */
class OrderProductModel extends BaseModel
{
    protected $name = 'order_product';

    /**
     * 构造方法
     * OrderProductModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->with = ['Product', 'Color', 'Size']; //关联模型
        $this->order = 'id asc'; //排序
    }

    /**
     * 商品 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function Product()
    {
        return $this->hasOne('ProductModel', 'id', 'product_id')->field('id, product_name');
    }

    /**
     * 颜色 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function Color()
    {
        return $this->hasOne('ColorModel', 'id', 'color_id')->field('id, color_name');
    }

    /**
     * 规格
     * 尺码 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function Spec()
    {
        return $this->hasOne('SpecModel', 'id', 'spec_id')->field('id, spec_name');
    }
}