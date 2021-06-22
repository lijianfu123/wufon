<?php

namespace app\api\controller;

use think\facade\Filesystem;
use think\exception\ValidateException;

/**
 * api > 文件
 * Class UploadController
 * @package app\api\controller
 */
class FileController extends BaseController
{
    /**
     * 上传
     * @return array
     */
    public function upload()
    {
        $result = [];
        $files = request()->file();

        try {
            validate(['image' => 'fileSize:10240|fileExt:jpg|image:200,200,jpg'])->check($files);

            foreach ($files as $file) {
                $file_path = Filesystem::putFile('', $file);
                $file_path = '/' . UPLOAD_FOLDER . '/' . $file_path;
                $file_path = str_replace('\\', '/', $file_path);

                $result[] = $file_path;
            }
        } catch (ValidateException $e) {
            $result[] = $e->getMessage();
        }

        $result = $this->get_api_result($result);

        return $result;
    }
}