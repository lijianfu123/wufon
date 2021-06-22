<?php

namespace app\admin\controller;

use think\Request;
use think\facade\Cookie;

/**
 * 后台管理 > 登录
 * Class LoginController
 * @package app\admin\controller
 */
class LoginController extends BaseController
{
    /**
     * 构造方法
     * LoginController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        Cookie::delete('admin_id');
        Cookie::delete('admin_login_name');
    }

    /**
     * 退出
     */
    public function logout()
    {
        return redirect('index');
    }
}