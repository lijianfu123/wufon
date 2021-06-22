<?php

namespace app\site\controller;

use app\common\model\ProductModel;

/**
 * 智投股票
 * Class ProductSelectController
 * @package app\site\controller
 */
class ProductSelectController extends BaseController
{
    public function choose_product()
    {
        $keyword = input('keyword');
        if ($keyword == '') {
            $list = [];
        } else {
            $where = "(product_name like '%$keyword%') or (product_code like '%$keyword%')";
            $ProductModel = new ProductModel();
            $list = $ProductModel->where($where)->limit(20)->select();
        }

        return view('', [
            'keyword' => $keyword,
            'list' => $list
        ]);
    }
}