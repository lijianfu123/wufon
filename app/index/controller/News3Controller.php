<?php

namespace app\index\controller;

use QL\QueryList;
use app\common\model\NewsModel;

/**
 * 快讯 - 采集
 * Class NewsController
 * @package app\index\controller
 */
class News3Controller
{
    public function __construct()
    {
        require './vendor/QueryList/phpQuery.php';
        require './vendor/QueryList/QueryList.php';
    }

    /**
     * 采集
     */
    public function collect()
    {
        $url = 'https://www.jiemian.com/lists/4.html'; //新闻列表页 地址

        $rules = [
            'title' => ['a', 'text'],
            'link' => ['a', 'href'],
            'news_time' => ['.item-date', 'text'],
            'content' => ['p', 'text']
        ];

        $range = '.item-news';

        $list = QueryList::Query($url, $rules, $range)->data;
        foreach ($list as $key => $value) {
            if ($key < 20) {
                $data = [
                    'is_pass' => 1,
                    'site_id' => 1,
                    'first_news_class_id' => 3,
                    'news_class_ids' => ',3,',
                    'news_name' => $value['title'],
                    'news_time' => strtotime(date('Y-m-d', time()) . ' ' . $value['news_time']),
                    'content' => $value['content']
                ];

                $NewsModel = new NewsModel();
                $count = $NewsModel->where($data)->count();
                if ($count == 0) {
                    $result = $NewsModel->save_data($data);

                    p($data['news_name'] . ' - 采集成功');
                }
            }
        }

        p('采集完成');
    }
}