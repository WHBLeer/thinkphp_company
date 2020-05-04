<?php
namespace app\index\controller;

class Incubator extends Common
{
    public function index()
    {
    	
        $incubator = db('about')->find(2);
        db('about')->where('id', 2)->setInc('browse');
		$this->assign('incubator',$incubator);
        return view();
    }
}