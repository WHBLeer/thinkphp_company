<?php
namespace app\index\controller;

class Creation extends Common
{
    public function index()
    {
    	
        $creation = db('about')->find(7);
    	db('about')->where('id', 7)->setInc('browse');
    	$this->assign('creation',$creation);
        return view();
    }
}