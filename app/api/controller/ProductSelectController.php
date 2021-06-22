<?php

namespace app\api\controller;

use app\common\model\ProductModel;
use app\common\model\ProductSelectModel;
use app\common\model\ProductSelectDayModel;

/**
 * 智投入选
 * Class ProductSelectController
 * @package app\api\controller
 */
class ProductSelectController extends BaseController
{
    public function save_data()
    {
        //智投日期入库
        $in_time = strtotime(input('in_time'));
        $in_time = date('Y-m-d', $in_time);
        $in_time = strtotime($in_time);

        $ProductSelectDayModel = new ProductSelectDayModel();
        $count = $ProductSelectDayModel->where("in_time = " . $in_time)->count();
        if ($count == 0) {
            $ProductSelectDayModel->save_data([
                'in_time' => $in_time
            ]);
        }

        //智投入选 - 保存
        $data_product_select = input('');

        $data['in_time'] = strtotime($data_product_select['in_time']);
        $data['out_time'] = strtotime($data_product_select['out_time']);

        $ProductSelectModel = new ProductSelectModel();
        $result_product_select = $ProductSelectModel->save_data($data_product_select);

        return $this->get_api_result($result_product_select);
    }

    /**
     * 获取分页
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_page()
    {
        /*
        $ProductSelectDayModel = new ProductSelectDayModel();
        $page = $ProductSelectDayModel->get_base_page();

        $select_type = input('select_type');
        $product_class_id = input('id');

        $ProductModel = new ProductModel();
        $ProductSelectModel = new ProductSelectModel();

        foreach ($page['list'] as $key => $value) {
            $start_time = $value['in_time'];
            $end_time = $value['in_time'] + (60 * 60 * 24);

            $list = $ProductSelectModel->where("(product_class_id = " . $product_class_id . ") and (select_type = " . $select_type . ") and ((in_time >= " . $start_time . ") and (in_time <= " . $end_time . "))")->select()->toArray();
            foreach ($list as $k => $val) {
                $product_detail = $ProductModel->where("id = " . $val['product_id'])->find();

                $list[$k]['product_name'] = $product_detail['product_name'];
                $list[$k]['product_code'] = $product_detail['product_code'];
            }

            $page['list'][$key]['data'] = $list;
        }
        */

        $product_class_id = input('id');
        $ProductModel = new ProductModel();
        $ProductSelectModel = new ProductSelectModel();

        $list = $ProductSelectModel->get_base_page("(product_class_id = " . $product_class_id . ")");

        //p($list);
        //die();

        //foreach ($list as $k => $val) {
            //$product_detail = $ProductModel->where("id = " . $val['product_id'])->find();

            //$list[$k]['product_name'] = $product_detail['product_name'];
            //$list[$k]['product_code'] = $product_detail['product_code'];
        //}

        //$page['list'][$key]['data'] = $list;

        return $this->get_api_result($list);
    }
}
