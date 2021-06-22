<?php

namespace app\common\enum;

/**
 * 退换货状态 - 枚举
 * Class RefundStateEnum
 * @package app\common\enum
 */
class RefundStateEnum extends BaseEnum
{
    const refund_apply = ['enum_number' => 1, 'enum_name' => '申请退款', 'enum_type' => 'refund_apply', 'alias' => '退款申请', 'color' => '#F56C6C'];
    //2 拒绝
    //3 退款 货物 发货
    //4 退款 货物 已收货
    const refund_pass = ['enum_number' => 5, 'enum_name' => '已退款', 'enum_type' => 'refund_pass', 'alias' => '', 'color' => '#F56C6C'];
}