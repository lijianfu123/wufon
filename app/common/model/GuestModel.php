<?php

namespace app\common\model;

/**
 * 留言
 * Class GuestModel
 * @package app\common\model
 */
class GuestModel extends BaseModel
{
    protected $name = 'guest';

    /**
     * 构造方法
     * ColorModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->order = 'id desc';
    }
}