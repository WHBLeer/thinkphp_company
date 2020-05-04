<?php
namespace app\index\controller;
use app\admin\model\Guide as GuideModel;
use think\Request;
class Guide extends Common
{
    public function index()
    {
        $items1 = db('dictitem')->where('type=1')->select();
        $items2 = db('dictitem')->where('type=2')->select();
        $this->assign('items1',$items1);
        $this->assign('items2',$items2);
        return view();
    }

    public function add()
    {
    	if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Guide');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            
            $guide=new GuideModel;
            $add=db('guide')->insert($data);
            if($add){
                $this->success('信息提交成功！',url('succ'));
            }else{
                $this->error('信息提交失败！');
            }
            return;
        }
    	
    }

    public function edit()
    {
    	# code...
    }

    public function succ()
    {
    	return view('success');
    }
}
