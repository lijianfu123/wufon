<?php

namespace app\api\controller;

use think\Request;
use app\common\model\ProductModel;

/**
 * 行情
 * Class HangQingController
 * @package app\api\controller
 */
class HangQingController extends BaseController
{
    private $url = 'http://ldhqsj.com/';
    private $username = '246';
    private $password = '25d55ad283aa400af464c76d713c07ad';

    /**
     * 构造方法
     * HangQingController constructor.
     * @param Request $request
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        //写入缓存_start
        /*
        $product_array = [];
        $ProductModel = new ProductModel();
        $product_list = $ProductModel->field('product_name, product_code')->select();
        foreach ($product_list as $key => $product) {
            $product_array[$product['product_code']] = $product['product_name'];
        }

        cache('product_array', $product_array);
        */
        //写入缓存_end
    }

    /**
     * 获取 指数
     * H00001 => 上证指数
     * 399001 => 深证成指
     * 399300 => 沪深300
     * 399005 => 中小板指
     * @return array
     */
    public function get_zhi_shu()
    {
        $array = [];
        $zhi_shu_name = '';
        $url = $this->url . 'stock_curr.action?username=' . $this->username . '&password=' . $this->password . '&id=H00001,399001,399300,399005';
        $http_request = get_http_request($url);

        $array_1 = explode("\r\n", $http_request);
        if (count($array_1) == 2) {
            return $this->get_api_result(0);
        } else {
            foreach ($array_1 as $key => $value) {
                $array_2 = explode(',', $value);

                if ($key > 0) {
                    switch ($array_2[0]) {
                        case 'H00001':
                            $zhi_shu_name = '上证指数';

                            break;
                        case '399001':
                            $zhi_shu_name = '深证成指';

                            break;
                        case '399300':
                            $zhi_shu_name = '沪深300';

                            break;
                        case '399005':
                            $zhi_shu_name = '中小板指';

                            break;
                    }

                    $array[] = [
                        'zhi_shu_code' => $array_2[0],
                        'zhi_shu_name' => $zhi_shu_name,
                        'number' => $array_2[1],
                    ];
                }
            }

//            return $this->get_api_result($array);
            return $this->get_api_result([]);
        }
    }

    /**
     * 获取 股票 排行 分页
     * zf => 涨幅
     * zs => 涨速
     * jg => 价格
     * lb => 量比
     * @param $type
     * @return array
     */
    private function get_pai_hang_page($type)
    {
        $array = [];
        $product_cache = cache('product_array'); //股票缓存

        $url = $this->url . 'stock_rank.action?username=' . $this->username . '&password=' . $this->password . '&type=' . $type;
        $http_request = get_http_request($url);

        $array_1 = explode("\r\n", $http_request);
        if (count($array_1) > 3) {
            $list = [];

            for ($i = 1; $i <= 20; $i++) {
                $array_2 = explode(',', $array_1[$i]);
                if (isset($product_cache[$array_2[0]])) {
                    $list[] = [
                        'product_name' => $product_cache[$array_2[0]],
                        'product_code' => $array_2[0],
                        'price' => $array_2[1],
                        'ratio' => $array_2[2]
                    ];
                }
            }

            $array = [
                'page' => 1,
                'last_page' => 1,
                'total' => 1,
                'page_size' => 20,
                'list' => $list
            ];
        }

        return $array;
    }

    /**
     * 涨幅
     * zf => 涨幅
     */
    public function get_zhang_fu()
    {
        $result = $this->get_pai_hang_page('zf');

        return $this->get_api_result($result);
    }

    /**
     * 涨速
     * zs => 涨速
     */
    public function get_zhang_su()
    {
        $result = $this->get_pai_hang_page('zs');

        return $this->get_api_result($result);
    }

    /**
     * 价格
     * jg => 价格
     */
    public function get_jia_ge()
    {
        $result = $this->get_pai_hang_page('jg');

        return $this->get_api_result($result);
    }

    /**
     * 量比
     * lb => 量比
     */
    public function get_liang_bi()
    {
        $result = $this->get_pai_hang_page('lb');

        return $this->get_api_result($result);
    }

    /**
     * 个股指标
     */
    public function get_ge_gu_zhi_biao()
    {
        $product_code = input('product_code');

        $url = $this->url . 'stock_fs.action?username=' . $this->username . '&password=' . $this->password . '&zb=jbe,mbss,lb,nwb,wbuy&id=' . $product_code;
        $http_request = get_http_request($url);

        $array_1 = explode("\r\n", $http_request);
        if (count($array_1) == 2) {
            return $this->get_api_result(0);
        } else {
            $array_2 = explode(',', $array_1[1]);
            $array_3 = explode(',', $array_1[count($array_1) - 1]);

            //p($array_1[0]);
            //p($array_1[1]);
            //p($array_1[2]);
            //p($array_1[3]);
            //价格,成交量,成交额,委买,均笔额,每笔手数,量比,内外比

            $result = [
                'zuo_shou_jia' => $array_2[1], //昨日价
                'dang_qian_jia' => $array_3[0], //当钱价
                'cheng_jiao_liang' => $array_3[1], //成交量
                'cheng_jiao_e' => $array_3[2], //成交额
                'wei_mai' => $array_3[3], //委买
                'jun_bi_e' => $array_3[4], //均笔额
                'mei_bi_shou_shu' => $array_3[5], //每笔手数
                'liang_bi' => $array_3[6], //量比
                'nei_wai_bi' => $array_3[7] //内外比
            ];

            return $this->get_api_result($result);
        }
    }

    /**
     * 分时
     */
    public function get_fen_shi()
    {
        $product_code = input('product_code');
        $url = $this->url . 'stock_fs.action?username=' . $this->username . '&password=' . $this->password . '&id=' . $product_code . '&zb=jbe';
        $http_request = get_http_request($url);

        $array_1 = explode("\r\n", $http_request);
        if (count($array_1) == 2) {
            return $this->get_api_result(0);
        } else {
            $categories = [];
            $array_jia_ge = []; //价格
            $array_cheng_jiao_liang = []; //成交量
            $array_cheng_jiao_e = []; //成交额
            $array_jun_bi_e = []; //均笔额

            for ($i = 3; $i <= (count($array_1) - 1); $i++) {
                $array_2 = explode(",", $array_1[$i]);

                $minute = substr($array_2[0], -1);
                if ($minute == '0') {
                    $categories[] = $array_2[0];
                    $array_jia_ge[] = $array_2[1];
                    $array_cheng_jiao_liang[] = $array_2[2];
                    $array_cheng_jiao_e[] = $array_2[3];
                    $array_jun_bi_e[] = $array_2[4];
                }
            }

            $result = [
                'categories' => $categories,
                'series' => [
                    [
                        'name' => '价格',
                        'data' => $array_jia_ge
                    ], [
                        'name' => '成交量',
                        'data' => $array_cheng_jiao_liang
                    ], [
                        'name' => '成交额',
                        'data' => $array_cheng_jiao_e
                    ], [
                        'name' => '均笔额',
                        'data' => $array_jun_bi_e
                    ]
                ]
            ];

            return $this->get_api_result($result);
        }
    }

    /**
     * K
     * @param $type
     * @return array
     */
    private function get_k($type)
    {
        $product_code = input('product_code');
        $url = $this->url . 'stock_k.action?username=' . $this->username . '&password=' . $this->password . '&id=' . $product_code . '&num=-200&period=' . $type;
        $http_request = get_http_request($url);

        $array_1 = explode("\r\n", $http_request);
        if (count($array_1) == 2) {
            return $this->get_api_result(0);
        } else {
            $categories = [];
            $data = [];

            for ($i = 3; $i <= (count($array_1) - 1); $i++) {
                $array_2 = explode(",", $array_1[$i]);

                $minute = substr($array_2[0], -1);
                if ($minute == '0') {
                    //日期,开盘价,最高价,最低价,收盘价,成交量,成交额
                    $categories[] = $array_2[0];
                    $data[] = [$array_2[1], $array_2[4], $array_2[3], $array_2[2]];
                }
            }

            $name = '';
            switch ($type) {
                case 'd':
                    $name = '日';
                    break;
                case 'w':
                    $name = '周';
                    break;
                case 'm':
                    $name = '月';
                    break;
            }

            $result = [
                'categories' => $categories,
                'name' => $name . 'K',
                'data' => $data
            ];

            return $result;
        }
    }

    /**
     * 日 K
     */
    public function get_ri_k()
    {
        $result = $this->get_k('d');

        return $this->get_api_result($result);
    }

    /**
     * 周 K
     */
    public function get_zhou_k()
    {
        $result = $this->get_k('w');

        return $this->get_api_result($result);
    }

    /**
     * 月 K
     */
    public function get_yue_k()
    {
        $result = $this->get_k('m');

        return $this->get_api_result($result);
    }
}