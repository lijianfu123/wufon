<?php

namespace app\common\model;

/**
 * 站点 - 模型
 * Class SiteModel
 * @package app\common\model
 */
class SiteModel extends BaseModel
{
    protected $name = 'site';
    protected $readonly = ['domain'];
    protected $json = ['city_ids_json']; //json 字段

    /**
     * 构造方法
     * SiteModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->order = 'id desc'; //排序
    }

    /**
     * 整理 任意分页 条件
     * @param array $post
     * @return string
     */
    public function parse_any_page_where(array $post = [])
    {
        $where = "(id > 0)";
        $where = $this->parse_base_page_where('', $where);

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
            'pc_view_folder' => 'pc_view',
            'mobile_view_folder' => 'mobile_view',
            'index_index_view_path' => 'index/index',
            'intro_detail_view_path' => 'intro/detail',
            'news_index_view_path' => 'news/index',
            'news_list_view_path' => 'news/list',
            'news_detail_view_path' => 'news/detail',
            'product_index_view_path' => 'product/index',
            'product_list_view_path' => 'product/list',
            'product_detail_view_path' => 'product/detail',
            'download_index_view_path' => 'download/index',
            'download_list_view_path' => 'download/list',
            'download_detail_view_path' => 'download/detail',
            'main_siter' => [    //超管用户
                'username' => '',
                'password' => ''
            ]
        ];
    }

    /**
     * 获取 当前 站点 数据
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_current_site_detail()
    {
        $where = $this->get_site_where();
        $result = $this->where($where)->findOrEmpty();

        return $result;
    }
}