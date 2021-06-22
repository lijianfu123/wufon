<?php

use \think\facade\Route;
use \think\facade\Config;
use app\common\enum\OrderStateEnum;

/**
 * html 文件后缀
 * @return string
 */
function get_url_html_suffix()
{
    return '.' . Config::get('route.url_html_suffix');
}

/**
 * 单页面详情
 * @param string $id
 * @return string
 */
function intro_detail_url($id = '')
{
    return '/intro_detail' . $id . get_url_html_suffix();
}

/**
 * 新闻中心
 * @return string
 */
function news_index_url()
{
    return '/news_index' . get_url_html_suffix();
}

/**
 * 新闻 - 推荐
 * @param string $news_class_id
 * @param int $page
 * @return string
 */
function news_commend_url($news_class_id = '', $page = 1)
{
    $url = '/news_commend' . $news_class_id;

    if ($page > 1) {
        $url .= '/' . $page;
    }

    $url = get_url_html_suffix();

    return $url;
}

/**
 * 新闻 - 最新
 * @param string $news_class_id
 * @param int $page
 * @return string
 */
function news_new_url($news_class_id = '', $page = 1)
{
    $url = '/news_new' . $news_class_id;

    if ($page > 1) {
        $url .= '/' . $page;
    }

    $url .= get_url_html_suffix();

    return $url;
}

/**
 * 新闻 - 热点
 * @param string $news_class_id
 * @param int $page
 * @return string
 */
function news_hot_url($news_class_id = '', $page = 1)
{
    $url = '/news_hot' . $news_class_id;

    if ($page > 1) {
        $url .= '/' . $page;
    }

    $url .= get_url_html_suffix();

    return $url;
}

/**
 * 新闻分类
 * @param string $news_class_id
 * @param int $page
 * @return string
 */
function news_list_url($news_class_id = '', $page = 1)
{
    $url = '/news_list' . $news_class_id;

    if ($page > 1) {
        $url .= '/' . $page;
    }

    $url .= get_url_html_suffix();

    return $url;
}

/**
 * 新闻详情
 * @param $id
 * @return string
 */
function news_detail_url($id)
{
    return '/news_detail' . $id . get_url_html_suffix();
}

/**
 * 商品中心
 * @return string
 */
function product_index_url()
{
    return '/product_index' . get_url_html_suffix();
}

/**
 * 商品分类
 * @param string $product_class_id
 * @param int $page
 * @return string
 */
function product_list_url($product_class_id = '', $page = 1)
{
    $url = '/product_list' . $product_class_id;

    if ($page > 1) {
        $url .= '/' . $page;
    }

    $url .= get_url_html_suffix();

    return $url;
}

/**
 * 商品 - 推荐
 * @param string $product_class_id
 * @param int $page
 * @return string
 */
function product_commend_url($product_class_id = '', $page = 1)
{
    $url = '/product_commend' . $product_class_id;

    if ($page > 1) {
        $url .= '/' . $page;
    }

    $url .= get_url_html_suffix();

    return $url;
}

/**
 * 商品 - 新品
 * @param string $product_class_id
 * @param int $page
 * @return string
 */
function product_new_url($product_class_id = '', $page = 1)
{
    $url = '/Product_new' . $product_class_id;

    if ($page > 1) {
        $url .= '/' . $page;
    }

    $url .= get_url_html_suffix();

    return $url;
}

/**
 * 商品 - 热卖
 * @param string $product_class_id
 * @param int $page
 * @return string
 */
function product_hot_url($product_class_id = '', $page = 1)
{
    $url = '/product_hot' . $product_class_id;

    if ($page > 1) {
        $url .= '/' . $page;
    }

    $url .= get_url_html_suffix();

    return $url;
}

/**
 * 商品详情
 * @param $id
 * @return string
 */
function product_detail_url($id)
{
    return '/product_detail' . $id . get_url_html_suffix();
}

/**
 * 下载中心
 * @return string
 */
function download_index_url()
{
    return '/download_index' . get_url_html_suffix();
}

/**
 * 下载 - 推荐
 * @param string $download_class_id
 * @param int $page
 * @return string
 */
function download_commend_url($download_class_id = '', $page = 1)
{
    $url = '/download_commend' . $download_class_id;

    if ($page > 1) {
        $url .= '/' . $page;
    }

    $url .= get_url_html_suffix();

    return $url;
}

/**
 * 下载 - 最新
 * @param string $download_class_id
 * @param int $page
 * @return string
 */
function download_new_url($download_class_id = '', $page = 1)
{
    $url = '/download_new' . $download_class_id;

    if ($page > 1) {
        $url .= '/' . $page;
    }

    $url .= get_url_html_suffix();

    return $url;
}

/**
 * 下载 - 热点
 * @param string $download_class_id
 * @param int $page
 * @return string
 */
function download_hot_url($download_class_id = '', $page = 1)
{
    $url = '/download_hot' . $download_class_id;

    if ($page > 1) {
        $url .= '/' . $page;
    }

    $url .= get_url_html_suffix();

    return $url;
}

/**
 * 下载分类
 * @param string $download_class_id
 * @param int $page
 * @return string
 */
function download_list_url($download_class_id = '', $page = 1)
{
    $url = '/download_list' . $download_class_id;

    if ($page > 1) {
        $url .= '/' . $page;
    }

    $url .= get_url_html_suffix();

    return $url;
}

/**
 * 下载详情
 * @param $id
 * @return string
 */
function download_detail_url($id)
{
    return '/download_detail' . $id . get_url_html_suffix();
}

/**
 * 上传
 */
function upload_url()
{
    return Route::buildUrl('/api/File/upload');
}

/**
 * 购物车 首页
 * @return string
 */
function cart_url()
{
    return Route::buildUrl('/user/Cart/index');
}

/**
 * 注册
 * @return string
 */
function register_url()
{
    return Route::buildUrl('/user/Register/index');
}

/**
 * 登录
 * @return string
 */
function login_url()
{
    return Route::buildUrl('/user/Login/index');
}

/**
 * 退出登录
 * @return string
 */
function logout_url()
{
    return Route::buildUrl('/user/Login/logout');
}

/**
 * 会员 找回密码
 */
function forgot_password_url()
{
    return Route::buildUrl('/user/ForgotPassword/index');
}

/**
 * 会员中心
 * @return string
 */
function user_index_url()
{
    return Route::buildUrl('/user/Index/index');
}

/**
 * 修改 会员资料
 * @return \think\route\Url
 */
function user_update_url()
{
    return Route::buildUrl('/user/User/update');
}

/**
 * 会员 订单
 */
function user_order_url()
{
    return Route::buildUrl('/user/Order/index');
}

/**
 * 会员 待付款 订单
 */
function user_create_order_url()
{
    return Route::buildUrl('/user/Order/index', ['order_state' => OrderStateEnum::create_order['enum_number']]);
}

/**
 * 会员 待发货 订单
 */
function user_wait_express_order_url()
{
    return Route::buildUrl('/user/Order/index', ['order_state' => 'wait_express']);
}

/**
 * 会员 待收货 订单
 */
function user_wait_receive_order_url()
{
    return Route::buildUrl('/user/Order/index', ['order_state' => 'wait_receive']);
}

/**
 * 会员 已完成 订单
 */
function user_finish_order_url()
{
    return Route::buildUrl('/user/Order/index', ['order_state' => OrderStateEnum::finish_order['enum_number']]);
}

/**
 * 会员 订单详情
 * @param $id
 * @return \think\route\Url
 */
function user_order_detail_url($id)
{
    return Route::buildUrl('/user/Order/detail', ['id' => $id]);
}

/**
 * 会员 地址
 * @return \think\route\Url
 */
function user_address_url()
{
    return Route::buildUrl('/user/Address/index');
}

/**
 * 会员 财务记录
 * @return \think\route\Url
 */
function user_money_url()
{
    return Route::buildUrl('/user/Money/index');
}

/**
 * 会员 充值
 * @return \think\route\Url
 */
function user_recharge_url()
{
    return Route::buildUrl('/user/Recharge/index');
}

/**
 * 会员 提现
 * @return \think\route\Url
 */
function user_seller_withdraw_url()
{
    return Route::buildUrl('/user/seller.Withdraw/index');
}

/**
 * 会员 推荐奖
 * @return \think\route\Url
 */
function user_seller_commend_award_url()
{
    return Route::buildUrl('/user/seller.CommendAward/index');
}

/**
 * 会员 团队奖
 * @return \think\route\Url
 */
function user_seller_team_award_url()
{
    return Route::buildUrl('/user/seller.TeamAward/index');
}

/**
 * 会员 业绩奖
 * @return \think\route\Url
 */
function user_seller_sell_award_url()
{
    return Route::buildUrl('/user/seller.SellAward/index');
}

/**
 * 会员 我的团队
 * @return \think\route\Url
 */
function user_seller_team_user_url()
{
    return Route::buildUrl('/user/seller.TeamUser/index');
}

/**
 * 会员 团队订单
 * @return \think\route\Url
 */
function user_seller_team_order_url()
{
    return Route::buildUrl('/user/seller.TeamOrder/index');
}

/**
 * 会员 授权书
 * @return \think\route\Url
 */
function user_seller_authorize_url()
{
    return Route::buildUrl('/user/seller.Authorize/index');
}

/**
 * 会员 推广码
 * @return \think\route\Url
 */
function user_seller_qrcode_url()
{
    return Route::buildUrl('/user/seller.Qrcode/index');
}