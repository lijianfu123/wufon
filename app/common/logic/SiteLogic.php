<?php

namespace app\common\logic;

/**
 * 站点 - 逻辑
 * Class SiteLogic
 * @package app\common\logic
 */
class SiteLogic extends BaseLogic
{
    /**
     * 构造方法
     * SiteLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'domain' => 'require',
            'site_name' => 'require'
        ];

        $this->validate_message = [
            'domain.require' => '域名为空',
            'site_name.require' => '站点名称为空'
        ];
    }
}