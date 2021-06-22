<?php

namespace app\common\taglib;

use think\template\TagLib;
use app\common\enum\AppEnum;

class Base extends TagLib
{
    protected $class_array = [AppEnum::module['taglib']['news_class'], AppEnum::module['taglib']['product_class'], AppEnum::module['taglib']['download_class']];
    protected $tags = [
        'list' => ['attr' => '', 'close' => 1],
        'detail' => ['attr' => '', 'close' => 1]
    ];

    /**
     * 获取 模型 字符串
     * @return string
     */
    protected function get_model_string()
    {
        return '$Model = new app\common\model\\' . $this->model_name . 'Model();';
    }

    /**
     * 列表 标签
     * @param $attr
     * @param $content
     * @return string
     */
    public function tagList($attr, $content)
    {
        $get_class_id = function ($model) use ($attr) {
            $class_id = empty($attr[$model . '_class_id']) ? 0 : $attr[$model . '_class_id'];
            if ($class_id == 0) {
                $class_id = $this->tpl->get($model . '_class_id');
            }

            return $class_id;
        };

        $model_name = un_camelize($this->model_name); //驼峰命名转下划线命名
        $limit = empty($attr['limit']) ? 0 : $attr['limit'];

        $str = '<?php ';
        $str .= $this->get_model_string(); //获取 模型 字符串

        if (in_array($model_name, $this->class_array)) {
            $parent_id = empty($attr['parent_id']) ? 0 : $attr['parent_id'];

            $str .= '$__list__ = $Model->where("parent_id = ' . $parent_id . '")->select();';
        } else {
            $class_id = 0;
            switch ($model_name) {
                case AppEnum::module['taglib']['news']:
                    $class_id = $get_class_id(AppEnum::module['taglib']['news']);

                    break;
                case AppEnum::module['taglib']['product']:
                    $class_id = $get_class_id(AppEnum::module['taglib']['product']);

                    break;
                case AppEnum::module['taglib']['download']:
                    $class_id = $get_class_id(AppEnum::module['taglib']['download']);

                    break;
            }

            if ($class_id == 0) {
                $str .= '$__list__ = $Model->get_pass_list();';
            } else {
                $str .= '$__list__ = $Model->where("(first_' . $model_name . '_class_id = ' . $class_id . ') or (second_' . $model_name . '_class_id = ' . $class_id . ')")->order("sort asc, id desc")->select();';
            }
        }

        $str .= '?>';
        $str .= '{volist name="__list__" id="value"}';
        $str .= '{php}';

        if (in_array($model_name, $this->class_array)) {
            $str .= '$list_url = "' . str_replace('_class', '', $model_name) . '_list_url";';
            $str .= '$value[$list_url] = ' . str_replace('_class', '', $model_name) . '_list_url($value["id"]);';
        } else {
            $str .= '$detail_url = "' . $model_name . '_detail_url";';
            $str .= '$value[$detail_url] = ' . $model_name . '_detail_url($value["id"]);';
        }

        $str .= '{/php}';
        $str .= $content;
        $str .= '{/volist}';

        return $str;
    }

    /**
     * 详情 标签
     * @param $attr
     * @param $content
     * @return string
     */
    public function tagDetail($attr, $content)
    {
        $id = empty($attr['id']) ? 0 : $attr['id'];

        $str = '<?php ';
        $str .= $this->get_model_string(); //获取 模型 字符串
        $str .= '$value = $Model->get_pass_detail(' . $id . ');';

        $model_name = un_camelize($this->model_name); //驼峰命名转下划线命名
        if (in_array($model_name, $this->class_array)) {

        } else {
            $str .= '$value["' . $model_name . '_detail_url"] = ' . $model_name . '_detail_url($value["id"]);';
        }

        $str .= '?>';
        $str .= $content;

        return $str;
    }
}