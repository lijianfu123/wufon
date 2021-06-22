<?php

namespace app\common\logic;

/**
 * 单页面 - 逻辑
 * Class IntroLogic
 * @package app\common\logic
 */
class IntroLogic extends BaseLogic
{
    /**
     * 构造方法
     * IntroLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'intro_name' => 'require',
            'detail_view_path' => 'require',
            'sort' => 'require|integer|gt:0'
        ];

        $this->validate_message = [
            'intro_name.require' => '单页面名称为空',
            'detail_view_path.require' => '模板为空',

            'sort.require' => '排序为空',
            'sort.integer' => '排序必须是数字',
            'sort.gt' => '排序最小为 1'
        ];
    }
}