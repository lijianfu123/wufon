<?php

namespace app\common\model;

/**
 * 新闻分类 - 模型
 * Class NewsClassModel
 * @package app\common\model
 */
class NewsClassModel extends BaseModel
{
    protected $name = 'news_class';

    /**
     * 构造方法
     * NewsClassModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->max_level = 2; //最大层级数
        $this->order = 'sort asc, id asc'; //排序
    }

    /**
     * 获取 添加 默认数据
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_insert_default_detail()
    {
        $current_site_detail = (new SiteModel())->get_current_site_detail(); //获取当前站点数据

        return [
            'id' => 0,
            'is_pass' => 1,
            'parent_id' => 0,
            'list_view_path' => $current_site_detail['news_list_view_path'],
            'detail_view_path' => $current_site_detail['news_detail_view_path'],
            'sort' => $this->get_site_sort()
        ];
    }
}