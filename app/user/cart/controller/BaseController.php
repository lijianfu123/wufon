<?php

namespace app\cart\controller;

use think\Request;
use app\common\controller\CommonController;

/**
 * 购物车 > 基类
 * Class BaseController
 * @package app\cart\controller
 */
class BaseController extends CommonController
{
    /**
     * 构造方法
     * BaseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
}