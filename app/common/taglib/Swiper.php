<?php

namespace app\common\taglib;

/**
 * 幻灯片 - 自定义标签
 * Class SwiperTaglib
 * @package app\common\taglib
 */
class Swiper extends Base
{
    public $model_name = 'Swiper';

    protected $tags = [
        'image_list' => ['attr' => '', 'close' => 1]
    ];

    /**
     * 图组 标签
     * @param $attr
     * @param $content
     * @return string
     */
    public function tagImage_list($attr, $content)
    {
        $id = empty($attr['id']) ? 0 : $attr['id'];

        $str = '<?php ';
        $str .= $this->get_model_string(); //获取 模型 字符串
        $str .= '$detail = $Model->get_pass_detail(' . $id . ');';
        $str .= '$__list__ = $detail["image_list_json"];';
        $str .= '?>';
        $str .= '{volist name="__list__" id="value"}';
        $str .= $content;
        $str .= '{/volist}';

        return $str;
    }
}