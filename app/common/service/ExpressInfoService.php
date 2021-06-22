<?php

namespace app\common\service;

/**
 * 快递信息 - Service
 * Class ExpressInfoService
 * @package app\common\service
 */
class ExpressInfoService
{
    private $express_app_id, $express_password;

    /**
     * 构造方法
     * ExpressInfoService constructor.
     */
    public function __construct()
    {
        $this->express_app_id = '';
        $this->express_password = '';
    }

    /**
     *
     */
    public function index($express_code, $express_order_code)
    {

    }

    /**
     * 获取 快递100 运单信息
     * @param $express_code
     * @param $express_order_code
     * @return mixed
     */
    private function get_kuaidi100($express_code, $express_order_code)
    {
        $arr = [
            'customer' => $this->express_password,
            'param' => json([
                'com' => $express_code,
                'num' => $express_order_code
            ])
        ];

        $arr['sign'] = strtoupper(md5($arr['param'] . $this->express_app_id . $arr['customer']));

        $str = '';
        foreach ($arr as $key => $value) {
            $str .= $key . '=' . urlencode($value) . '&';
        }

        $data = substr($str, 0, -1);
        $url = 'http://poll.kuaidi100.com/poll/query.do';

        $result = post_curl($url, $data);
        $result = str_replace('\"', '"', $result);
        $result = json_decode($result, true);

        return $result;
    }

    /**
     * 获取 快递鸟 运单信息
     * @param $express_code
     * @param $express_order_code
     * @return mixed
     */
    private function get_kdniao($express_code, $express_order_code)
    {
        $get_encrypt = function ($data) {
            return urlencode(base64_encode(md5($data . $this->express_password)));
        };

        $data = json([
            'ShipperCode' => $express_code,
            'LogisticCode' => $express_order_code
        ]);

        $post = array(
            'DataType' => '2',
            'RequestType' => '1002',
            'EBusinessID' => $this->express_app_id,
            'RequestData' => urlencode($data),
        );

        $post['DataSign'] = $get_encrypt($data);
        $url = 'http://api.kdniao.com/Ebusiness/EbusinessOrderHandle.aspx';

        $result = post_curl($url, $post);

        return $result;
    }
}