<?php

namespace app\common\logic;

/**
 * 商品 - 逻辑
 * Class ProductLogic
 * @package app\common\logic
 */
class ProductLogic extends BaseLogic
{
    /**
     * 构造方法
     * ProductLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'product_name' => 'require'
        ];

        $this->validate_message = [
            'product_name.require' => '商品名称为空'
        ];
    }
}