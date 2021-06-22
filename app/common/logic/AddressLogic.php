<?php

namespace app\common\logic;

/**
 * 地址 - 逻辑
 * Class AddressLogic
 * @package app\common\logic
 */
class AddressLogic extends BaseLogic
{
    /**
     * 构造方法
     * AddressLogic constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->validate_rule = [
            'linkman' => 'require',
            'tel' => 'require',
            'address' => 'require',
        ];

        $this->validate_message = [
            'linkman.require' => '联系人为空',
            'tel.require' => '联系电话为空',
            'address.require' => '地址为空'
        ];
    }
}