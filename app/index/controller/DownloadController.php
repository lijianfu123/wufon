<?php

namespace app\index\controller;

use app\common\model\DownloadModel;

/**
 * 前台 > 下载
 * Class DownloadController
 * @package app\index\controller
 */
class DownloadController extends BaseController
{
    /**
     * 下载文件
     */
    public function download($id)
    {
        $DownloadModel = new DownloadModel();
        $detail = $DownloadModel->get_pass_detail($id);

        $DownloadModel->where('id', $id)->inc('download_count')->update();

        header('Location:' . $detail['file_url']);
    }
}