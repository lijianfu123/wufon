<?php
/**
 * 文本 长度
 * @param $str
 * @param $length
 * @return string|string[]
 */
function text_length($str, $length)
{
    $str = strip_tags($str);
    $str = str_replace('&nbsp;', '', $str);
    //$str = mb_substr($str, 0, $length);
    $str = sub_string($str, 0, $length);

    return $str;
}

/**
 * 截取字符串(含中文)
 * @param $str
 * @param $start
 * @param $length
 * @return string
 */
function sub_string($str, $start = 0, $length)
{
    $len = strlen($str);
    $r = array();
    $n = 0;
    $m = 0;

    for ($i = 0; $i < $len; $i++) {
        $x = substr($str, $i, 1);
        $a = base_convert(ord($x), 10, 2);
        $a = substr('00000000' . $a, -8);

        if ($n < $start) {
            if (substr($a, 0, 1) == 0) {
            } elseif (substr($a, 0, 3) == 110) {
                $i += 1;
            } elseif (substr($a, 0, 4) == 1110) {
                $i += 2;
            }

            $n++;
        } else {
            if (substr($a, 0, 1) == 0) {
                $r[] = substr($str, $i, 1);
            } elseif (substr($a, 0, 3) == 110) {
                $r[] = substr($str, $i, 2);
                $i += 1;
            } elseif (substr($a, 0, 4) == 1110) {
                $r[] = substr($str, $i, 3);
                $i += 2;
            } else {
                $r[] = '';
            }

            if (++$m >= $length) {
                break;
            }
        }
    }

    return join($r);
}

/**
 * 字符串长度(含中文)
 * @param $str
 * @return int
 */
function string_length($str)
{
    $len = strlen($str);
    $n = 0;

    for ($i = 0; $i < $len; $i++) {
        $x = substr($str, $i, 1);
        $a = base_convert(ord($x), 10, 2);
        $a = substr('00000000' . $a, -8);

        if (substr($a, 0, 1) == 0) {

        } elseif (substr($a, 0, 3) == 110) {
            $i += 1;
        } elseif (substr($a, 0, 4) == 1110) {
            $i += 2;
        }

        $n++;
    }

    return $n;
}

/**
 * 打印
 * @param $param
 * @param bool $is_die
 */
function p($param, $is_die = false)
{
    echo("<pre>\r");
    echo(print_r($param, true));
    echo("</pre>\r");

    if ($is_die) {
        die();
    }
}

/**
 * 查看日志
 * @param $param
 * @param int $is_php
 */
function logs($param, $is_php = 1)
{
    $str = '';

    if ($is_php == 1) {
        $str .= "<?php\r\n";
        $str .= "echo '<pre>';\r\n";

        if (is_array($param)) {
            $json = json($param);

            $str .= "echo print_r(json_decode('" . $json . "', true), true);\r\n";
        } else {
            if ($param == '') {
                $param = "''";
            }

            $str .= "echo print_r(" . $param . ", true);\r\n";
        }

        $str .= "echo '</pre>';";
    } else {
        $str = $param;
    }

    write_file('./log.php', $str);
}

/**
 * 是否 微信浏览
 */
function is_wechat()
{
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
        return true;
    } else {
        return false;
    }
}

/**
 * 加密
 * @param string $str
 * @return mixed
 */
function encode($str)
{
    $host = request()->host();
    $arr = str_split(base64_encode($str));
    $count = count($arr);

    foreach (str_split($host) as $key => $value) {
        $key < $count && $arr[$key] .= $value;
    }

    return str_replace(['=', '+', '/'], ['O0O0O', 'o000o', 'oo00o'], join('', $arr));
}

/**
 * 解密
 * @param $str
 * @return bool|string
 */
function decode($str)
{
    if ($str == '') {
        return '';
    }

    $host = request()->host();
    $arr = str_split(str_replace(['O0O0O', 'o000o', 'oo00o'], ['=', '+', '/'], $str), 2);
    $count = count($arr);

    foreach (str_split($host) as $key => $value) {
        $key <= $count && isset($arr[$key]) && $arr[$key][1] === $value && $arr[$key] = $arr[$key][0];
    }

    return base64_decode(join('', $arr));
}

/**
 * 下划线转驼峰
 * 思路:
 * step1.原字符串转小写,原字符串中的分隔符用空格替换,在字符串开头加上分隔符
 * step2.将字符串中每个单词的首字母转换为大写,再去空格,去字符串首部附加的分隔符.
 * @param $un_camelized_words
 * @param string $separator
 * @return string
 */
function camelize($un_camelized_words, $separator = '_')
{
    $un_camelized_words = $separator . str_replace($separator, " ", strtolower($un_camelized_words));

    return ltrim(str_replace(" ", "", ucwords($un_camelized_words)), $separator);
}

/**
 * 驼峰命名转下划线命名
 * 思路:
 * 小写和大写紧挨一起的地方,加上分隔符,然后全部转小写
 * @param $camelCaps
 * @param string $separator
 * @return string
 */
function un_camelize($camelCaps, $separator = '_')
{
    return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
}

/**
 * 多维数组查找
 * @param $array
 * @param $key
 * @param $value
 * @return false|int|string
 */
function multi_array_search($array, $key, $value)
{
    return array_search($value, array_column($array, $key));
}

/**
 * 多维数组排序
 * @param $arrays
 * @param $sort_key
 * @param int $sort_order
 * @param int $sort_type
 * @return array|bool
 */
function multi_array_sort($arrays, $sort_key, $sort_order = SORT_ASC, $sort_type = SORT_NUMERIC)
{
    if (is_array($arrays)) {
        foreach ($arrays as $array) {
            if (is_array($array)) {
                $key_arrays[] = $array[$sort_key];
            } else {
                return false;
            }
        }
    } else {
        return false;
    }

    array_multisort($key_arrays, $sort_order, $sort_type, $arrays);

    return $arrays;
}

/**
 * 返回 递归数组
 * @param $data
 * @param int $parent_id
 * @return array
 */
function get_recursion_list($data, $parent_id = 0)
{
    $arr = [];

    foreach ($data as $key => $value) {
        if ($value['parent_id'] == $parent_id) {
            $value['children'] = get_recursion_list($data, $value['id']);

            $arr[] = $value;
            //unset($data[$key]);
        }
    }

    return $arr;
}

/**
 * 随机数
 * @param int $length
 * @return string
 */
function get_rand_code($length = 6)
{
    $chars = '0123456789';
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[mt_rand(0, strlen($chars) - 1)];
    }

    return $password;
}

/**
 * 时间数
 * @return mixed
 */
function get_time_random_name()
{
    $str = date('Y-m-d H:i:s', time() + (HOUR_SECONDS * 8));
    $str = str_replace(' ', '', $str);
    $str = str_replace(':', '', $str);
    $str = str_replace('-', '', $str);

    return $str;
}

/**
 * 订单号
 * @return string
 */
function get_order_code()
{
    return get_time_random_name() . get_rand_code();
}

/**
 * 读取文件
 * @param $file_path
 * @return bool|string
 */
function read_file($file_path)
{
    $fp = fopen($file_path, 'rb');
    $str = fread($fp, filesize($file_path));

    fclose($fp);

    return $str;
}

/**
 * 写入文件
 * @param $file_path
 * @param $file_str
 * @return bool|int
 */
function write_file($file_path, $file_str)
{
    $file = fopen($file_path, 'w');
    $result = fwrite($file, $file_str);

    fclose($file);

    return $result;
}

/**
 * 删除文件
 * @param $file_path
 */
function delete_file($file_path)
{
    if (file_exists($file_path)) {
        unlink($file_path);
    }
}

/**
 * 创建文件夹
 * @param $folder
 */
function create_folder($folder)
{
    if (!is_dir($folder)) {
        mkdir($folder);
    }
}

/**
 * 删除文件夹
 * @param $folder
 * @return bool
 */
function delete_folder($folder)
{
    //先删除目录下的文件：
    $dh = opendir($folder);

    while ($file = readdir($dh)) {
        if ($file != '.' && $file != '..') {
            $fullpath = $folder . '/' . $file;

            if (!is_dir($fullpath)) {
                unlink($fullpath);
            } else {
                delete_folder($fullpath);
            }
        }
    }

    closedir($dh);

    //删除当前文件夹：
    if (rmdir($folder)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 对象 转 数组
 * @param $array
 * @return array
 */
function object_to_array($array)
{
    if (is_object($array)) {
        $array = (array)$array;
    }

    if (is_array($array)) {
        foreach ($array as $key => $value) {
            $array[$key] = object_to_array($value);
        }
    }

    return $array;
}

/**
 * array 转 xml
 * @param $arr
 * @return string
 */
function array_to_xml($arr)
{
    $xml = '<xml>';

    foreach ($arr as $k => $v) {
        $xml .= '	<' . $k . '><![CDATA[' . $v . ']]></' . $k . '>';
    }

    $xml .= '</xml>';

    return $xml;
}

/**
 * xml 转 数组
 * @param $xml
 * @return mixed
 */
function xml_to_array($xml)
{
    $arr = json_decode(json(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

    return $arr;
}

/**
 * 获取远程数据
 * @param $url
 * @param null $data
 * @return mixed
 */
function post_http_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($curl);

    curl_close($curl);

    return $output;
}

/**
 * 提交 xml 数据
 * @param $url
 * @param $xml
 * @param int $second
 * @return bool|mixed
 */
function post_xml_http_request($url, $xml, $second = 30)
{
    $ch = curl_init();        //初始化curl
    curl_setopt($ch, CURLOPT_TIMEOUT, $second); //设置超时

    //这里设置代理，如果有的话
    //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
    //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE); //设置header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_POST, TRUE); //post提交方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);

    $data = curl_exec($ch); //运行curl、返回结果
    if ($data) {
        curl_close($ch);

        return $data;
    } else {
        $error = curl_errno($ch);

        echo "curl出错，错误码:$error" . "<br>";
        echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";

        curl_close($ch);

        return false;
    }
}

/**
 * 获取远程 源码
 * @param $url
 * @param null $data
 * @return bool|string
 */
function get_http_request_code($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($curl);

    curl_close($curl);

    return $output;
}

/**
 * 获取远程文件
 * @param $url
 * @return array
 */
function get_http_request_file($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_NOBODY, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $package = curl_exec($ch);
    $http_info = curl_getinfo($ch);

    curl_close($ch);

    $image = array_merge([
        'header' => $http_info
    ], [
        'body' => $package
    ]);

    return $image;
}