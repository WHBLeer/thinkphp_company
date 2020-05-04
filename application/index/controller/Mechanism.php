<?php
namespace app\index\controller;
use app\index\model\Mechanism as MechanismModel;

class Mechanism extends Common
{
    public function index()
    {
        $mechanism = db('about')->find(8);
        db('about')->where('id', 8)->setInc('browse');
        $this->assign('mechanism',$mechanism);
        return view();
    }

    public function detail()
    {
        $mechanismid=input('mechanismid');

        $mechanism=db('mechanism')->where('id',$mechanismid)->find();
        $this->assign('mechanism',$mechanism);
        return view();
    }
}