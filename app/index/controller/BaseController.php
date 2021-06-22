<?php

namespace app\index\controller;

use think\facade\Config;
use think\Request;
use think\facade\View;
use think\facade\Route;
use think\facade\Cookie;
use app\common\enum\AppEnum;
use app\common\model\SiteModel;
use app\common\controller\CommonController;

/**
 * 前台 > 基类
 * Class BaseController
 * @package app\index\controller
 */
class BaseController extends CommonController
{
    protected $current_site_id = 0; //当前站点 id
    protected $site_detail = []; //站点数据
    protected $main_detail = []; //页面数据
    protected $lower_controller = ''; //小写 控制器 名

    /**
     * 构造方法
     * BaseController constructor.
     * @param Request $request
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        /*
        手机微信 浏览
        if (is_wechat()) {
            $WechatService = new WechatService();
            $wechat_openid = $WechatService->get_wechat_open();

            //通过是否关注获取用户信息
            //is_subscribe_wechat
            $wechat_info = $WechatService->get_wechat_info($wechat_openid);
            $wechat_info = $WechatService->get_wechat_authorize_info($wechat_openid);
        }
        */

        $this->current_site_id = 1; //当前站点 id
        $this->lower_controller = strtolower($this->app['controller']);
        $this->site_detail = $this->get_current_site_detail(); //获取 当前站点 数据

        Cookie::set('current_site_id', $this->current_site_id); //设置当前站点 id

        //视图文件夹
        if ($this->app['is_mobile']) {
            $site_view_folder = $this->site_detail['mobile_view_folder'];
        } else {
            $site_view_folder = $this->site_detail['pc_view_folder'];
        }

        View::config([
            'view_dir_name' => $site_view_folder
        ]);

        View::assign([
            'site_detail' => $this->site_detail
        ]);
    }

    /**
     * 首页
     * @return \think\response\View|void
     */
    public function index()
    {
        $this->merge_main_detail_and_seo_info(); //合并 main_detail、seo_info

        $view_path = $this->site_detail[$this->lower_controller . '_index_view_path'];

        return view($view_path, [
            'main_detail' => $this->main_detail
        ]);
    }

    /**
     * 列表页
     */
    public function list()
    {
        //单页面 禁止访问
        if ($this->app['controller'] == AppEnum::module['controller']['Intro']) {
            die();
        }

        $param_name = strtolower($this->app['controller']) . '_class_id'; //参数

        $class_id = isset($this->param[$param_name]) ? $this->param[$param_name] : 0;
        if (!is_numeric($class_id)) {
            die('参数格式错误');
        } else if ($class_id <= 0) {
            die('参数错误');
        }

        //主详情
        $main_detail_model_path = $this->get_common_class_path() . "ClassModel";
        $MainDetailModel = new $main_detail_model_path();

        $this->main_detail = $MainDetailModel->get_pass_detail($class_id);
        if ($this->main_detail->isEmpty()) {
            echo '记录不存在';
            die();
        }

        //主分页
        $page = isset($this->param['page']) ? $this->param['page'] : 1; //页码
        $main_page_model_path = $this->get_common_class_path() . "Model";
        $MainPageModel = new $main_page_model_path();

        $main_page = $MainPageModel->get_site_class_pass_page($this->current_site_id, $class_id, $page);
        if (count($main_page['list']) > 0) {
            foreach ($main_page['list'] as $key => $value) {
                $detail_url = $this->lower_controller . '_detail_url';

                $main_page['list'][$key][$this->lower_controller . '_detail_url'] = $detail_url($value['id']);
            }
        }

        $main_page['page_bar'] = $this->get_page_bar($main_page, $class_id);

        $this->merge_main_detail_and_seo_info(); //合并 main_detail、seo_info
        $view_path = $this->main_detail['list_view_path'];

        return view($view_path, [
            'main_detail' => $this->main_detail,
            'main_page' => $main_page
        ]);
    }

    /**
     * 详情页
     * @param int $id
     * @return \think\response\View|void
     */
    public function detail($id = 0)
    {
        if (!is_numeric($id)) {
            die('参数格式错误');
        } else if ($id <= 0) {
            die('参数错误');
        }

        $model_path = $this->get_common_class_path() . "Model";
        $Model = new $model_path();

        $this->main_detail = $Model->get_pass_detail($id);
        if ($this->main_detail->isEmpty()) {
            echo '记录不存在';
            die();
        }

        $this->merge_main_detail_and_seo_info(); //合并 main_detail、seo_info

        if ($this->app['controller'] == AppEnum::module['controller']['Intro']) {
            $view_path = $this->main_detail['detail_view_path'];
        } else {
            $view_path = $this->main_detail['First' . $this->app['controller'] . 'Class']['detail_view_path'];
        }

        return view($view_path, [
            'main_detail' => $this->main_detail
        ]);
    }

    /**
     * 获取 当前站点 数据
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function get_current_site_detail()
    {
        $SiteModel = new SiteModel();

        $site_detail = $SiteModel->get_pass_detail($this->current_site_id);
        if ($site_detail->isEmpty()) {
            echo '站点为空';
            die();
        }

        $site_detail = $site_detail->toArray();

        return $site_detail;
    }

    /**
     * 合并 main_detail、seo_info
     * @return mixed
     */
    private function merge_main_detail_and_seo_info()
    {
        $title = '';
        $keywords = '';
        $description = '';
        $site_title = $this->site_detail['title'] == '' ? $this->site_detail['site_name'] : $this->site_detail['title']; //站点 title

        if ($this->app['controller'] == AppEnum::module['controller']['Index']) {
            $title = '首页-' . $site_title;
            $keywords = $this->site_detail['keywords'];
            $description = $this->site_detail['description'];
        } else {
            $keywords = $this->main_detail['keywords'];
            $description = $this->main_detail['description'];

            switch ($this->app['action']) {
                case AppEnum::module['action']['index']:
                    break;
                case AppEnum::module['action']['list']:
                    $title = $this->main_detail[$this->lower_controller . '_class_name'] . '-' . $site_title;

                    break;
                case AppEnum::module['action']['detail']:
                    $title = $this->main_detail[$this->lower_controller . '_name'] . '-';

                    if ($this->app['controller'] != AppEnum::module['controller']['Intro']) {
                        if ($this->main_detail['first_' . $this->lower_controller . '_class_id'] > 0) {
                            $title .= $this->main_detail['First' . $this->app['controller'] . 'Class'][$this->lower_controller . '_class_name'] . '-';
                        }
                    }

                    $title .= $site_title;

                    break;
            }
        }

        $seo_array = [
            'title' => $title,
            'keywords' => $keywords,
            'description' => $description
        ];

        if (is_object($this->main_detail)) {
            $this->main_detail = $this->main_detail->toArray();
        }

        $this->main_detail = array_merge($this->main_detail, $seo_array);

        return $this->main_detail;
    }

    /**
     * 获取 分页栏
     * @param $data
     * @param $class_id
     * @param string $type
     * @return string
     */
    private function get_page_bar($data, $class_id, $type = 'list')
    {
        $get_class_list_url = $this->lower_controller . '_' . $type . '_url';

        $str = '<div  class="page_bar">';
        $str .= '    <table border="0" cellpadding="0" cellspacing="0">';
        $str .= '        <tr>';

        if ($data['last_page'] > 0) {
            $str .= '            <td><a href="' . $get_class_list_url($class_id) . '">&laquo;</a></td>';

            for ($i = 1; $i <= $data['last_page']; $i++) {
                if ($i == $data['page']) {
                    $class = '" class="active"';
                } else {
                    $class = '';
                }

                $str .= '            <td><a href="' . $get_class_list_url($class_id, $i) . '"' . $class . '>' . $i . '</a></td>';
            }

            $str .= '            <td><a href="' . $get_class_list_url($class_id, $data['last_page']) . '">&raquo;</a></td>';
        }

        $str .= '       </tr>';
        $str .= '   </table>';
        $str .= '</div>';

        return $str;
    }
}