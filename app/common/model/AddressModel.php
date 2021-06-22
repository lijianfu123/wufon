<?php

namespace app\common\model;

use app\common\enum\AppEnum;

/**
 * 地址 - 模型
 * Class AddressModel
 * @package app\common\model
 */
class AddressModel extends BaseModel
{
    protected $name = 'address';
    protected $json = ['city_ids_json']; //json 字段

    /**
     * 构造方法
     * AddressModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->with = ['User', 'Province', 'City', 'County']; //关联模型
    }

    /**
     * 会员 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function User()
    {
        return $this->hasOne('UserModel', 'id', 'user_id')->field('id, username');
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
     * 整理 站点 任意 分页 条件
     * @param array $post
     * @return string
     */
    public function parse_site_any_page_where(array $post)
    {
        $where = "(id > 0)";
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
            'is_pass' => 1,
            'city_ids_json' => []
        ];
    }
}