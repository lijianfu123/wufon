<?php

use think\facade\Cache;
use think\facade\Config;
use \think\facade\Route;
use app\common\enum\AppEnum;
use app\common\service\CookieService;

/**
 * 是否 拥有 权限
 * @param $role_param
 * @param array $role_rule_list
 * @return bool
 */
function is_has_role($role_param, $role_rule_list = [])
{
    $request = request();

    if (is_array($role_param)) {
        $app_enum_type = $role_param['app_enum_type'];
        $action = $role_param['action'];

        if (isset($role_param['controller'])) {
            $controller = $role_param['controller'];
        } else {
            $controller = $request->controller();
        }
    } else {
        $app_enum_type = str_replace('/', '', $request->root());
        $controller = $request->controller();
        $action = $role_param;
    }

    $role_url = '/' . $app_enum_type . '/' . $controller . '/' . $action; //权限地址
    if (isset($role_param['role_type'])) {
        if ($role_param['role_type'] != '') {
            $role_url .= '?role_type=' . $role_param['role_type'];
        }
    }

    if (count($role_rule_list) == 0) {
        $id = 0;
        $CookieService = new CookieService();

        if ($app_enum_type == AppEnum::api['enum_type']) {
            switch ($role_param['login_type']) {
                case AppEnum::admin['enum_type']:
                    $id = $CookieService->get_admin_id();

                    break;
                case AppEnum::site['enum_type']:
                    $id = $CookieService->get_siter_id();

                    break;
                case AppEnum::user['enum_type']:
                    $id = $CookieService->get_user_id();

                    break;
            }

            if ($role_param['login_type'] == AppEnum::site['enum_type']) {
                $role_rule_list = Cache::get(AppEnum::site['enum_type'] . '_role_rule_' . $id);
            } else {
                $role_rule_list = Cache::get($role_param['login_type'] . '_role_rule_' . $id);
            }
        } else {
            switch ($app_enum_type) {
                case AppEnum::admin['enum_type']:
                    $id = $CookieService->get_admin_id();

                    break;
                case AppEnum::site['enum_type']:
                    $id = $CookieService->get_siter_id();

                    break;
                case AppEnum::user['enum_type']:
                    $id = $CookieService->get_user_id();

                    break;
            }

            if ($app_enum_type == AppEnum::site['enum_type']) {
                $role_rule_list = Cache::get(AppEnum::site['enum_type'] . '_role_rule_' . $id);
            } else {
                $role_rule_list = Cache::get($app_enum_type . '_role_rule_' . $id);
            }
        }
    }

    $is_has = false;
    if (count($role_rule_list) > 0) {
        foreach ($role_rule_list as $key => $value) {
            if (($value['module_url'] == $role_url) || ($value['api_url'] == $role_url)) {
                $is_has = true;

                break;
            }
        }
    }

    return $is_has;
}

/**
 * 验证码
 * @param int $width
 * @param int $height
 * @return string
 */
function captcha_image($width = 88, $height = 30)
{
    return '<img ref="captcha" class="captcha" src="/captcha.html" onclick="this.src=\'/captcha.html?\' + Math.random();" style="width: ' . $width . 'px; height: ' . $height . 'px; border: 1px solid #cccccc; margin-top: 4px; cursor: pointer;">';
}

/**
 * 超管 图标
 * @return string
 */
function main_admin_ico()
{
    return '<i class="el-icon-success" style="color: #409EFF; font-size: 20px;"></i>';
}

/**
 * 分页 栏
 * @return string
 */
function page_bar()
{
    return '<el-pagination ref="pagination" background layout="total, prev, pager, next" :total="main_page.total" :page-size="main_page.page_size" @current-change="search_data(true)"></el-pagination>';
}

/**
 * 刷新 数据 按钮
 * @return string
 */
function reload_data_button()
{
    $str = '刷新';
    if (request()->isMobile()) {
        $str = '';
    }

    return '<el-button class="el-icon-refresh" size="mini" :disabled="is_disabled_reload_data_button" @click="reload_data()">' . $str . '</el-button>';
}

/**
 * 关闭 按钮
 * @return string
 */
function close_button()
{
    $str = '关闭';
    if (request()->isMobile()) {
        $str = '';
    }

    return '<el-button ref="close_button" class="el-icon-close" size="mini" @click="close_dialog()">' . $str . '</el-button>';
}

/**
 * 搜索 数据 按钮
 * @return string
 */
function search_data_button()
{
    return '<el-button type="success" native-type="submit" size="mini" class="el-icon-search" @click="search_data">搜索</el-button>';
}

/**
 * 基础 保存密码 按钮
 * @param $app_enum_type
 * @return string
 */
function base_update_password_button($app_enum_type)
{
    $action = $app_enum_type . '_update_password';

    if (is_has_role($action)) {
        $str = '提交';
        if (request()->isMobile()) {
            $str = '';
        }

        return '<el-button type="primary" native-type="submit" class="el-icon-check" size="mini" :loading="is_loading_submit_button" @click="' . $action . '()">' . $str . '</el-button>';
    }
}

/**
 * 后台 保存密码 按钮
 * @return string
 */
function admin_update_password_button()
{
    return base_update_password_button(AppEnum::admin['enum_type']);
}

/**
 * 站点 保存密码 按钮
 * @return string
 */
function siter_update_password_button()
{
    return base_update_password_button(AppEnum::site['enum_type']);
}

/**
 * 会员 保存密码 按钮
 * @return string
 */
function user_update_password_button()
{
    return base_update_password_button(AppEnum::user['enum_type']);
}

/**
 * 基础 排序 输入框
 * @param $app_enum_type
 * @param string $role_type
 * @return string
 */
function base_sort_input($app_enum_type, $role_type = '')
{
    $action = $app_enum_type . '_update_sort';

    $role_param = [
        'login_type' => $app_enum_type,
        'app_enum_type' => AppEnum::api['enum_type'],
        'action' => $action,
        'role_type' => $role_type
    ];

    if (is_has_role($role_param)) {
        return '<el-input-number size="mini" precision="0" :min="1" :controls="false" class="width_80" v-model="scope.row.sort"></el-input-number>';
    } else {
        return '<div>{{scope.row.sort}}</div>';
    }
}

/**
 * 应用类型 排序 输入框
 * @param string $role_type
 * @return string
 */
function app_enum_type_sort_input($role_type = '')
{
    return base_sort_input(AppEnum::admin['enum_type'], $role_type);
}

/**
 * 后台 排序 输入框
 * @return string
 */
function admin_sort_input()
{
    return base_sort_input(AppEnum::admin['enum_type']);
}

/**
 * 站点 排序 输入框
 * @return string
 */
function site_sort_input()
{
    return base_sort_input(AppEnum::site['enum_type']);
}

/**
 * 会员 排序 输入框
 * @return string
 */
function user_sort_input()
{
    return base_sort_input(AppEnum::user['enum_type']);
}

/**
 * 基础 保存数据 按钮
 * @param $app_enum_type
 * @param string $action
 * @return string
 */
function base_save_data_button($app_enum_type, $action = '')
{
    if ($action === '') {
        $action = $app_enum_type . '_save_data';
    }

    //if (is_has_role($action)) {
    $str = '提交';
    if (request()->isMobile()) {
        $str = '';
    }

    return '<el-button type="primary" native-type="submit" class="el-icon-check" size="mini" :loading="is_loading_submit_button" @click="' . $action . '()">' . $str . '</el-button>';
    //}
}

/**
 * 后台 保存数据 按钮
 * @return string
 */
function admin_save_data_button()
{
    return base_save_data_button(AppEnum::admin['enum_type']);
}

/**
 * 站点 保存数据 按钮
 * @return string
 */
function site_save_data_button()
{
    return base_save_data_button(AppEnum::site['enum_type']);
}

/**
 * 会员 保存数据 按钮
 * @return string
 */
function user_save_data_button()
{
    return base_save_data_button(AppEnum::user['enum_type']);
}

/**
 * 基础 添加 按钮
 * @param $width
 * @param $height
 * @param $app_enum_type
 * @param string $action
 * @return string
 */
function base_insert_button($width, $height, $app_enum_type, $action = '')
{
    if ($action == '') {
        $action = 'insert';
    }

    if (is_has_role($action)) {
        $str = '添加';
        if (request()->isMobile()) {
            $str = '';
        }

        return '<el-button type="primary" class="el-icon-plus" size="mini" @click="show_dialog(\'添加\', \'' . Route::buildUrl($action) . '\', \'' . $width . '\', \'' . $height . '\')">' . $str . '</el-button>';
    }
}

/**
 * 应用类型 添加 按钮
 * @param $width
 * @param $height
 * @param $app_enum_type
 * @return string
 */
function app_enum_type_insert_button($width, $height, $app_enum_type)
{
    return base_insert_button($width, $height, $app_enum_type, $app_enum_type . '_insert');
}

/**
 * 后台 添加 按钮
 * @param $width
 * @param $height
 * @return string
 */
function admin_insert_button($width, $height)
{
    return base_insert_button($width, $height, AppEnum::admin['enum_type']);
}

/**
 * 站点 添加 按钮
 * @param $width
 * @param $height
 * @return string
 */
function site_insert_button($width, $height)
{
    return base_insert_button($width, $height, AppEnum::site['enum_type']);
}

/**
 * 会员 添加 按钮
 * @param $width
 * @param $height
 * @return string
 */
function user_insert_button($width, $height)
{
    return base_insert_button($width, $height, AppEnum::user['enum_type']);
}

/**
 * 基础 修改 按钮
 * @param $width
 * @param $height
 * @param $app_enum_type
 * @param string $action
 * @return string
 */
function base_update_button($width, $height, $app_enum_type, $action = '')
{
    if ($action == '') {
        $action = 'update';
    }

    if (is_has_role($action)) {
        $str = '修改';
        if (request()->isMobile()) {
            $str = '';
        }

        $url_html_suffix = '.' . Config::get('route.url_html_suffix'); //地址后缀

        $url = Route::buildUrl($action);
        $url = str_replace($url_html_suffix, '', $url);

        return '<el-button type="primary" class="el-icon-edit" size="mini" @click="show_dialog(\'修改\', \'' . $url . '/id/\' + scope.row.id + \'' . $url_html_suffix . '\', \'' . $width . '\', \'' . $height . '\')">' . $str . '</el-button>';
    }
}

/**
 * 应用类型 修改 按钮
 * @param $width
 * @param $height
 * @param $app_enum_type
 * @return string
 */
function app_enum_type_update_button($width, $height, $app_enum_type)
{
    return base_update_button($width, $height, $app_enum_type, $app_enum_type . '_update');
}

/**
 * 后台 修改 按钮
 * @param $width
 * @param $height
 * @return string
 */
function admin_update_button($width, $height)
{
    return base_update_button($width, $height, AppEnum::admin['enum_type']);
}

/**
 * 站点 修改 按钮
 * @param $width
 * @param $height
 * @return string
 */
function site_update_button($width, $height)
{
    return base_update_button($width, $height, AppEnum::site['enum_type']);
}

/**
 * 会员 修改 按钮
 * @param $width
 * @param $height
 * @return string
 */
function user_update_button($width, $height)
{
    return base_update_button($width, $height, AppEnum::user['enum_type']);
}

/**
 * 基础 删除数据 按钮
 * @param $app_enum_type
 * @param string $role_type
 * @return string
 */
function base_delete_data_button($app_enum_type, $role_type = '')
{
    $action = $app_enum_type . '_delete_data';

    $role_param = [
        'login_type' => $app_enum_type,
        'app_enum_type' => AppEnum::api['enum_type'],
        'action' => $action,
        'role_type' => $role_type
    ];

    if (is_has_role($role_param)) {
        $str = '删除';
        if (request()->isMobile()) {
            $str = '';
        }

        return '<el-button type="danger" class="el-icon-delete" size="mini" @click="' . $action . '(scope.row.id)">' . $str . '</el-button>';
    }
}

/**
 * 应用类型 删除数据 按钮
 * @param string $role_type
 * @return string
 */
function app_enum_type_delete_data_button($role_type = '')
{
    return base_delete_data_button(AppEnum::admin['enum_type'], $role_type);
}

/**
 * 后台 删除数据 按钮
 * @return string
 */
function admin_delete_data_button()
{
    return base_delete_data_button(AppEnum::admin['enum_type']);
}

/**
 * 站点 删除数据 按钮
 * @return string
 */
function site_delete_data_button()
{
    return base_delete_data_button(AppEnum::site['enum_type']);
}

/**
 * 会员 删除数据 按钮
 * @return string
 */
function user_delete_data_button()
{
    return base_delete_data_button(AppEnum::user['enum_type']);
}

/**
 * 基础 更新 排序 按钮
 * @param $app_enum_type
 * @param string $role_type
 * @return string
 */
function base_update_sort_button($app_enum_type, $role_type = '')
{
    $action = $app_enum_type . '_update_sort';

    $role_param = [
        'login_type' => $app_enum_type,
        'app_enum_type' => AppEnum::api['enum_type'],
        'action' => $action,
        'role_type' => $role_type
    ];

    if (is_has_role($role_param)) {
        $str = '保存排序';
        if (request()->isMobile()) {
            $str = '排序';
        }

        return '<el-button type="primary" class="el-icon-check" size="mini" :disabled="is_disabled_update_sort_button" @click="' . $action . '()">' . $str . '</el-button>';
    }
}

/**
 * 应用类型 更新 排序 按钮
 * @param string $role_type
 * @return string
 */
function app_enum_type_update_sort_button($role_type = '')
{
    return base_update_sort_button(AppEnum::admin['enum_type'], $role_type);
}

/**
 * 后台 更新 排序 按钮
 * @return string
 */
function admin_update_sort_button()
{
    return base_update_sort_button(AppEnum::admin['enum_type']);
}

/**
 * 站点 更新 排序 按钮
 * @return string
 */
function site_update_sort_button()
{
    return base_update_sort_button(AppEnum::site['enum_type']);
}

/**
 * 会员 更新 排序 按钮
 * @return string
 */
function user_update_sort_button()
{
    return base_update_sort_button(AppEnum::user['enum_type']);
}

/**
 * 基础 更新 是否 审核 按钮
 * @param $app_enum_type
 * @param string $role_type
 * @param bool $is_enable
 * @return string
 */
function base_update_is_pass_button($app_enum_type, $role_type = '', $is_enable = true)
{
    $action = $app_enum_type . '_update_is_pass';

    $role_param = [
        'login_type' => $app_enum_type,
        'role_type' => $role_type,
        'app_enum_type' => AppEnum::api['enum_type'],
        'action' => $action
    ];

    if (is_has_role($role_param)) {
        $disabled = $is_enable ? '' : 'disabled';

        return '<el-switch ' . $disabled . ' v-model="scope.row.is_pass" @change="' . $action . '(scope.row)"></el-switch>';
    } else {
        $str = '<i class="el-icon-success"  style="color: #409EFF; font-size: 20px;" v-if="Number(scope.row.is_pass) === 1"></i>';
        $str .= '<i class="el-icon-error"  style="color: #F56C6C; font-size: 20px;" v-else></i>';

        return $str;
    }
}

/**
 * 应用类型 更新 是否 审核 按钮
 * @param $role_type
 * @return string
 */
function app_enum_type_update_is_pass_button($role_type = '')
{
    return base_update_is_pass_button(AppEnum::admin['enum_type'], $role_type);
}

/**
 * 后台 更新 是否 审核 按钮
 * @param $is_enable
 * @return string
 */
function admin_update_is_pass_button($is_enable = true)
{
    return base_update_is_pass_button(AppEnum::admin['enum_type'], '', $is_enable);
}

/**
 * 站点 更新 是否 审核 按钮
 * @param bool $is_enable
 * @return string
 */
function site_update_is_pass_button($is_enable = true)
{
    return base_update_is_pass_button(AppEnum::site['enum_type'], '', $is_enable);
}

/**
 * 会员 更新 是否 审核 按钮
 * @param bool $is_enable
 * @return string
 */
function user_update_is_pass_button($is_enable = true)
{
    return base_update_is_pass_button(AppEnum::user['enum_type'], '', $is_enable);
}

/**
 * 基础 更新 是否 推荐 按钮
 * @param $app_enum_type
 * @return string
 */
function base_update_is_commend_button($app_enum_type)
{
    $action = $app_enum_type . '_update_is_commend';

    $role_param = [
        'login_type' => $app_enum_type,
        'app_enum_type' => AppEnum::api['enum_type'],
        'action' => $action
    ];

    if (is_has_role($role_param)) {
        return '<el-switch v-model="scope.row.is_commend" @change="' . $action . '(scope.row)"></el-switch>';
    } else {
        $str = '<i class="el-icon-success"  style="color: #409EFF; font-size: 20px;" v-if="Number(scope.row.is_commend) === 1"></i>';
        $str .= '<i class="el-icon-error"  style="color: #F56C6C; font-size: 20px;" v-else></i>';

        return $str;
    }
}

/**
 * 后台 更新 是否 推荐 按钮
 * @return string
 */
function admin_update_is_commend_button()
{
    return base_update_is_commend_button(AppEnum::admin['enum_type']);
}

/**
 * 站点 更新 是否 推荐 按钮
 * @return string
 */
function site_update_is_commend_button()
{
    return base_update_is_commend_button(AppEnum::site['enum_type']);
}

/**
 * 会员 更新 是否 推荐 按钮
 * @return string
 */
function user_update_is_commend_button()
{
    return base_update_is_commend_button(AppEnum::user['enum_type']);
}

/**
 * 基础 更新 是否 最新、新品 按钮
 * @param $app_enum_type
 * @return string
 */
function base_update_is_new_button($app_enum_type)
{
    $action = $app_enum_type . '_update_is_new';

    $role_param = [
        'login_type' => $app_enum_type,
        'app_enum_type' => AppEnum::api['enum_type'],
        'action' => $action
    ];

    if (is_has_role($role_param)) {
        return '<el-switch v-model="scope.row.is_new" @change="' . $action . '(scope.row)"></el-switch>';
    } else {
        return '<i class="el-icon-success"  style="color: #409EFF; font-size: 20px;" v-if="Number(scope.row.is_new) === 1"></i>';
    }
}

/**
 * 后台 更新 是否 最新、新品 按钮
 * @return string
 */
function admin_update_is_new_button()
{
    return base_update_is_new_button(AppEnum::admin['enum_type']);
}

/**
 * 站点 更新 是否 最新、新品 按钮
 * @return string
 */
function site_update_is_new_button()
{
    return base_update_is_new_button(AppEnum::site['enum_type']);
}

/**
 * 会员 更新 是否 最新、新品 按钮
 * @return string
 */
function user_update_is_new_button()
{
    return base_update_is_new_button(AppEnum::user['enum_type']);
}

/**
 * 基础 更新 是否 热点、热卖 按钮
 * @param $app_enum_type
 * @return string
 */
function base_update_is_hot_button($app_enum_type)
{
    $action = $app_enum_type . '_update_is_hot';

    $role_param = [
        'login_type' => $app_enum_type,
        'app_enum_type' => AppEnum::api['enum_type'],
        'action' => $action
    ];

    if (is_has_role($role_param)) {
        return '<el-switch v-model="scope.row.is_hot" @change="' . $action . '(scope.row)"></el-switch>';
    } else {
        return '<i class="el-icon-success"  style="color: #409EFF; font-size: 20px;" v-if="Number(scope.row.is_new) === 1"></i>';
    }
}

/**
 * 后台 更新 是否 热点、热卖 按钮
 * @return string
 */
function admin_update_is_hot_button()
{
    return base_update_is_hot_button(AppEnum::admin['enum_type']);
}

/**
 * 站点 更新 是否 热点、热卖 按钮
 * @return string
 */
function site_update_is_hot_button()
{
    return base_update_is_hot_button(AppEnum::site['enum_type']);
}

/**
 * 会员 更新 是否 热点、热卖 按钮
 * @return string
 */
function user_update_is_hot_button()
{
    return base_update_is_hot_button(AppEnum::user['enum_type']);
}

/**
 * 基础 更新 是否 置顶 按钮
 * @param $app_enum_type
 * @return string
 */
function base_update_is_top_button($app_enum_type)
{
    $action = $app_enum_type . '_update_is_top';

    $role_param = [
        'login_type' => $app_enum_type,
        'app_enum_type' => AppEnum::api['enum_type'],
        'action' => $action
    ];

    if (is_has_role($role_param)) {
        return '<el-switch v-model="scope.row.is_top" @change="' . $action . '(scope.row)"></el-switch>';
    } else {
        return '<i class="el-icon-success"  style="color: #409EFF; font-size: 20px;" v-if="Number(scope.row.is_top) === 1"></i>';
    }
}

/**
 * 后台 更新 是否 置顶 按钮
 * @return string
 */
function admin_update_is_top_button()
{
    return base_update_is_top_button(AppEnum::admin['enum_type']);
}

/**
 * 站点 更新 是否 置顶 按钮
 * @return string
 */
function site_update_is_top_button()
{
    return base_update_is_top_button(AppEnum::site['enum_type']);
}

/**
 * 会员 更新 是否 置顶 按钮
 * @return string
 */
function user_update_is_top_button()
{
    return base_update_is_top_button(AppEnum::user['enum_type']);
}

/**
 * 基础 更新 是否 默认 按钮
 * @param $app_enum_type
 * @return string
 */
function base_update_is_default_button($app_enum_type)
{
    $action = $app_enum_type . '_update_is_default';

    $role_param = [
        'login_type' => $app_enum_type,
        'app_enum_type' => AppEnum::api['enum_type'],
        'action' => $action
    ];

    if (is_has_role($role_param)) {
        return '<el-switch v-model="scope.row.is_default" @change="' . $action . '(scope.row)"></el-switch>';
    } else {
        return '<i class="el-icon-success"  style="color: #409EFF; font-size: 20px;" v-if="Number(scope.row.is_default) === 1"></i>';
    }
}

/**
 * 后台 更新 是否 默认 按钮
 * @return string
 */
function admin_update_is_default_button()
{
    return base_update_is_default_button(AppEnum::admin['enum_type']);
}

/**
 * 站点 更新 是否 默认 按钮
 * @return string
 */
function site_update_is_default_button()
{
    return base_update_is_default_button(AppEnum::site['enum_type']);
}

/**
 * 会员 更新 是否 默认 按钮
 * @return string
 */
function user_update_is_default_button()
{
    return base_update_is_default_button(AppEnum::user['enum_type']);
}