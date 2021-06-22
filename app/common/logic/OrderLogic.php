<?php

namespace app\common\logic;

use app\common\model\CartModel;
use app\common\model\AddressModel;
use app\common\model\OrderProductModel;

/**
 * 订单 - 逻辑
 * Class OrderLogic
 * @package app\common\logic
 */
class OrderLogic extends BaseLogic
{
    private $CartModel, $AddressModel, $OrderProductModel;

    /**
     * 构造方法
     * OrderLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->CartModel = new CartModel();
        $this->AddressModel = new AddressModel();
        $this->OrderProductModel = new OrderProductModel();
    }
}