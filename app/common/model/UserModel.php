<?php

namespace app\common\model;

use app\common\enum\AppEnum;

/**
 * 会员 - 模型
 * Class UserModel
 * @package app\common\model
 */
class UserModel extends BaseModel
{
    public $name = 'user';
    protected $readonly = ['username', 'login_name'];

    /**
     * 构造方法
     * UserModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->with = ['UserLevel', 'Province', 'City', 'County']; //关联模型
        $this->order = 'id desc'; //排序
    }

    /**
     * 会员级别 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function UserLevel()
    {
        return $this->hasOne('UserLevelModel', 'id', 'user_level_id')->field('id, user_level_name');
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
            'age' => 0,
            'realname' => '',
            'tel' => '',
            'idcard' => '',
            'face' => '',
            'address' => '',
            'sex_enum_number' => 1,
            'marriage_enum_number' => 1,
            'nation_enum_number' => 1,
            'political_enum_number' => 1,
            'country_id' => 1, //中国
            'city_ids_json' => []
        ];
    }
}