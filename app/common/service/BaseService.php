<?php

namespace app\common\service;

/**
 * 基类 - Service
 * Class BaseService
 * @package app\common\service
 */
class BaseService
{
    protected $request;

    /**
     * 构造方法
     * BaseService constructor.
     */
    public function __construct()
    {
        $this->request = request();
    }

    /**
     * 获取 支付通知页面
     * @param $app_enum_type
     * @param $id
     * @return string
     */
    protected function get_pay_notify_url($app_enum_type, $id)
    {
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/api/PayNotify/index/app_enum_type/' . $app_enum_type . '/id/' . $id;

        return $url;
    }
}