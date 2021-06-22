<?php

namespace app\common\enum;

/**
 * 积分类型 - 枚举
 * Class PointTypeEnum
 * @package app\common\enum
 */
class PointTypeEnum extends BaseEnum
{
    const admin = ['enum_number' => 1, 'enum_name' => '系统赠送', 'enum_type' => 'admin'];
    const register = ['enum_number' => 2, 'enum_name' => '注册', 'enum_type' => 'register'];
    const subscribe_wechat = ['enum_number' => 3, 'enum_name' => '关注', 'enum_type' => 'subscribe_wechat'];

    const first_sign = ['enum_number' => 4, 'enum_name' => '首次签到', 'enum_type' => 'first_sign'];
    const day_sign = ['enum_number' => 5, 'enum_name' => '每日签到', 'enum_type' => 'day_sign'];
    const week_sign = ['enum_number' => 6, 'enum_name' => '连续7天签到', 'enum_type' => 'week_sign'];
    const month_sign = ['enum_number' => 7, 'enum_name' => '连续30天签到', 'enum_type' => 'month_sign'];

    const first_order = ['enum_number' => 8, 'enum_name' => '首次下单', 'enum_type' => 'first_order'];
    const order_award = ['enum_number' => 9, 'enum_name' => '订单奖励', 'enum_type' => 'order_award'];
    const order_use = ['enum_number' => 10, 'enum_name' => '订单使用', 'enum_type' => 'order_use'];

    const active_transfer = ['enum_number' => 11, 'enum_name' => '主转积分', 'enum_type' => 'active_transfer'];
    const passive_transfer = ['enum_number' => 12, 'enum_name' => '被转积分', 'enum_type' => 'passive_transfer'];
}