<?php

namespace app\common\service;

/**
 * 支付宝 - Service
 * Class AlipayService
 * @package app\common\service
 */
class AlipayService extends BaseService
{
    private $alipay_app_id, $alipay_private_key;
    private $alipay_api_url = 'https://openapi.alipay.com/gateway.do';

    /**
     * 构造方法
     * AlipayService constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->alipay_app_id = $config['alipay_app_id'];
        $this->alipay_private_key = $config['alipay_private_key'];
    }

    /**
     * 生成支付订单
     * @param $app_enum_type
     * @param $data
     * @return array
     */
    private function get_pay_unified_order($app_enum_type, $data)
    {
        $data['paid_money'] = 0.01;

        if ($this->request->isMobile()) {
            $method = 'alipay.trade.wap.pay';
        } else {
            $method = 'alipay.trade.page.pay';
        }

        $arr = [
            'app_id' => $this->alipay_app_id,
            'method' => $method,
            'format' => 'JSON',
            'charset' => 'utf-8',
            'sign_type' => 'RSA2',
            'version' => '1.0',
            'timestamp' => date('Y-m-d H:i:s'),
            'return_url' => pay_success_url($data['id']),
            'notify_url' => $this->get_pay_notify_url($app_enum_type, $data['id']),
            'biz_content' => json([
                'subject' => $data['order_code'],
                'out_trade_no' => $data['order_code'],
                'total_amount' => $data['paid_money'],
                'product_code' => 'FAST_INSTANT_TRADE_PAY',
            ])
        ];

        $arr['sign'] = $this->get_sign($arr);

        return $arr;
    }

    /**
     * 获取签名
     * @param $arr
     * @return string
     */
    private function get_sign($arr)
    {
        $sign = '';
        $param = '';

        ksort($arr);

        foreach ($arr as $key => $value) {
            if (!empty($param)) {
                $param .= '&';
            }

            $param .= $key . '=' . $value;
        }

        $private_key = "-----BEGIN RSA PRIVATE KEY-----\n" . wordwrap($this->alipay_private_key, 64, "\n", true) . "\n-----END RSA PRIVATE KEY-----"; //私钥
        openssl_sign($param, $sign, $private_key, OPENSSL_ALGO_SHA256); //sign 赋值
        $result = base64_encode($sign); //sign 编码

        return $result;
    }

    /**
     * 获取 支付订单
     * @param $app_enum_type
     * @param $data
     */
    public function get_pay_order($app_enum_type, $data)
    {
        //if (微信) {
            //get_pay_order_url()
        //} else {
            //get_pay_order_html()
        //}
    }

    /**
     * 获取 支付订单 url
     * @param $app_enum_type
     * @param $data
     * @return string
     */
    private function get_pay_order_url($app_enum_type, $data)
    {
        $arr = $this->get_pay_unified_order($app_enum_type, $data);
        $url = $this->alipay_api_url . '?' . http_build_query($arr);

        return $url;
    }

    /**
     * 获取 支付订单 html
     * @param $app_enum_type
     * @param $data
     * @return string
     */
    private function get_pay_order_html($app_enum_type, $data)
    {
        $arr = $this->get_pay_unified_order($app_enum_type, $data);

        $html = "<form id='alipaysubmit' name='alipaysubmit' action='" . $this->alipay_api_url . "' method='POST'>" . PHP_EOL;
        foreach ($arr as $key => $value) {
            $html .= "    <input type='hidden' name='" . $key . "' value='" . $value . "'/>" . PHP_EOL;
        }

        $html .= "    <input type='submit' style='display:none;'>" . PHP_EOL;

        $html .= "</form>";

        return $html;
    }
}