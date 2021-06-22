<?php

namespace app\api\controller;

use app\common\logic\OrderLogic;
use app\common\controller\CommonController;

/**
 * api > 支付通知
 * Class PayNotifyController
 * @package app\api\controller
 */
class PayNotifyController extends CommonController
{
    private $config;
    private $id, $app_name;
    private $order_code = '', $pay_code = '';

    /**
     * 构造方法
     */
    public function __construct()
    {
        $xml = file_get_contents("php://input");
        if ($xml == '') {
            die ('微支付数据 获取失败');
        }

        $simple_xml = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (($simple_xml->appid == $this->config['wechat_app_id']) && ($simple_xml->mch_id == $this->config['wechat_pay_id'])) {
            $this->order_code = $simple_xml->out_trade_no;
            $this->pay_code = $simple_xml->transaction_id;
        } else {
            die('支付通知数据 与 配置参数不符');
        }
    }

    /**
     * 首页
     * @return \think\response\View|void
     */
    public function index()
    {

    }

    /**
     * 更新 订单
     * @return mixed
     */
    private function save_pay_order()
    {
        $result = (new OrderLogic())->save_pay_order($this->id, $this->pay_code);

        return $result;
    }

    /**
     * 更新 充值
     * @return mixed
     */
    private function save_pay_recharge()
    {
        $result = (new RechargeLogic())->save_pay_recharge($this->id, $this->pay_code);

        return $result;
    }
}