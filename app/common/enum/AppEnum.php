<?php

namespace app\common\enum;

/**
 * 应用 - 枚举
 * Class AppEnum
 * @package app\common\enum
 */
class AppEnum extends BaseEnum
{
    const module = [
        'controller' => [
            'Index' => 'Index',
            'Intro' => 'Intro',
            'News' => 'News',
            'Product' => 'Product',
            'Download' => 'Download'
        ],
        'action' => [
            'index' => 'index',
            'list' => 'list',
            'detail' => 'detail'
        ],
        'taglib' => [
            'intro' => 'intro',
            'news' => 'news',
            'news_class' => 'news_class',
            'product' => 'product',
            'product_class' => 'product_class',
            'download' => 'download',
            'download_class' => 'download_class'
        ]
    ];

    const index = ['enum_number' => 1, 'enum_name' => '前台', 'enum_type' => 'index'];
    const api = ['enum_number' => 2, 'enum_name' => 'api 接口', 'enum_type' => 'api'];
    const admin = ['enum_number' => 3, 'enum_name' => '后台', 'enum_type' => 'admin'];
    const site = ['enum_number' => 4, 'enum_name' => '站点', 'enum_type' => 'site'];
    const user = ['enum_number' => 5, 'enum_name' => '会员', 'enum_type' => 'user'];
}