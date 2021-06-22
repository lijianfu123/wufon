<?php

namespace app\common\model;

use app\common\enum\CacheJsonEnum;

/**
 * 省 / 市 / 县 - 模型
 * Class CityModel
 * @package app\common\model
 */
class CityModel extends BaseModel
{
    public $name = 'city';
    protected $json = ['city_ids_json']; //json 字段
    public $cache_json_array = [CacheJsonEnum::cascader['enum_number']]; //缓存 json 数组

    /**
     * 构造方法
     * CityModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->max_level = 3; //最大层级数
        $this->order = 'sort ace, id asc';
        $this->tree_list_field = 'id, parent_id, level, sort, is_pass, city_code, city_name'; //tree 列表 字段
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