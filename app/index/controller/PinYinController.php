<?php

namespace app\index\controller;

use app\common\model\ProductModel;
use app\common\service\PinYinService;

/**
 * 拼音
 * Class PinYinController
 * @package app\index\controller
 */
class PinYinController
{
    public function index()
    {
        $ProductModel = new ProductModel();
        $PinYinService = new PinYinService();

        $page = input('page');
        if ($page == '') {
            $page = 1;
        }

        $data = [];

        $list = $ProductModel->field('id, product_name')->where("all_pinyin = ''")->limit(1)->order('id asc')->select();
        if (count($list) == 0) {
            die();
        }

        p($list[0]['id']);

        foreach ($list as $key => $value) {
            $all_pinyin = $PinYinService->get_all_py($value['product_name']);
            $first_pinyin = $PinYinService->get_first_py($all_pinyin);

            $data[$key] = [
                'id' => $value['id'],
//                'product_name' => $value['product_name'],
                'all_pinyin' => implode('', $all_pinyin),
                'first_pinyin' => $first_pinyin
            ];
        }

        $result = $ProductModel->saveAll($data);

        echo '<script>location.reload();</script>';
    }
}