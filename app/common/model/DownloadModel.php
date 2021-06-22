<?php

namespace app\common\model;

use app\common\enum\AppEnum;

/**
 * 下载 - 模型
 * Class DownloadModel
 * @package app\common\model
 */
class DownloadModel extends BaseModel
{
    protected $name = 'download';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->with = ['FirstDownloadClass', 'SecondDownloadClass', 'ThirdDownloadClass']; //关联模型
        $this->order = 'id desc'; //排序
    }

    /**
     * 第一层 下载分类 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function FirstDownloadClass()
    {
        return $this->hasOne('DownloadClassModel', 'id', 'first_download_class_id')->field('id, download_class_name, detail_view_path');
    }

    /**
     * 第二层 下载分类 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function SecondDownloadClass()
    {
        return $this->hasOne('DownloadClassModel', 'id', 'second_download_class_id')->field('id, download_class_name, detail_view_path');
    }

    /**
     * 第三层 下载分类 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function ThirdDownloadClass()
    {
        return $this->hasOne('DownloadClassModel', 'id', 'third_download_class_id')->field('id, download_class_name, detail_view_path');
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

        //下载分类
        if (isset($post['download_class_id'])) {
            if (is_numeric($post['download_class_id'])) {
                if ($post['download_class_id'] > 0) {
                    $where .= " and ((first_download_class_id = " . $post['download_class_id'] . ") or (second_download_class_id=" . $post['download_class_id'] . "))";
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
                $where .= " and (download_name like '%" . $post['keyword'] . "%')";
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
            'start_time' => '',
            'end_time' => '',
            'is_pass' => '',
            'is_commend' => 0,
            'download_class_id' => 0
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
            'file_size' => 0,
            'download_count' => 0,
            'first_download_class_id' => 0,
            'second_download_class_id' => 0
        ];
    }
}