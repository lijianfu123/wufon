<?php

namespace app\common\logic;

/**
 * 幻灯片 - 逻辑
 * Class SwiperLogic
 * @package app\common\logic
 */
class SwiperLogic extends BaseLogic
{
    /**
     * 构造方法
     * SwiperLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'swiper_name' => 'require',
            'width' => 'require|integer',
            'height' => 'require|integer',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'swiper_name.require' => '幻灯片名称为空',

            'width.require' => '宽度为空',
            'width.integer' => '宽度必须是数字',

            'height.require' => '高度为空',
            'height.integer' => '高度必须是数字',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}