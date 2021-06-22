<?php

namespace app\common\model;

/**
 * 购物车 - 模型
 * Class CartModel
 * @package app\common\model
 */
class CartModel extends BaseModel
{
    protected $name = 'cart';

    /**
     * 构造方法
     * CartModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->with = ['Product', 'Color']; //排序
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
     * 尺码 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function Size()
    {
        return $this->hasOne('SizeModel', 'id', 'size_id')->field('id, size_name');
    }
}