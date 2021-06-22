<?php

namespace app\common\model;

use app\common\enum\AppEnum;

/**
 * 智投收益
 * Class ProductMoneyModel
 * @package app\common\model
 */
class ProductMoneyModel extends BaseModel
{
    protected $name = 'product_money';

    /**
     * 构造方法
     * ProductSelectModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->with = ['ProductClass']; //关联模型
    }

    /**
     * 商品分类 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function ProductClass()
    {
        return $this->hasOne('ProductClassModel', 'id', 'product_class_id')->field('id, product_class_name');
    }

    /**
     * 整理 站点 任意 分页 条件
     * @param array $post
     * @return string
     */
    public function parse_site_any_page_where(array $post)
    {
        $where = "(id > 0)";

        //商品分类
        if (isset($post['product_class_id'])) {
            if (is_numeric($post['product_class_id'])) {
                if ($post['product_class_id'] > 0) {
                    $where .= " and ((first_product_class_id = " . $post['product_class_id'] . ") or (second_product_class_id=" . $post['product_class_id'] . "))";
                }
            }
        }

        //是否推荐
        if (isset($post['is_commend'])) {
            if ($post['is_commend'] == 1) {
                $where .= " and (is_commend = 1)";
            }
        }

        //关键字
        if (isset($post['keyword'])) {
            if ($post['keyword'] != '') {
                $where .= " and (product_name like '%" . $post['keyword'] . "%')";
            }
        }

        $where = $this->parse_base_page_where(AppEnum::site['enum_type'], $where);

        return $where;
    }

    /**
     * 获取 添加 默认数据
     * @return array
     */
    public function get_insert_default_detail()
    {
        return [
            'id' => 0,
            'image' => '',
            'is_pass' => 1,
            'people_id' => 0,
            'weight' => 0,
            'mark_price' => 0,
            'product_class_id' => 0,
            'sort' => 0,
            'max' => 0,
            'price' => 0,

            'qi_xian' => 0,
            'avg_zhang_fu' => 0,
            'sheng_lv' => 0,
            'max_zhang_fu' => 0
        ];
    }
}