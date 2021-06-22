<?php

namespace app\api\controller;

use app\common\model\ProductMoneyModel;

/**
 * 智投收益
 * Class ProductMoneyController
 * @package app\api\controller
 */
class ProductMoneyController extends BaseController
{
    public function save_data()
    {
        $data = input('');

        $ProductMoneyModel = new ProductMoneyModel();
        $result = $ProductMoneyModel->save_data($data);

        return $this->get_api_result($result);
    }

    /**
     * 获取列表数据
     */
    public function get_list()
    {
        $product_class_id = input('product_class_id');
        if ($product_class_id == '') {
            $product_class_id = input('id');
        }

        $ProductMoneyModel = new ProductMoneyModel();
        $list = $ProductMoneyModel->where("product_class_id = " . $product_class_id)->select();

        return $this->get_api_result($list);
    }
}