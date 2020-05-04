<?php
namespace app\index\controller;
use think\Controller;
class Common extends Controller
{

    public function _initialize(){
        //网站配置项
        $this->getConf();
        // 政策法规
        $this->getNavRegulation();
        // 服务分类
        $this->getNavServices();
        // 新闻分类
        $this->getNavCates();
        //合作伙伴
        $this->getPartnar();
    }

    /**
     * 服务项目
     * @return [type] [description]
     */
    public function getNavRegulation(){
        $items=db('dictitem')->where('type=3')->select();
        $this->assign('items',$items);
    }

    /**
     * 服务项目
     * @return [type] [description]
     */
    public function getNavServices(){
        $services=db('service')->order('id asc')->select();
        $this->assign('services',$services);
    }

    /**
     * 新闻分类
     * @return [type] [description]
     */
    public function getNavCates(){
        $cateres=db('cate')->where(array('pid'=>0))->select();
        foreach ($cateres as $k => $v) {
            $children=db('cate')->where(array('pid'=>$v['id']))->select();
            if($children){
                $cateres[$k]['children']=$children;
            }else{
                $cateres[$k]['children']=0;
            }
        }
        $this->assign('cateres',$cateres);
    }

    /**
     * 系统配置
     * @return [type] [description]
     */
    public function getConf(){
        $conf=new \app\admin\model\Conf();
        $_confres=$conf->getAllConf();
        $confres=array();
        foreach ($_confres as $k => $v) {
            $confres[$v['enname']]=$v['value'];
        }
        $this->assign('site_conf',$confres);
    }

    /**
     * 合作伙伴
     * @return [type] [description]
     */
    public function getPartnar(){
        $partner=new \app\admin\model\Partner();
        $partners=$partner->getAllConf();
        $this->assign('partners',$partners);
    }


}
