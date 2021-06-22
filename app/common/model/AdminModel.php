<?php

namespace app\common\model;

/**
 * 后台 管理员 - 模型
 * Class AdminModel
 * @package app\common\model
 */
class AdminModel extends BaseModel
{
    public $name = 'admin';
    protected $readonly = ['username', 'login_name'];

    /**
     * 构造方法
     * AdminModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->order = 'sort asc, id asc'; //排序
        $this->with = ['Role']; //关联模型
    }

    /**
     * 角色 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function Role()
    {
        return $this->hasOne('RoleModel', 'id', 'role_id')->field('id, role_name');
    }

    /**
     * 获取 添加 默认数据
     * @return array
     */
    public function get_insert_default_detail()
    {
        return [
            'id' => 0,
            'role_id' => 0,
            'is_pass' => 1,
            'is_main_admin' => 0,
            'sort' => $this->get_any_sort()
        ];
    }
}