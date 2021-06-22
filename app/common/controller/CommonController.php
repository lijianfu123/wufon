<?php

namespace app\common\controller;

use stdClass;
use think\Request;
use think\facade\View;
use think\facade\Cache;
use think\facade\Config;
use \think\facade\Route;
use app\common\enum\AppEnum;
use app\common\model\UserModel;
use app\common\model\AdminModel;
use app\common\model\SiterModel;

/**
 * 公用 控制器
 * Class CommonController
 * @package app\common\controller
 */
class CommonController
{
    protected $app;
    protected $param, $post;
    protected $authorize_action_array = []; //授权方法 数组

    /**
     * 构造方法
     * CommonController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->param = $request->param();
        $this->post = $request->post();

        $this->app['host'] = $request->host(); //域名 + 端口
        $this->app['app_enum_type'] = App('http')->getName(); //应用
        $this->app['controller'] = $request->controller(); //控制器
        $this->app['action'] = $request->action(); //方法
        $this->app['client_ip'] = $request->ip(); //客户端 ip
        $this->app['server_ip'] = $_SERVER['SERVER_ADDR']; //服务器 ip
        $this->app['referer_url'] = @$_SERVER["HTTP_REFERER"];  //请求地址（来路地址）
        $this->app['is_mobile'] = $request->isMobile(); //是否手机

        //判断 类方法 是否 授权方法 数组
        if (count($this->authorize_action_array) > 0) {
            if (!in_array($this->app['action'], $this->authorize_action_array)) {
                echo '禁止访问的方法';
                die();
            }
        }

        //title
        $this->app['title'] = '-管理平台';
        switch ($this->app['app_enum_type']) {
            case AppEnum::admin['enum_type']:
                $this->app['title'] = '总后台' . $this->app['title'];

                break;
            case AppEnum::site['enum_type']:
                $this->app['title'] = '站点' . $this->app['title'];

                break;
            case AppEnum::user['enum_type']:
                $this->app['title'] = '用户' . $this->app['title'];

                break;
        }

        //视图路径、layout 模板
        if ($this->app['app_enum_type'] != AppEnum::index['enum_type']) {
            $view_path = './app/' . $this->app['app_enum_type'] . '/';
            if ($this->app['is_mobile']) {
                $view_path .= 'mobile_view/';
            } else {
                $view_path .= 'pc_view/';
            }

            $layout_name = './app/common/view/layout.html';

            View::config([
                'view_path' => $view_path,
                'layout_name' => $layout_name
            ]);
        }

        View::assign([
            'app' => $this->app
        ]);
    }

    /**
     * 获取 当前登录数据(已登录)
     * @return array|\think\db\concern\Model
     */
    protected function get_current_login_detail()
    {
        if (!in_array($this->app['controller'], ['Register', 'Login', 'ForgotPassword'])) {
            $Model = new stdClass();
            switch ($this->app['app_enum_type']) {
                case AppEnum::admin['enum_type']:
                    $Model = new AdminModel();

                    break;
                case AppEnum::site['enum_type']:
                    $Model = new SiterModel();

                    break;
                case AppEnum::user['enum_type']:
                    $Model = new UserModel();

                    break;
            }

            //获取 当前登录数据(已登录)
            $current_login_detail = $Model->get_current_login_detail();
            if ($current_login_detail->isEmpty()) {
                header('Location: ' . Route::buildUrl('Login/'));
                die();
            } else {
                //权限 判断
                $role_rule_list = $Model->get_role_rule_list($this->app['app_enum_type'], $current_login_detail['id']);
                if ($this->app['controller'] != 'Index') {
                    $role_param_array = [
                        'app_enum_type' => $this->app['app_enum_type'],
                        'controller' => $this->app['controller'],
                        'action' => $this->app['action']
                    ];

                    if (is_has_role($role_param_array, $role_rule_list) == false) {
                        echo '权限不足';
                        die();
                    }
                }

                //管理员权限 写入缓存 与 其他模块 通讯
                if (($this->app['controller'] == 'Index') && ($this->app['action'] == 'index')) {
                    Cache::set($this->app['app_enum_type'] . '_role_rule_' . $current_login_detail['id'], $role_rule_list);
                }

                return $current_login_detail;
            }
        }
    }

    /**
     * 获取 common 类 路径
     * @param string $folder
     * @return string
     */
    protected function get_common_class_path($folder = 'model')
    {
        return "\\app\\common\\" . $folder . "\\" . $this->app['controller'];
    }

    /**
     * 空控制器
     * @param $method
     * @param $args
     * @return string
     */
    public function __call($method, $args)
    {
        return '404 不存在的方法';
    }

    /**
     * 首页
     * @return \think\response\View
     */
    public function index()
    {
        return view();
    }

    /**
     * 添加
     * @return \think\response\View
     */
    public function insert()
    {
        return view('edit', [
            'id' => 0
        ]);
    }

    /**
     * 修改
     * @param int $id
     * @return \think\response\View
     */
    public function update($id = 0)
    {
        return view('edit', [
            'id' => $id
        ]);
    }

    /**
     * 详情
     * @param int $id
     * @return \think\response\View
     */
    public function detail($id = 0)
    {
        return view('', [
            'id' => $id
        ]);
    }
}