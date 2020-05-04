<?php
namespace app\index\controller;

class Aboutus extends Common
{
    public function index()
    {
    	$aboutus = db('about')->find(1);
    	db('about')->where('id', 1)->setInc('browse');
    	$this->assign('aboutus',$aboutus);
        return view();
    }
}
