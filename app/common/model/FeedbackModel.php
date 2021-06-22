<?php

namespace app\common\model;

use app\common\enum\AppEnum;

/**
 * 用户反馈
 * Class FeedbackModel
 * @package app\common\model
 */
class FeedbackModel extends BaseModel
{
    protected $name = 'feedback';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->with = ['User']; //关联模型
        $this->order = 'id desc'; //排序
    }

    /**
     * 用户 - 关联模型
     * @return \think\model\relation\HasOne
     */
    public function User()
    {
        return $this->hasOne('UserModel', 'id', 'user_id');
    }

    /**
     * 整理 站点 任意 分页 条件
     * @param array $post
     * @return string
     */
    public function parse_any_page_where(array $post)
    {
        $where = "(id > 0)";

        $where = $this->parse_base_page_where(AppEnum::site['enum_type'], $where);

        return $where;
    }
}