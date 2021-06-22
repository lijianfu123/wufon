<?php

namespace app\admin\controller;

use think\Request;
use think\facade\View;
use app\common\controller\CommonController;

/**
 * 后台管理 > 基类
 * Class BaseController
 * @package app\admin\controller
 */
class BaseController extends CommonController
{
    protected $admin_login_detail = [];

    /**
     * 构造方法
     * BaseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->admin_login_detail = $this->get_current_login_detail(); //获取 当前登录数据(已登录)

        View::assign([
            'admin_login_detail' => $this->admin_login_detail
        ]);
    }
}