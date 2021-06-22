<?php

namespace app\user\controller;

use think\Request;
use think\facade\View;
use app\common\controller\CommonController;

/**
 * 会员中心 > 基类
 * Class BaseController
 * @package app\index\controller\user
 */
class BaseController extends CommonController
{
    protected $user_login_detail = [];

    /**
     * 构造方法
     * BaseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->user_login_detail = $this->get_current_login_detail(); //获取 当前登录数据(已登录)

        View::assign([
            'user_login_detail' => $this->user_login_detail
        ]);
    }
}