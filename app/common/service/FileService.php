<?php

namespace app\common\service;

use think\Image;

/**
 * 文件 - Service
 * Class ImageService
 * @package app\common\service
 */
class FileService extends BaseService
{
    private $font_path = 'static/font/fang_zheng_hei_ti_jian_ti.ttf';

    /**
     * 构造方法
     * FileService constructor.
     */
    public function __construct()
    {

        //require(ROOT_PATH . '/vendor/image/src/Image.php');
    }

    public function open($path)
    {
        $image = Image::open(ROOT_PATH . $path);

        return $image;
    }

    /**
     * 获取 授权书
     * @param $info
     * @return string
     */
    public function get_authorize($info)
    {
        $authorize_path = $this->upload . 'authorize/' . $info['id'] . '.png';
        if (!file_exists($authorize_path)) {
            $create_time = strtotime($info['create_time']);

            //获取 场景二维码
            $wechat_ticket_path = $this->upload . 'wechat_ticket/' . $info['id'] . '.png';
            if (!file($wechat_ticket_path)) {
                $WechatService = new WechatService();
                $WechatService->get_user_ticket($info['id']);
            }

            $thumb_qrcode_path = $this->upload . 'thumb_qrcode_' . $info['id'] . '.png';

            $thumb_qrcode = $this->open(substr($wechat_ticket_path, 1));
            $thumb_qrcode->thumb(200, 200)->save($thumb_qrcode_path);

            $bg_authorize = $this->open('/static/image/authorize.jpg');
            $bg_authorize
                ->water($thumb_qrcode_path, [130, 900])
                ->text($info['wechat_nickname'], $this->font_path, 20, '#000000', [220, 570])
                ->text($info['id'], $this->font_path, 20, '#000000', [380, 790])
                ->text(date('Y', $create_time), $this->font_path, 20, '#000000', [310, 830])
                ->text(date('m', $create_time), $this->font_path, 20, '#000000', [410, 830])
                ->text(date('d', $create_time), $this->font_path, 20, '#000000', [470, 830])
                ->save($authorize_path);

            delete_file($thumb_qrcode_path);
        }

        return substr($authorize_path, 1);
    }

    /**
     * 获取 场景二维码
     * @param $info
     * @return bool|int
     */
    public function get_ticket_qrcoce($info)
    {
        //二维码
        $qrcode_path = $this->upload . 'qrcode/' . $info['id'] . '.png';
        if (!file_exists($qrcode_path)) {
            //获取 微信头像
            $wechat_face_path = $this->upload . 'wechat_face/' . $info['id'] . '.png';
            if (!file_exists($wechat_face_path)) {
                $image = get_http_request_file($info['wechat_face']);

                $local_file = fopen($wechat_face_path, 'w');
                if ($local_file != false) {
                    if (fwrite($local_file, $image['body']) !== false) {
                        fclose($local_file);
                    }
                }
            }

            //获取 场景二维码
            $wechat_ticket_path = $this->upload . 'wechat_ticket/' . $info['id'] . '.png';
            if (!file($wechat_ticket_path)) {
                $WechatService = new WechatService();
                $WechatService->get_user_ticket($info['id']);
            }

            //头像 缩略图
            $thumb_face_path = $this->upload . 'thumb_face_' . $info['id'] . '.png';

            $thumb_face = $this->open(substr($wechat_face_path, 1));
            $thumb_face->thumb(100, 100)->save($thumb_face_path);

            //二维码 缩略图
            $thumb_qrcode_path = $this->upload . 'thumb_qrcode_' . $info['id'] . '.png';

            $thumb_qrcode = $this->open(substr($wechat_ticket_path, 1));
            $thumb_qrcode->thumb(200, 200)->save($thumb_qrcode_path);

            $bg_qrcode = $this->open('/static/image/qrcode.jpg');
            $bg_qrcode
                ->text($info['wechat_nickname'], $this->font_path, 20, '#ffffff', [150, 60])
                ->water($thumb_face_path, [150, 100])
                ->water($thumb_qrcode_path, [80, 880])
                ->save($qrcode_path);

            delete_file($thumb_face_path);
            delete_file($thumb_qrcode_path);
        }

        return substr($qrcode_path, 1);
    }
}