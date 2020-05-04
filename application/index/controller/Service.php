<?php
namespace app\index\controller;
use app\index\model\Service as ServiceModel;

class Service extends Common
{
    public function index()
    {
        $services=db('service')->where('type=2')->order('create_time desc')->paginate(12);
        $this->assign('services',$services);
        return view();
    }

    public function detail()
    {
    	$id=input('id');
        $service=db('service')->find($id);
        $this->assign('service',$service);
        return $this->fetch();
    }
}