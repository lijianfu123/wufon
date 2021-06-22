<?php
//+--------------------------------------------------
//| 文件设置
//+--------------------------------------------------

use think\facade\Env;

return [
    //默认磁盘
    'default' => Env::get('filesystem.driver', 'local'),
    //磁盘列表
    'disks' => [
        'local' => [
            'type' => 'local',
            'root' => app()->getRootPath() . UPLOAD_FOLDER . '/'
            //'root' => app()->getRuntimePath()
        ],
        'public' => [
            //磁盘类型
            'type' => 'local',
            //磁盘路径
            'root' => app()->getRootPath() . 'public/',
            //磁盘路径对应的外部URL路径
            'url' => '/storage',
            //可见性
            'visibility' => 'public',
        ],
        //更多的磁盘配置信息
    ],
];