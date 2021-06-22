<?php

namespace app\common\model;

/**
 * 代理 管理员 - 模型
 * Class AgenterModel
 * @package app\common\model
 */
class AgenterModel extends BaseModel
{
    public $name = 'agenter';
    protected $readonly = ['username', 'login_name'];

    /**
     * 构造方法
     * AgenterModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->order = 'sort asc, id asc'; //排序
    }
}