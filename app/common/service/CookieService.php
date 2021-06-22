<?php

namespace app\common\service;

use think\facade\Cookie;

/**
 * cookie - Service
 * Class CookieService
 * @package app\common\service
 */
class CookieService extends BaseService
{
    /**
     * 获取 cookie 值
     * @param $cookie
     * @param int $default_value
     * @return bool|int|mixed|string
     */
    private function get_cookie_value($cookie, $default_value)
    {
        $cookie_value = Cookie::get($cookie);
        if ($cookie_value == '') {
            $cookie_value = $default_value;
        } else {
            $cookie_value = decode($cookie_value);
        }

        return $cookie_value;
    }

    /**
     * 获取 微信 openid
     * @return bool|int|mixed|string
     */
    public function get_wechat_openid()
    {
        $user_id = $this->get_cookie_value('wechat_openid', 0);

        return $user_id;
    }

    /**
     * 获取 后台 管理员 id
     * @return bool|int|mixed|string
     */
    public function get_admin_id()
    {
        $admin_id = $this->get_cookie_value('admin_id', 0);

        return $admin_id;
    }

    /**
     * 获取 后台 管理员 登录名
     * @return bool|int|mixed|string
     */
    public function get_admin_login_name()
    {
        $admin_login_name = $this->get_cookie_value('admin_login_name', '');

        return $admin_login_name;
    }

    /**
     * 获取 站点 id
     * @return bool|int|mixed|string
     */
    public function get_site_id()
    {
        $site_id = $this->get_cookie_value('site_id', 0);

        return $site_id;
    }

    /**
     * 获取 站点 管理员 id
     * @return bool|int|mixed|string
     */
    public function get_siter_id()
    {
        $siter_id = $this->get_cookie_value('siter_id', 0);

        return $siter_id;
    }

    /**
     * 获取 站点 管理员 登录名
     * @return bool|int|mixed|string
     */
    public function get_siter_login_name()
    {
        $siter_login_name = $this->get_cookie_value('siter_login_name', '');

        return $siter_login_name;
    }

    /**
     * 获取 会员 id
     * @return bool|int|mixed|string
     */
    public function get_user_id()
    {
        $user_id = $this->get_cookie_value('user_id', 0);

        return $user_id;
    }

    /**
     * 获取 会员 登录名
     * @return bool|int|mixed|string
     */
    public function get_user_login_name()
    {
        $user_login_name = $this->get_cookie_value('user_login_name', '');

        return $user_login_name;
    }
}