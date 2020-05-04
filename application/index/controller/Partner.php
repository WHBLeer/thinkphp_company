<?php
namespace app\index\controller;

class Partner extends Common
{
    public function index()
    {
    	// 合作伙伴   
        $partner=new \app\admin\model\Partner();
        $partners=$partner->getAllConf();  
        $this->assign('partners',$partners);
        return view();
    }
}