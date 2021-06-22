<?php

namespace app\common\model;

use think\Model;
use think\facade\Db;
use app\common\enum\AppEnum;
use think\model\concern\SoftDelete;
use app\common\service\CookieService;

/**
 * 基类 - 模型
 * Class BaseModel
 * @package app\common\model
 */
class BaseModel extends Model
{
    use SoftDelete; //启用软删除

    protected $jsonAssoc = true; //json 数据返回数组
    protected $CookieService; //cookie
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0; //软删除默认时间戳

    protected $with = ''; //关联模型
    protected $order = 'id ace'; //排序
    protected $page_size = 20; //每页显示数量
    protected $max_level = 0; //最大层级数

    protected $site_id = 0; //站点 id
    protected $siter_id = 0; //站点 管理员 id
    protected $user_id = 0; //会员 id

    protected $any_where = []; //where 任意数据
    protected $pass_where = [['is_pass', '=', 1]]; //where 审核数据
    protected $siter_any_where = []; //where 站点 任意数据
    protected $siter_pass_where = [['is_pass', '=', 1]]; //where 站点 审核数据
    protected $user_any_where = []; //where 会员 任意数据
    protected $user_pass_where = [['is_pass', '=', 1]]; //where 会员 审核数据

    protected $page_field = '*'; //分页 字段
    protected $list_field = '*'; //列表 字段
    protected $detail_field = '*'; //数据 字段

    protected $tree_list_field = ''; //tree 列表 字段
    protected $default_field = ''; //默认字段

    public $cache_json_array = []; //缓存 json 数组

    /**
     * 构造方法
     * BaseModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->CookieService = new CookieService();
        $this->default_field = un_camelize($this->name) . '_name'; //默认字段
    }

    /**
     * 是否 空数据
     * @param $id
     * @return bool
     */
    protected function is_empty_detail($id)
    {
        $detail = $this->findOrEmpty($id);
        if ($detail->isEmpty()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 整理 基础 分页 条件
     * @param $app_enum_type
     * @param $where
     * @return mixed
     */
    protected function parse_base_page_where($app_enum_type, $where)
    {
        switch ($app_enum_type) {
            case AppEnum::admin['enum_type']:
                //admin
                break;
            case AppEnum::site['enum_type']:
                //site
                break;
            case AppEnum::user['enum_type']:
                //user
                break;
        }

        return $where;
    }

    /**
     * 获取 站点 where
     * @param array $where
     * @return array
     */
    protected function get_site_where($where = [])
    {
        if ($this->site_id == 0) {
            $SiterModel = new SiterModel();

            $current_login_detail = $SiterModel->get_current_login_detail();
            if (!$current_login_detail->isEmpty()) {
                $this->site_id = $current_login_detail['site_id'];
            }
        }

        if ($this->name === 'site') {
            $result = array_merge($where, [
                ['id', '=', $this->site_id]
            ]);
        } else {
            $result = array_merge($where, [
                ['site_id', '=', $this->site_id]
            ]);
        }

        return $result;
    }

    /**
     * 获取 会员 where
     * @param array $where
     * @return array
     */
    protected function get_user_where($where = [])
    {
        if ($this->user_id == 0) {
            $UserModel = new UserModel();

            $current_login_detail = $UserModel->get_current_login_detail();
            if (!$current_login_detail->isEmpty()) {
                $this->user_id = $current_login_detail['id'];
            }
        }

        $result = array_merge($where, [
            ['user_id', '=', $this->user_id]
        ]);

        return $result;
    }

    /**
     * 获取 基础 列表
     * @param array $where
     * @param int $limit
     * @param int $offset
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_base_list($where = [], $limit = 0, $offset = 0)
    {
        $result = $this->where($where)->with($this->with)->order($this->order)->select();

        return $result;
    }

    /**
     * 获取 基础 tree 列表
     * @param array $where
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_base_tree_list($where = [])
    {
        $tree_list = [];

        if ($this->tree_list_field == '') {
            $field = 'id, parent_id, level, sort, is_pass, ' . $this->default_field;
        } else {
            $field = $this->tree_list_field;
        }

        $level = 0;
        foreach ($where as $key => $value) {
            if ($value[0] == 'level') {
                $level = $value[2];
            }
        }

        if ($level == 0) {
            $where_1 = array_merge($where, [['level', '=', 1]]);
            $list_1 = $this->field($field)->where($where_1)->order($this->order)->select();

            $where_2 = array_merge($where, [['level', '=', 2]]);
            $list_2 = $this->field($field)->where($where_2)->order($this->order)->select();

            if ($this->max_level == 3) {
                $where_3 = array_merge($where, [['level', '=', 3]]);
                $list_3 = $this->field($field)->where($where_3)->order($this->order)->select();
            } else {
                $list_3 = [];
            }

            if (!$list_1->isEmpty()) {
                foreach ($list_1 as $i => $value) {
                    $children_1 = [];

                    if (!$list_2->isEmpty()) {
                        foreach ($list_2 as $j => $val) {
                            if (($val['parent_id'] == $value['id'])) {
                                $children_2 = [];

                                if (is_object($list_3)) {
                                    if (!$list_3->isEmpty()) {
                                        foreach ($list_3 as $k => $v) {
                                            if (($v['parent_id'] == $val['id'])) {
                                                $children_2[] = $v;

                                                unset($list_3[$k]);
                                            }
                                        }
                                    }
                                }

                                $val['children'] = $children_2;
                                $children_1[] = $val;

                                unset($list_2[$j]);
                            }
                        }
                    }

                    $value['children'] = $children_1;
                    $tree_list[] = $value;

                    unset($list_1[$i]);
                }
            }
        } else {
            $list = $this->field($field)->where($where)->order($this->order)->select();

            if (!$list->isEmpty()) {
                foreach ($list as $key => $value) {
                    if ($level < $this->max_level) {
                        $value['hasChildren'] = true;
                    }

                    $tree_list[] = $value;

                    unset($list[$key]);
                }
            }
        }

        return $tree_list;
    }

    /**
     * 获取 基础 分页
     * @param string $where
     * @param int $page
     * @return array|int
     * @throws \think\db\exception\DbException
     */
    public function get_base_page($where = '', $page = 1)
    {
        $paginate = $this->where($where)->with($this->with)->order($this->order)->paginate($this->page_size, false, [
            'page' => $page,
            'query' => ''
        ])->toArray();

        $result = [
            'page' => $paginate['current_page'],
            'last_page' => $paginate['last_page'],
            'total' => $paginate['total'],
            'page_size' => $paginate['per_page'],
            'list' => $paginate['data']
        ];

        return $result;
    }

    /**
     * 获取 基础 数据
     * @param array $where
     * @return array|\think\db\concern\Model
     */
    public function get_base_detail($where = [])
    {
        $is_insert = true;
        if (!in_array(['id', '=', 0], $where)) {
            $is_insert = false;
        }

        if ($is_insert) {
            $result = $this->get_insert_default_detail();
        } else {
            $result = $this->where($where)->with($this->with)->findOrEmpty();
        }

        return $result;
    }

    /**
     * 获取 基础 option
     * @param array $where
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_base_option($where = [])
    {
        $option[] = [
            'id' => 0,
            'level' => 1,
            'parent_id' => 0,
            $this->default_field => '--请选择--'
        ];

        $list = $this->where($where)->order($this->order)->select();
        foreach ($list as $value) {
            $level = isset($value['level']) ? $value['level'] : 1;
            $parent_id = isset($value['parent_id']) ? $value['parent_id'] : 0;

            $option[] = [
                'id' => $value['id'],
                'level' => $level,
                'parent_id' => $parent_id,
                $this->default_field => $value[$this->default_field]
            ];
        }

        return $option;
    }

    /**
     * 获取 基础 tree
     * @param array $where
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_base_tree($where = [])
    {
        $field = 'id, parent_id, ' . $this->default_field;

        $where_1 = array_merge($where, [['level', '=', 1]]);
        $list_1 = $this->field($field)->where($where_1)->order($this->order)->select();

        $where_2 = array_merge($where, [['level', '=', 2]]);
        $list_2 = $this->field($field)->where($where_2)->order($this->order)->select();

        if ($this->max_level == 3) {
            $where_3 = array_merge($where, [['level', '=', 3]]);
            $list_3 = $this->field($field)->where($where_3)->order($this->order)->select();
        } else {
            $list_3 = [];
        }

        $tree_1 = [];

        if (!$list_1->isEmpty()) {
            foreach ($list_1 as $i => $value) {
                $tree_1[$i] = [
                    'id' => $value['id'],
                    'value' => $value['id'],
                    'label' => $value[$this->default_field],
                    $this->default_field => $value[$this->default_field]
                ];

                $tree_2 = [];

                if (!$list_2->isEmpty()) {
                    foreach ($list_2 as $j => $val) {
                        if ($val['parent_id'] == $value['id']) {
                            $tree_2[$j] = [
                                'id' => $val['id'],
                                'value' => $val['id'],
                                'label' => $val[$this->default_field],
                                $this->default_field => $val[$this->default_field]
                            ];

                            $tree_3 = [];

                            if (is_object($list_3)) {
                                if (!$list_3->isEmpty()) {
                                    foreach ($list_3 as $k => $v) {
                                        if ($v['parent_id'] == $val['id']) {
                                            $tree_3[$k] = [
                                                'id' => $v['id'],
                                                'value' => $v['id'],
                                                'label' => $v[$this->default_field],
                                                $this->default_field => $v[$this->default_field]
                                            ];

                                            unset($list_3[$k]);
                                        }
                                    }
                                }
                            }

                            unset($list_2[$j]);

                            if (count($tree_3) == 0) {
                                //$tree_2[$j]['children'] = [];
                            } else {
                                $tree_2[$j]['children'] = array_merge($tree_3);
                            }
                        }
                    }
                }

                unset($list_1[$i]);

                if (count($tree_2) == 0) {
                    //$tree_1[$i]['children'] = [];
                } else {
                    $tree_1[$i]['children'] = array_merge($tree_2);
                }
            }
        }

        $tree_0 = [[
            'id' => 0,
            'value' => 0,
            'label' => '全部',
            'children' => array_merge($tree_1)
        ]];

        $tree = array_merge($tree_0);

        return $tree;
    }

    /**
     * 获取 基础 cascader
     * @param array $where
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_base_cascader($where = [])
    {
        $field = 'id, parent_id, ' . $this->default_field;

        $where_1 = array_merge($where, [['level', '=', 1]]);
        $list_1 = $this->field($field)->where($where_1)->order($this->order)->select();

        $where_2 = array_merge($where, [['level', '=', 2]]);
        $list_2 = $this->field($field)->where($where_2)->order($this->order)->select();

        if ($this->max_level == 3) {
            $where_3 = array_merge($where, [['level', '=', 3]]);
            $list_3 = $this->field($field)->where($where_3)->order($this->order)->select();
        } else {
            $list_3 = [];
        }

        $cascader_1 = [];

        if (!$list_1->isEmpty()) {
            foreach ($list_1 as $i => $value) {
                $cascader_1[$i] = [
                    'id' => $value['id'],
                    'value' => $value['id'],
                    'label' => $value[$this->default_field],
                    $this->default_field => $value[$this->default_field]
                ];

                $cascader_2 = [];

                if (!$list_2->isEmpty()) {
                    foreach ($list_2 as $j => $val) {
                        if ($val['parent_id'] == $value['id']) {
                            $cascader_2[$j] = [
                                'id' => $val['id'],
                                'value' => $val['id'],
                                'label' => $val[$this->default_field],
                                $this->default_field => $val[$this->default_field]
                            ];

                            $cascader_3 = [];

                            if (is_object($list_3)) {
                                if (!$list_3->isEmpty()) {
                                    foreach ($list_3 as $k => $v) {
                                        if ($v['parent_id'] == $val['id']) {
                                            $cascader_3[$k] = [
                                                'id' => $v['id'],
                                                'value' => $v['id'],
                                                'label' => $v[$this->default_field],
                                                $this->default_field => $v[$this->default_field]
                                            ];

                                            unset($list_3[$k]);
                                        }
                                    }
                                }
                            }

                            unset($list_2[$j]);

                            if (count($cascader_3) == 0) {
                                //$cascader_2[$j]['children'] = [];
                            } else {
                                $cascader_2[$j]['children'] = array_merge($cascader_3);
                            }
                        }
                    }
                }

                unset($list_1[$i]);

                if (count($cascader_2) == 0) {
                    //$cascader_1[$i]['children'] = [];
                } else {
                    $cascader_1[$i]['children'] = array_merge($cascader_2);
                }
            }
        }

        $result = array_merge($cascader_1);

        return $result;
    }

    /**
     * 获取 任意 列表
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_any_list()
    {
        $result = $this->get_base_list($this->any_where);

        return $result;
    }

    public function get_site_any_list()
    {
        $where = $this->get_site_where($this->siter_any_where);

        $result = $this->get_base_list($where);

        return $result;
    }

    public function get_user_any_list()
    {
        $where = $this->get_user_where($this->user_any_where);

        $result = $this->get_base_list($where);

        return $result;
    }

    /**
     * 获取 任意 tree 列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_any_tree_list()
    {
        $result = $this->get_base_tree_list($this->any_where);

        return $result;
    }

    /**
     * 获取 任意 第一层 tree 列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_any_first_level_tree_list()
    {
        $where = array_merge($this->any_where, [['level', '=', '1']]);

        $result = $this->get_base_tree_list($where);

        return $result;
    }

    /**
     * 获取 任意 第二层 tree 列表
     * @param int $parent_id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_any_second_level_tree_list($parent_id = 0)
    {
        $where = array_merge($this->any_where, [['level', '=', '2']]);
        if ($parent_id > 0) {
            $where = array_merge($where, [['parent_id', '=', $parent_id]]);
        }

        $result = $this->get_base_tree_list($where);

        return $result;
    }

    /**
     * 获取 任意 第三层 tree 列表
     * @param int $parent_id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_any_third_level_tree_list($parent_id = 0)
    {
        $where = array_merge($this->any_where, [['level', '=', '3']]);
        if ($parent_id > 0) {
            $where = array_merge($where, [['parent_id', '=', $parent_id]]);
        }

        $result = $this->get_base_tree_list($where);

        return $result;
    }

    public function get_site_any_tree_list()
    {
        $where = $this->get_site_where($this->siter_any_where);

        $result = $this->get_base_tree_list($where);

        return $result;
    }

    public function get_user_any_tree_list()
    {
        $where = $this->get_user_where($this->user_any_where);

        $result = $this->get_base_tree_list($where);

        return $result;
    }

    /**
     * 获取 任意 分页
     * @param array $post
     * @return array|int
     * @throws \think\db\exception\DbException
     */
    public function get_any_page(array $post = [])
    {
        $where = $this->parse_any_page_where($post);
        $page = isset($post['page']) ? $post['page'] : 1;

        $result = $this->get_base_page($where, $page);

        return $result;
    }

    public function get_site_any_page(array $post = [])
    {
        $where = $this->parse_site_any_page_where($post);
        $page = isset($post['page']) ? $post['page'] : 1;

        $result = $this->get_base_page($where, $page);

        return $result;
    }

    public function get_user_any_page(array $post = [])
    {
        $where = $this->parse_user_any_page_where($post);
        $page = isset($post['page']) ? $post['page'] : 1;

        $result = $this->get_base_page($where, $page);

        return $result;
    }

    /**
     * 任意 数据
     * @param $id
     * @return array|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_any_detail($id)
    {
        $where = array_merge($this->any_where, [
            ['id', '=', $id]
        ]);

        $result = $this->get_base_detail($where);

        return $result;
    }

    public function get_site_any_detail($id)
    {
        $where = $this->get_site_where($this->siter_any_where);
        $where = array_merge($where, [
            ['id', '=', $id]
        ]);

        $result = $this->get_base_detail($where);

        return $result;
    }

    public function get_user_any_detail($id)
    {
        $where = $this->get_user_where($this->user_any_where);
        $where = array_merge($where, [
            ['id', '=', $id]
        ]);

        $result = $this->get_base_detail($where);

        return $result;
    }

    /**
     * 获取 审核 列表
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_pass_list()
    {
        $result = $this->get_base_list($this->pass_where);

        return $result;
    }

    public function get_site_pass_list()
    {
        $where = $this->get_site_where($this->siter_pass_where);

        $result = $this->get_base_list($where);

        return $result;
    }

    public function get_user_pass_list()
    {
        $where = $this->get_user_where($this->user_pass_where);

        $result = $this->get_base_list($where);

        return $result;
    }

    /**
     * 获取 审核 tree 列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_pass_tree_list()
    {
        $result = $this->get_base_tree_list($this->pass_where);

        return $result;
    }

    public function get_site_pass_tree_list()
    {
        $where = $this->get_site_where($this->siter_pass_where);

        $result = $this->get_base_tree_list($where);

        return $result;
    }

    public function get_user_pass_tree_list()
    {
        $where = $this->get_user_where($this->user_pass_where);

        $result = $this->get_base_tree_list($where);

        return $result;
    }

    /**
     * 获取 审核 分页
     * @param array $post
     * @return array|int
     * @throws \think\db\exception\DbException
     */
    public function get_pass_page(array $post = [])
    {
        $where = $this->parse_pass_page_where($post);
        $page = isset($post['page']) ? $post['page'] : 1;

        $result = $this->get_base_page($where, $page);

        return $result;
    }

    public function get_site_pass_page(array $post = [])
    {
        $where = $this->parse_site_pass_page_where($post);
        $page = isset($post['page']) ? $post['page'] : 1;

        $result = $this->get_base_page($where, $page);

        return $result;
    }

    public function get_user_pass_page(array $post = [])
    {
        $where = $this->parse_user_pass_page_where($post);
        $page = isset($post['page']) ? $post['page'] : 1;

        $result = $this->get_base_page($where, $page);

        return $result;
    }

    /**
     * 获取 站点 分类 审核 分页 数据
     * @param $site_id
     * @param $class_id
     * @param $page
     * @return array|int
     * @throws \think\db\exception\DbException
     */
    public function get_site_class_pass_page($site_id, $class_id, $page)
    {
        $where = "(is_pass = 1) and (site_id = $site_id) and ((first_" . $this->name . "_class_id = $class_id) or (second_" . $this->name . "_class_id = $class_id))";
        $result = $this->get_base_page($where, $page);

        return $result;
    }

    /**
     * 获取 审核 数据
     * @param $id
     * @return array|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_pass_detail($id)
    {
        $where = array_merge($this->pass_where, [
            ['id', '=', $id]
        ]);

        $result = $this->get_base_detail($where);

        return $result;
    }

    public function get_site_pass_detail($id)
    {
        $where = $this->get_site_where($this->siter_pass_where);
        $where = array_merge($where, [
            ['id', '=', $id]
        ]);

        $result = $this->get_base_detail($where);

        return $result;
    }

    public function get_user_pass_detail($id)
    {
        $where = $this->get_user_where($this->user_pass_where);
        $where = array_merge($where, [
            ['id', '=', $id]
        ]);

        $result = $this->get_base_detail($where);

        return $result;
    }

    /**
     * 获取 审核 option
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_pass_option()
    {
        $result = $this->get_base_option($this->pass_where);

        return $result;
    }

    public function get_site_pass_option()
    {
        $where = $this->get_site_where($this->siter_pass_where);

        $result = $this->get_base_option($where);

        return $result;
    }

    public function get_user_pass_option()
    {
        $where = $this->get_user_where($this->user_pass_where);

        $result = $this->get_base_option($where);

        return $result;
    }

    /**
     * 获取 审核 第一层 option
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_pass_first_level_option()
    {
        $where = array_merge($this->pass_where, [['level', '=', 1]]);

        $result = $this->get_base_option($where);

        return $result;
    }

    public function get_site_pass_first_level_option()
    {
        $where = $this->get_site_where([['level', '=', 1]]);

        $result = $this->get_base_option($where);

        return $result;
    }

    public function get_user_pass_first_level_option()
    {
        $where = $this->get_user_where([['level', '=', 1]]);

        $result = $this->get_base_option($where);

        return $result;
    }

    /**
     * 获取 审核 tree
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_pass_tree()
    {
        $result = $this->get_base_tree($this->pass_where);

        return $result;
    }

    public function get_site_pass_tree()
    {
        $where = $this->get_site_where($this->siter_pass_where);

        $result = $this->get_base_tree($where);

        return $result;
    }

    public function get_user_pass_tree()
    {
        $where = $this->get_user_where($this->user_pass_where);

        $result = $this->get_base_tree($where);

        return $result;
    }

    /**
     * 获取 审核 cascader
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get_pass_cascader()
    {
        $result = $this->get_base_cascader($this->pass_where);

        return $result;
    }

    public function get_site_pass_cascader()
    {
        $where = $this->get_site_where($this->siter_pass_where);

        $result = $this->get_base_cascader($where);

        return $result;
    }

    public function get_user_pass_cascader()
    {
        $where = $this->get_user_where($this->user_pass_where);

        $result = $this->get_base_cascader($where);

        return $result;
    }

    /**
     * 获取 基础字段 id
     * @param string $field_name
     * @param string $field_value
     * @return int
     */
    protected function get_base_field_id(string $field_name, string $field_value): int
    {
        if ($field_value == '') {
            return 0;
        } else {
            $where[$field_name] = $field_value;

            $id = $this->where($where)->value('id');
            if ($id == '') {
                return 0;
            } else {
                return $id;
            }
        }
    }

    /**
     * 獲取 基礎 排序
     * @param array $where
     * @return int|mixed
     */
    public function get_basse_sort($where = [])
    {
        $sort = $this->where($where)->max('sort');

        $result = $sort + 1;

        return $result;
    }

    /**
     * 获取 任意排序值
     */
    public function get_any_sort()
    {
        $result = $this->get_basse_sort();

        return $result;
    }

    /**
     *
     * @return int|mixed
     */
    public function get_site_sort()
    {
        $where = $this->get_site_where();
        $result = $this->get_basse_sort($where);

        return $result;
    }

    /**
     * 获取 权限列表
     * @param $app_enum_type
     * @param $id
     * @return array
     */
    public function get_role_rule_list($app_enum_type, $id)
    {
        $loginer_table = DB_PREFIX . $app_enum_type;
        if ($app_enum_type == AppEnum::site['enum_type']) {
            $loginer_table .= 'r';
        }

        $role_table = DB_PREFIX . 'role';
        $role_rule_table = DB_PREFIX . 'role_rule';

        $sql = "select id, `level`, first_role_rule_id, second_role_rule_id, parent_id, role_rule_name, module_url, api_url
            from $role_rule_table
            where (is_pass = 1) and (delete_time = 0)
                and (
                    (find_in_set(id, (select role_rule_ids from $role_table where id = (select role_id from $loginer_table where id = $id))))
                    or (find_in_set(id, (select group_concat(distinct role_rule_ids separator '') as role_rule_ids from $role_rule_table
                        where find_in_set(id, (select role_rule_ids from $role_table where id = (select role_id from $loginer_table where id = $id))))))
                )
            order by sort asc, id asc";

        $result = Db::query($sql);

        return $result;
    }

    /**
     * 获取 登录信息(未登录)
     * @param $username
     * @param $password
     * @return array|\think\db\concern\Model
     */
    public function get_login_detail($username, $password)
    {
        $where = [
            'is_pass' => 1,
            'login_name' => md5($username),
            'password' => md5($password)
        ];

        $result = $this->where($where)->findOrEmpty();

        return $result;
    }

    /**
     * 获取 当前登录数据（已登录）
     * @return array|\think\db\concern\Model
     */
    public function get_current_login_detail()
    {
        $where['is_pass'] = 1;

        switch ($this->name) {
            case AppEnum::admin['enum_type']:
                $admin_id = $this->CookieService->get_admin_id();
                $admin_login_name = $this->CookieService->get_admin_login_name();

                $where = array_merge($where, [
                    'id' => $admin_id,
                    'login_name' => $admin_login_name
                ]);

                break;
            case AppEnum::site['enum_type'] . 'r':
                $site_id = $this->CookieService->get_site_id();
                $siter_id = $this->CookieService->get_siter_id();
                $siter_login_name = $this->CookieService->get_siter_login_name();

                $where = array_merge($where, [
                    'site_id' => $site_id,
                    'id' => $siter_id,
                    'login_name' => $siter_login_name
                ]);

                break;
            case AppEnum::user['enum_type']:
                $user_id = $this->CookieService->get_user_id();
                $user_login_name = $this->CookieService->get_user_login_name();

                $where = array_merge($where, [
                    'id' => $user_id,
                    'login_name' => $user_login_name
                ]);

                break;
        }

        $result = $this->where($where)->findOrEmpty();

        return $result;
    }

    /**
     * 保存 数据
     * @param array $data
     * @return int
     */
    public function save_data(array $data)
    {
        if (isset($data['id'])) {
            if ($data['id'] == 0) {
                $result = $this->insert_data($data);
            } else {
                $result = $this->update_data($data);
            }
        } else {
            $result = $this->insert_data($data);
        }

        return $result;
    }

    /**
     * 添加 数据
     * @param array $data
     * @return int
     */
    public function insert_data(array $data)
    {
        if (isset($data['id'])) {
            unset($data['id']);
        }

        $result = $this->save($data);
        if ($result === false) {
            return 0;
        } else {
            $id = $this->id;

            return $id;
        }
    }

    /**
     * 添加 批量数据
     * @param $data
     * @return bool|int
     * @throws \Exception
     */
    public function insert_all_data($data)
    {
        $result = $this->saveAll($data);
        if ($result === false) {
            return 0;
        } else {
            return true;
        }
    }

    /**
     * 更新 数据
     * @param array $data
     * @return int
     */
    public function update_data(array $data)
    {
        $id = $data['id'];
        if ($this->is_empty_detail($id)) {
            return 0;
        }

        if (isset($data['create_time'])) {
            unset($data['create_time']);
        }

        if (isset($data['update_time'])) {
            unset($data['update_time']);
        }

        $result = $this->update($data, ['id' => $id]);
        if ($result === false) {
            return 0;
        } else {
            return $id;
        }
    }

    /**
     * 更新 批量数据
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function update_all_data(array $data)
    {
        $result = $this->saveAll($data);
        if ($result === false) {
            return 0;
        } else {
            return true;
        }
    }

    /**
     * 删除 数据
     * @param $id
     * @param bool $is_soft_delete
     * @return bool|int
     */
    public function delete_data($id, $is_soft_delete = false)
    {
        if ($this->is_empty_detail($id)) {
            return 0;
        }

        $result = $this->destroy($id);
        if ($result === false) {
            return 0;
        } else {
            return $result;
        }
    }
}