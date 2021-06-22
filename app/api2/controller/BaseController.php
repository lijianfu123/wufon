<?php

namespace app\api2\controller;


use app\common\controller\CommonController;

class BaseController extends CommonController
{
    protected $require = [];
    protected $selectable = [];
    protected $data = [];
    protected $face_path = '';
    protected $qr_code_path = '';
    const http_url = 'https://gpcx.mchengbiz.com.cn/';

    public function _initialize()
    {
        parent::_initialize();
        $this->face_path = self::http_url . '/upload/face/';
        $this->qr_code_path = self::http_url . '/upload/qr_code/';
        /*// 加载当前控制器语言包
        $controller_name = strtolower(request()->controller());
        $this->loadLang($controller_name);*/
    }

    /**
     * 加载语言文件
     * @param string $name
     */
    protected function loadLang($name)
    {
        // Lang::load(APP_PATH . 'common/lang/' . request()->langset() . '.php');
        // Lang::load(APP_PATH . request()->module() . '/lang/' . request()->langset() . '/' . str_replace('.', '/', $name) . '.php');
    }

    /**
     * post 方式请求
     */
    protected function isPost()
    {
        if (!request()->isPost()) $this->jsonFail('Please request by post');
    }

    /**
     * get 方式请求
     */
    protected function isGet()
    {
        if (!request()->isGet()) $this->jsonFail('Please request by get');
    }

    /**
     * json 数据流处理
     * @param array $param
     * @param string $request post param
     */
    protected function jsonVerify($param = [], $request = 'post')
    {
        if ($request == 'post') {
            $this->isPost();
        } else {
            $this->isGet();
        }
        if (empty($param)) {
            if ($request == 'post') {
                $post_data = request()->post();
            } else {
                $post_data = request()->param();
            }
            if (is_string($this->require)) {
                $this->require = explode(',', $this->require);
            }
            if (is_string($this->selectable)) {
                $this->selectable = explode(',', $this->selectable);
            }
            if (empty($this->selectable)) {
                $param = $this->require;
            } else {
                $param = array_merge($this->require, $this->selectable);
            }
            $array_keys = array_keys($post_data);
            foreach ($array_keys as $key) {
                if (!in_array($key, $param)) {
                    unset($post_data[$key]);
                }
            }
            if (!empty($this->require)) {
                foreach ($this->require as $val) {
                    if (!isset($post_data[$val]) || $post_data[$val] === '') {
                        $this->jsonFail('Missing request parameter %s|' . $val);
                    }
                }
            }
        } else {
            if ($request == 'post') {
                $post_data = request()->post();
            } else {
                $post_data = request()->param();
            }
            if (is_string($param)) {
                $param = explode(',', $param);
            }
            $array_keys = array_keys($post_data);
            foreach ($array_keys as $key) {
                if (!in_array($key, $param)) {
                    unset($post_data[$key]);
                }
            }
            if (!empty($param)) {
                foreach ($param as $val) {
                    if (!isset($post_data[$val]) || $post_data[$val] === '') {
                        $this->jsonFail('Missing request parameter %s|' . $val);
                    }
                }
            }
        }
        $this->data = $post_data;

        $this->consoleLog($this->data);
    }

    public function verifyToken($require = true)
    {
        $token = request()->header('token');
        // $token = '3786117f26e6123a3e69a71237702ed9';
        if (empty($token)) {
            $this->jsonFail('Missing request parameter %s|' . 'token');
        }
        // $this->data['member_id'] = 1;
        $member_token = new MemberToken();
        $result = $member_token->tokenAuth($token);
        if (empty($result['member_id'])) {
            if ($require) {
                $this->jsonError('The user token is invalid');
            }
        } else {
            $member_model = new Member();
            if (!$member_model->exists(['member_id' => $result['member_id']])) {
                if ($require) {
                    $this->jsonError('Failed to get user information');
                }
            } else {
                $this->data['member_id'] = $result['member_id'];
            }
        }
    }

    /**
     * 附加参数
     * @param int $status
     * @param array $data
     * @param string $message
     */
    protected function jsonReturn($status = 0, $data = [], $message = '')
    {
        $jsonData = [
            'status' => $status,
            'data' => $data,
            'message' => L($message)
        ];
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode(array_merge($jsonData)));
    }

    /**
     * 请求验证失败
     * status 9999：请求验证失败
     * @param string $message
     * @param array $data
     */
    protected function jsonFail($message = '', $data = [])
    {
        return $this->jsonReturn(9999, (object)$data, $message);
    }

    /**
     * 操作数据成功
     * status 1000：操作数据成功；可能有数据返回对象形式
     * @param string $message
     * @param array $data
     */
    protected function jsonSuccess($message = '', $data = [])
    {
        return $this->jsonReturn(1000, (object)$data, $message);
    }

    /**
     * 操作数据失败
     * status 1001：操作数据失败
     * @param string $message
     * @param array $data
     */
    protected function jsonError($message = '', $data = [])
    {
        return $this->jsonReturn(1001, (object)$data, $message);
    }

    /**
     * 获取数据成功
     * status 1000：获取数据成功；肯定有数据返回对象数组形式
     * @param array $data
     * @param string $message
     */
    protected function jsonResult($data = [], $message = '')
    {
        return $this->jsonReturn(1000, $data, $message);
    }

    /**
     * 没有更多数据
     * status 1001：没有更多数据；空对象数组数据
     * @param array $data
     * @param string $message
     */
    protected function jsonEmpty($message = '', $data = [])
    {
        return $this->jsonReturn(1000, $data, $message);
    }

    /**
     * 数据日志保存
     * @param $data
     * @param $type
     * @param int $flags
     */
    protected function consoleLog($data, $type = '', $flags = FILE_APPEND)
    {
        $dir = getcwd() . '/api_log/';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $html = '';
        $filename = $dir . $type . date('YmdH') . '.html';
        if (!file_exists($filename)) {
            $html .= '<!DOCTYPE html><html><head>';
            $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
            $html .= '</head><body>';
        }
        $html .= '<div style="display: inline-block;margin-left: 35%">';
        $html .= '<h5 style="margin: 5px 0">---------------------------------------------------------------</h5>';
        $html .= '<h5 style="margin: 5px 0">执行日期：' . date('Y-m-d H:i:s', NEW_TIME) . '</h5>';
        $html .= '<h5 style="margin: 5px 0">请求地址：<textarea style="display: inline-block;width: 100%;border: none;font-size: 14px;font-weight: bold;font-family: bold;">' . self::http_url . request()->url() . '</textarea></h5>';
        $html .= '<h5 style="margin: 5px 0">数据信息：<textarea style="display: inline-block;width: 100%;border: none;font-size: 14px;font-weight: bold;font-family: bold;">' . json_encode($data) . '</textarea></h5>';
        $html .= '</div>';
        if (!file_exists($filename)) {
            $html .= '</body></html>';
        }
        file_put_contents($filename, $html, $flags);
    }

    /**
     * 图片上传
     * @param string $resource
     * @param string $save_path
     * @param string $file_type
     * @return string
     */
    protected function upload($resource = '', $save_path = 'face', $file_type = 'jpg')
    {
        if (empty($resource)) return '';
        // 保存路径
        $name = date('Y/m/d/', NEW_TIME);
        $path = '/static/upload/' . $save_path . '/';
        $dir = getcwd() . $path . $name . '/';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        // 文件名称
        $filename = uniqid() . '.' . $file_type;
        $file = $dir . $filename;
        $rows = file_put_contents($file, base64_decode($resource));
        // 判断图片是否上传成功
        if (is_null($rows)) {
            $this->jsonError('Picture upload failed');
        }
        return $name . $filename;
    }

}