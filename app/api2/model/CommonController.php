<?php


namespace app\api2\model;


use think\Db;
use think\Model;
use think\Request;

class CommonController extends Model
{
    // 指定AND查询条件
    public $where = '';
    // 字段截取
    public $fields = '';
    // 排序
    public $orders = '';
    // 指定OR查询条件
    public $whereOr = '';
    // error
    public $error = '';

    /**
     * 获取单条数据
     * @param string $where
     * @param string $field
     * @param string $order
     * @param string $whereOr
     * @return array|false|mixed|\PDOStatement|string|Model
     */
    public function getFind($where = '', $field = '', $order = '', $whereOr = '')
    {
        $wheres = empty($where) ? $this->where : $where;
        $fields = empty($field) ? $this->fields : $field;
        $orders = empty($order) ? $this->orders : $order;
        $whereOrs = empty($whereOr) ? $this->whereOr : $whereOr;
        if (empty($wheres) && empty($whereOrs)) return [];
        // 排除查询
        $except = false;
        if (is_array($fields)){
            $except = end($fields);
            $fields = reset($fields);
        }
        // 主键查询
        if (is_numeric($wheres)){
            if (empty($wheres)) return [];
            $data = Db::table($this->table)->where($this->pk, $wheres)->whereOr($whereOrs)->field($fields, $except)->order($orders)->find();
        }else{
            $data = Db::table($this->table)->where($wheres)->whereOr($whereOrs)->field($fields, $except)->order($orders)->find();
        }
        if (empty($data)) return [];
        return $data;
    }

    /**
     * 获取单个字段数据
     * @param string $where
     * @param string $field
     * @param string $whereOr
     * @return mixed|string
     */
    public function getField($where = '', $field = '', $whereOr = '')
    {
        $wheres = empty($where) ? $this->where : $where;
        $fields = empty($field) ? $this->fields : $field;
        $whereOrs = empty($whereOr) ? $this->whereOr : $whereOr;
        if (empty($wheres) && empty($whereOrs)) return [];
        if (empty($fields)) return '';
        // 主键查询
        if (is_numeric($wheres)){
            if (empty($wheres)) return '';
            $value = Db::table($this->table)->where($this->pk, $wheres)->value($fields);
        }else{
            $value = Db::table($this->table)->where($wheres)->value($fields);
        }
        return $value;
    }

    /**
     * 更新和修改操作
     * @param array $data
     * @param bool $validate
     * @param bool $all
     * @param bool $getLastInsID
     * @return bool|string
     */
    public function operation($data = [] , $validate = true, $all = false, $getLastInsID = false)
    {
        if ($all){
            if (is_array($validate)){
                $rows = $this->validate($validate['rule'], $validate['message'])->saveAll($data);
            }else{
                $rows = $this->validate($validate)->saveAll($data);
            }
        }else{
            if (is_array($validate)){
                $rows = $this->validate($validate['rule'], $validate['message'])->save($data);
            }else{
                $rows = $this->validate($validate)->save($data);
            }
        }
        if (empty($rows)){
            return false;
        }
        if ($getLastInsID == true && $all == false){
            return $this->getLastInsID();
        }
        return true;
    }

    /**
     * 状态操作设置
     * @param string $where
     * @param string $field
     * @param int $value
     * @param int $default
     * @return bool
     */
    public function status($where = '', $field = 'status', $value = 0 , $default = 1)
    {
        $wheres = empty($where) ? $this->where : $where;
        $fields = empty($field) ? $this->fields : $field;
        if (empty($wheres)) return false;
        // 批量修改
        if (is_array($wheres)){
            foreach ($wheres as $key=>$val){
                $state = $this->getField($val, $field);
                $new_value = $state == $default ? $value : $default;
                if (is_numeric($val)){
                    if (empty($val)) return false;
                    $rows = Db::table($this->table)->where($this->pk, $val)->setField($field, $new_value);
                }else{
                    $rows = Db::table($this->table)->where($val)->setField($field, $new_value);
                }
                if (empty($rows)){
                    return false;
                }
            }
        }else{
            // 主键查询
            $state = $this->getField($wheres, $field);
            $new_value = $state == $default ? $value : $default;
            if (is_numeric($wheres)){
                if (empty($wheres)) return false;
                $rows = Db::table($this->table)->where($this->pk, $wheres)->setField($field, $new_value);
            }else{
                $rows = Db::table($this->table)->where($wheres)->setField($field, $new_value);
            }
        }
        if (empty($rows)){
            return false;
        }
        return true;
    }

    /**
     * 删除操作
     * @param string $where
     * @return bool
     */
    public function remove($where = '')
    {
        $wheres = empty($where) ? $this->where : $where;
        if (empty($wheres)) return false;
        // 批量删除
        if (is_array($wheres)){
            foreach ($wheres as $key=>$val){
                if (is_numeric($val)){
                    if (empty($val)) return false;
                    $rows = Db::table($this->table)->where($this->pk, $val)->delete();
                }else{
                    $rows = Db::table($this->table)->where($val)->delete();
                }
                if (empty($rows)){
                    return false;
                }
            }
        }else{
            // 主键查询
            if (is_numeric($wheres)){
                if (empty($wheres)) return false;
                $rows = Db::table($this->table)->where($this->pk, $wheres)->delete();
            }else{
                $rows = Db::table($this->table)->where($wheres)->delete();
            }
        }
        if (empty($rows)){
            return false;
        }
        return true;
    }

    /**
     * 检测是否存在
     * @param string $where
     * @return bool
     */
    public function exists($where = '')
    {
        $wheres = empty($where) ? $this->where : $where;
        // 主键查询
        if (is_numeric($wheres)){
            if (empty($wheres)) return false;
            $rows = Db::table($this->table)->where($this->pk, $wheres)->count();
        }else{
            $rows = Db::table($this->table)->where($wheres)->count();
        }
        if (empty($rows)){
            return false;
        }
        return true;
    }

    /**
     * 获取列表数据
     * @param string $where
     * @param string $limit
     * @param string $order
     * @param string $field
     * @param string $whereOr
     */
    public function getList($where = '', $limit = '', $order = '', $field = '', $whereOr = '')
    {
        $wheres = empty($where) ? $this->where : $where;
        $fields = empty($field) ? $this->fields : $field;
        $orders = empty($order) ? $this->orders : $order;
        $whereOrs = empty($whereOr) ? $this->whereOr : $whereOr;
        // 排除查询
        $except = false;
        if (is_array($fields)){
            $except = end($fields);
            $fields = reset($fields);
        }
        $list = Db::table($this->table)->where($wheres)->whereOr($whereOrs)->order($orders)->field($fields, $except)->limit($limit)->select();
        return $list;
    }

    /**
     * 获取列表分页数据
     * @param string $where
     * @param int $limit
     * @param string $order
     * @param string $field
     * @param string $whereOr
     * @return array
     */
    public function getLists($where = '', $limit = 1, $order = '', $field = '', $whereOr = '')
    {
        $wheres = empty($where) ? $this->where : $where;
        $fields = empty($field) ? $this->fields : $field;
        $orders = empty($order) ? $this->orders : $order;
        $whereOrs = empty($whereOr) ? $this->whereOr : $whereOr;
        $count = $this->where($wheres)->count();
        $Page = new \Page($count, $limit);
        $param = Request::instance()->param();
        if (!empty($param)){
            if (!empty($param['start_time'])){
                $param['start_time'] = str_replace('%2B', ' ', $param['start_time']);
            }
            if (!empty($param['end_time'])){
                $param['end_time'] = str_replace('%2B', ' ', $param['end_time']);
            }
            $Page->parameter = $param;
        }
        $show = $Page->show();
        // 排除查询
        $except = false;
        if (is_array($fields)){
            $except = end($fields);
            $fields = reset($fields);
        }
        $list = Db::table($this->table)->where($wheres)->whereOr($whereOrs)->order($orders)->field($fields, $except)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        return [
            'count'=>$count,
            'page'=>$show,
            'list'=>$list
        ];
    }

    // 启动事务
    public function DbStartTrans()
    {
        Db::startTrans();
    }

    // 提交事务
    public function DbCommit()
    {
        Db::commit();
    }

    // 数据回滚
    public function DbRollback()
    {
        Db::rollback();
    }

    public function getError()
    {
        return $this->error;
    }

}