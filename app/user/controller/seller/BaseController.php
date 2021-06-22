<?php

namespace app\user\controller\seller;

use think\Request;

/**
 * 会员中心 > 销售 > 基类
 * Class BaseController
 * @package app\user\controller\seller
 */
class BaseController extends \app\user\controller\BaseController
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