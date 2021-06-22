<?php

namespace app\common\model;

use app\common\enum\AppEnum;

/**
 * 订单 - 模型
 * Class OrderModel
 * @package app\common\model
 */
class OrderModel extends BaseModel
{
    protected $name = 'order';

    /**
     * 构造方法
     * OrderModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->with = ['User', 'Province', 'City', 'County', 'OrderProduct']; //关联模型
        $this->order = 'id desc';
    }

    /**
     * 会员 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function User()
    {
        return $this->hasOne('UserModel', 'id', 'user_id')->field('id, user_name');
    }

    /**
     * 省 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function Province()
    {
        return $this->hasOne('CityModel', 'id', 'province_id')->field('id, city_name');
    }

    /**
     * 市 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function City()
    {
        return $this->hasOne('CityModel', 'id', 'city_id')->field('id, city_name');
    }

    /**
     * 县 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function County()
    {
        return $this->hasOne('CityModel', 'id', 'county_id')->field('id, city_name');
    }

    /**
     * 快递 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function Express()
    {
        return $this->hasOne('ExpressModel', 'id', 'express_id')->field('id, express_name');
    }

    /**
     * 订单商品 - 关联模型
     */
    public function OrderProduct()
    {
        return $this->hasMany('OrderProductModel', 'id', 'order_id')->field('id, order_product_name');
    }

    /**
     * 整理 站点 任意 分页 条件
     * @param array $post
     * @return string
     */
    public function parse_site_any_page_where(array $post)
    {
        $where = "(id > 0)";

        //订单状态
        if (isset($post['order_state'])) {
            if (is_numeric($post['order_state'])) {
                if ($post['order_state'] > 0) {
                    $where .= " and (order_state = " . $post['order_state'] . ")";
                }
            }
        }

        //开始时间
        if (isset($post['start_time'])) {
            if ($post['start_time'] != '') {
                $start_time = strtotime($post['start_time']);

                $where .= " and (create_time >= " . $start_time . ")";
            }
        }

        //结束时间
        if (isset($post['end_time'])) {
            if ($post['end_time'] != '') {
                $end_time = strtotime($post['end_time']) + DAY_SECONDS;

                $where .= " and (create_time <= " . $end_time . ")";
            }
        }

        //关键字
        if (isset($post['keyword'])) {
            if ($post['keyword'] != '') {
                $where .= " and (order_code like '%" . $post['keyword'] . "%')";
            }
        }

        $where = $this->parse_base_page_where(AppEnum::site['enum_type'], $where);

        return $where;
    }
}