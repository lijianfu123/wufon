<?php

namespace app\common\model;

/**
 * 单页面 - 模型
 * Class IntroModel
 * @package app\common\model
 */
class IntroModel extends BaseModel
{
    protected $name = 'intro';
    protected $json = ['honor_list_json', 'certificate_list_json']; //json 字段

    /**
     * 构造方法
     * IntroModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

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
            'honor_list_json' => [],
            'certificate_list_json' => [],
            'detail_view_path' => $current_site_detail['intro_detail_view_path'],
            'sort' => $this->get_site_sort()
        ];
    }
}