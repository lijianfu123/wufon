<?php

namespace app\common\enum;

/**
 * 财务类型 - 枚举
 * Class MoneyTypeEnum
 * @package app\common\enum
 */
class MoneyTypeEnum extends BaseEnum
{
    const recharge = ['enum_number' => 1, 'enum_name' => '充值', 'enum_type' => 'recharge'];
    const withdraw = ['enum_number' => 2, 'enum_name' => '提现', 'enum_type' => 'withdraw'];

    const order_award = ['enum_number' => 3, 'enum_name' => '订单奖励', 'enum_type' => 'order_award'];

    const first_commend_award = ['enum_number' => 4, 'enum_name' => '直推', 'enum_type' => 'first_commend_award'];
    const second_commend_award = ['enum_number' => 5, 'enum_name' => '间推', 'enum_type' => 'second_commend_award'];
    const third_commend_award = ['enum_number' => 6, 'enum_name' => '转推', 'enum_type' => 'third_commend_award'];

    const team_award = ['enum_number' => 7, 'enum_name' => '团队奖', 'enum_type' => 'team_award'];
    const sell_award = ['enum_number' => 8, 'enum_name' => '业绩奖', 'enum_type' => 'sell_award'];
}