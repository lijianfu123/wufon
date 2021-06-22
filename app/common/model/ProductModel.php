<?php

namespace app\common\model;

use app\common\enum\AppEnum;

/**
 * 商品 - 模型
 * Class ProductModel
 * @package app\common\model
 */
class ProductModel extends BaseModel
{
    protected $name = 'product';
    protected $json = ['image_list_json']; //json 字段

    /**
     * 构造方法
     * ProductModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->with = ['FirstProductClass', 'SecondProductClass', 'ThirdProductClass', 'People']; //关联模型
        $this->order = 'id desc'; //排序
    }

    /**
     * 第一层 商品分类 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function FirstProductClass()
    {
        return $this->hasOne('ProductClassModel', 'id', 'first_product_class_id')->field('id, product_class_name, detail_view_path');
    }

    /**
     * 第二层 商品分类 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function SecondProductClass()
    {
        return $this->hasOne('ProductClassModel', 'id', 'second_product_class_id')->field('id, product_class_name, detail_view_path');
    }

    /**
     * 第三层 商品分类 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function ThirdProductClass()
    {
        return $this->hasOne('ProductClassModel', 'id', 'third_product_class_id')->field('id, product_class_name, detail_view_path');
    }

    /**
     * 适用人群 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function People()
    {
        return $this->hasOne('PeopleModel', 'id', 'people_id')->field('id, people_name');
    }

    /**
     * 整理 站点 任意 分页 条件
     * @param array $post
     * @return string
     */
    public function parse_site_any_page_where(array $post)
    {
        $where = "(id > 0)";

        //状态
        if (isset($post['is_pass'])) {
            if ($post['is_pass'] != '') {
                $where .= " and (is_pass = " . $post['is_pass'] . ")";
            }
        }

        //是否推荐
        if (isset($post['is_commend'])) {
            if ($post['is_commend'] == 1) {
                $where .= " and (is_commend = 1)";
            }
        }

        //商品分类
        if (isset($post['product_class_id'])) {
            if (is_numeric($post['product_class_id'])) {
                if ($post['product_class_id'] > 0) {
                    $where .= " and ((first_product_class_id = " . $post['product_class_id'] . ") or (second_product_class_id=" . $post['product_class_id'] . "))";
                }
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
     * 获取 搜索 默认 数据
     * @return array
     */
    public function get_search_default_data()
    {
        return [
            'keyword' => '',
            'is_pass' => '',
            'is_commend' => 0,
            'product_class_id' => 0
        ];
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
            'first_product_class_id' => 0,
            'second_product_class_id' => 0,
            'image_list_json' => [],
        ];
    }
}