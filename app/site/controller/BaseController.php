<?php

namespace app\site\controller;

use think\Request;
use think\facade\View;
use app\common\controller\CommonController;

/**
 * 站点后台 > 基类
 * Class BaseController
 * @package app\site\controller
 */
class BaseController extends CommonController
{
    protected $siter_login_detail = [];

    /**
     * 构造方法
     * BaseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->siter_login_detail = $this->get_current_login_detail(); //获取 当前登录数据(已登录)

        View::assign([
            'siter_login_detail' => $this->siter_login_detail
        ]);
    }
}