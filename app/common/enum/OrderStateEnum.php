<?php

namespace app\common\enum;

/**
 * 订单状态 - 枚举
 * Class OrderStateEnum
 * @package app\common\enum
 */
class OrderStateEnum extends BaseEnum
{
    const create_order = ['enum_number' => 1, 'enum_name' => '待付款', 'enum_type' => 'create_order', 'alias' => '已下单', 'color' => '#E6A23C'];
    const close_order = ['enum_number' => 2, 'enum_name' => '已关闭', 'enum_type' => 'close_order', 'alias' => '', 'color' => '#909399'];

    const pay_confirm = ['enum_number' => 3, 'enum_name' => '付款待确认', 'enum_type' => 'pay_confirm', 'alias' => '已付款', 'color' => '#409EFF'];
    const pay_receive = ['enum_number' => 4, 'enum_name' => '付款已确认', 'enum_type' => 'pay_receive', 'alias' => '', 'color' => '#409EFF'];

    const warehouse_readying = ['enum_number' => 5, 'enum_name' => '仓库待发货', 'enum_type' => 'warehouse_readying', 'alias' => '仓库备货中', 'color' => '#009688'];
    const warehouse_readyed = ['enum_number' => 6, 'enum_name' => '仓库备货完成', 'enum_type' => 'warehouse_readyed', 'alias' => '仓库已备货', 'color' => '#009688'];

    //express_ 7 快递已收货
    //express_ 8 快递发货完成

    const receive_order = ['enum_number' => 9, 'enum_name' => '已签收', 'enum_type' => 'receive_order', 'alias' => '', 'color' => '#67C23A'];

    //10 申请安装
    //11 安装中
    //12 安装完成
    //13 安装完成确认

    const none_comment = ['enum_number' => 14, 'enum_name' => '待评论', 'enum_type' => 'none_comment', 'alias' => '', 'color' => '#67C23A'];
    const write_comment = ['enum_number' => 15, 'enum_name' => '已评论', 'enum_type' => 'write_comment', 'alias' => '', 'color' => '#67C23A'];

    const refund_apply = ['enum_number' => 16, 'enum_name' => '申请退款', 'enum_type' => 'refund_apply', 'alias' => '退款申请', 'color' => '#F56C6C'];
    //17 退款 货物 发货
    //18 退款 货物 已收货
    const refund_pass = ['enum_number' => 19, 'enum_name' => '已退款', 'enum_type' => 'refund_pass', 'alias' => '', 'color' => '#F56C6C'];

    const finish_order = ['enum_number' => 20, 'enum_name' => '完成', 'enum_type' => 'finish_order', 'alias' => '', 'color' => '#67C23A'];
}