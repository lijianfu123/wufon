<?php

namespace app\common\model;

use app\common\enum\AppEnum;

/**
 * 提现 - 模型
 * Class WithdrawModel
 * @package app\common\model
 */
class WithdrawModel extends BaseModel
{
    protected $name = 'withdraw';

    /**
     * 整理 站点 任意 分页 条件
     * @param array $post
     * @return string
     */
    public function parse_site_any_page_where(array $post)
    {
        $where = "(id > 0)";
        $where = $this->parse_base_page_where(AppEnum::site['enum_type'], $where);

        return $where;
    }
}