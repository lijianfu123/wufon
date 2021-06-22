<?php

namespace app\site\controller;

use think\Request;
use think\facade\Cookie;

/**
 * 站点后台 > 登录
 * Class LoginController
 * @package app\site\controller
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

        Cookie::delete('site_id');
        Cookie::delete('siter_id');
        Cookie::delete('siter_login_name');
    }

    /**
     * 退出登录
     * @return \think\response\Redirect
     */
    public function logout()
    {
        return redirect('index');
    }
}