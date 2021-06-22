<?php

namespace app\admin\controller;

/**
 * 后台管理 > 首页
 * Class IndexController
 * @package app\admin\controller
 */
class IndexController extends BaseController
{
    /**
     * 欢迎页
     * @return \think\response\View
     */
    public function welcome()
    {
        return view();
    }
}