<?php

namespace app\user\controller;

use think\Request;
use think\facade\Cookie;

/**
 * 会员中心 > 登录
 * Class LoginController
 * @package app\user\controller
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

        Cookie::delete('user_id');
        Cookie::delete('user_login_name');
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        return redirect('/');
    }
}