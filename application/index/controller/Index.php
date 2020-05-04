<?php
namespace app\index\controller;

class Index extends Common
{
    public function index()
    {
        // 办公空间  
        $office=new \app\admin\model\Office();
        $offices=$office->getAllConf(4);  
        $this->assign('offices',$offices); 

        // 我们的服务   
        $service=new \app\admin\model\Service();
        $services=$service->getAllConf(6);  
        $this->assign('services',$services); 

        // 新闻动态   
        $news=new \app\admin\model\News();
        // $newss=$news->getAllNews(4);  
        $newss=$news->getIndexNews();  
        $this->assign('newss',$newss);

        // 关于我们   
        $about=new \app\admin\model\About();
        $aboutin=$about->getData(1);  
        $this->assign('aboutin',$aboutin); 
        return view();
    }

    public function getConf(){
        $conf=new \app\admin\model\Conf();
        $_confres=$conf->getAllConf();
        // dump($_confres);
        $confres=array();
        foreach ($_confres as $k => $v) {
            $confres[$v['enname']]=$v['value'];
        }
        // dump($confres);
        $this->assign('site_conf',$confres);
    }
}
