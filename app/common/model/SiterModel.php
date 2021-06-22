<?php

namespace app\common\model;

/**
 * 站点 管理员 - 模型
 * Class SiterModel
 * @package app\common\model
 */
class SiterModel extends BaseModel
{
    public $name = 'siter';
    protected $readonly = ['username', 'login_name'];

    /**
     * 构造方法
     * SiterModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->with = $with = ['Role', 'Site']; //关联模型
        $this->order = 'sort asc, id asc'; //排序
    }

    /**
     * 权限 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function Role()
    {
        return $this->hasOne('RoleModel', 'id', 'role_id')->field('id, role_name');
    }

    /**
     * 站点 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function Site()
    {
        return $this->hasOne('SiteModel', 'id', 'site_id')->field('id, site_name');
    }

    /**
     * 整理 任意分页 条件
     * @param array $post
     * @return string
     */
    public function parse_any_page_where(array $post = [])
    {
        $where = "(id > 0)";

        if (isset($post['site_id'])) {
            if ($post['site_id'] > 0) {
                $where .= " and (site_id = {$post['site_id']})";
            }
        }

        if (isset($post['keyword'])) {
            if ($post['keyword'] != '') {
                $where .= " and (username like '%{$post['keyword']}%')";
            }
        }

        $where = $this->parse_base_page_where('', $where);

        return $where;
    }

    /**
     * 获取 添加 默认数据
     * @return array
     */
    public function get_insert_default_detail()
    {
        return [
            'id' => 0,
            'site_id' => 0,
            'role_id' => 0,
            'is_pass' => 1,
            'is_main_admin' => 0,
            'sort' => $this->get_site_sort()
        ];
    }
}