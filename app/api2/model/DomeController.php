<?php


namespace app\api2\model;


class DomeController extends CommonController
{
    public function initialize()
    {
        parent::initialize();
        $this->pk = 'dome_id';
        $this->name = 'dome';
        $this->table = config('database.prefix') . $this->name;
    }

}