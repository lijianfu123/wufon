<?php

namespace app\admin\controller;

use app\common\enum\AppEnum;

/**
 * 后台管理 > 权限规则
 * Class RoleRuleController
 * @package app\admin\controller
 */
class RoleRuleController extends BaseController
{

    private function base_index($app_enum_type)
    {
        return view('index', [
            'app_enum_type' => $app_enum_type
        ]);
    }

    private function base_insert($app_enum_type)
    {
        return view('edit', [
            'id' => 0,
            'app_enum_type' => $app_enum_type
        ]);
    }

    private function base_update($app_enum_type, $id = 0)
    {
        return view('edit', [
            'id' => $id,
            'app_enum_type' => $app_enum_type
        ]);
    }

    public function admin_index()
    {
        return $this->base_index(AppEnum::admin['enum_type']);
    }

    public function admin_insert()
    {
        return $this->base_insert(AppEnum::admin['enum_type']);
    }

    public function admin_update($id = 0)
    {
        return $this->base_update(AppEnum::admin['enum_type'], $id);
    }

    public function site_index()
    {
        return $this->base_index(AppEnum::site['enum_type']);
    }

    public function site_insert()
    {
        return $this->base_insert(AppEnum::site['enum_type']);
    }

    public function site_update($id = 0)
    {
        return $this->base_update(AppEnum::site['enum_type'], $id);
    }

    public function user_index()
    {
        return $this->base_index(AppEnum::user['enum_type']);
    }

    public function user_insert()
    {
        return $this->base_insert(AppEnum::user['enum_type']);
    }

    public function user_update($id = 0)
    {
        return $this->base_update(AppEnum::user['enum_type'], $id);
    }
}