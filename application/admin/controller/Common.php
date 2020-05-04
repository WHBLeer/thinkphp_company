<?php
namespace app\admin\controller;
use app\admin\model\Conf as ConfModel;
use think\Controller;
use think\Request;
class Common extends Controller
{
    public function _initialize(){
        if(!session('id') || !session('name')){
            $this->redirect('login/index');
           // $this->error('您尚未登录系统',url('login/index')); 
        }

        $confres=ConfModel::order('sort asc')->select();
        $CONFIG = array();
        foreach ($confres as $key => $conf) {
            $CONFIG[$conf['enname']] = $conf['value'];
        }
        $this->assign('CONFIG',$CONFIG);
    }


}
