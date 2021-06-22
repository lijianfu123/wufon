<?php

namespace app\common\model;

use app\common\enum\CacheJsonEnum;

/**
 * 国家 - 模型
 * Class CountryModel
 * @package app\common\model
 */
class CountryModel extends BaseModel
{
    public $name = 'country';
    public $cache_json_array = [CacheJsonEnum::option['enum_number']]; //缓存 json 数组

    /**
     * 构造方法
     * CountryModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->order = 'sort ace, id asc';
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
            'sort' => $this->get_any_sort()
        ];
    }
}