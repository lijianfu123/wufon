<?php

namespace app\common\model;

/**
 * 代理 - 模型
 * Class AgentModel
 * @package app\common\model
 */
class AgentModel extends BaseModel
{
    protected $name = 'agent';

    /**
     * 构造方法
     * AgentModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->order = 'id desc'; //排序
    }
}