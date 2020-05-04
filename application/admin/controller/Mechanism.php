<?php
namespace app\admin\controller;
use app\admin\model\About as MechanismModel;

class Mechanism extends Common
{
    public function index()
    {
        $mechanism = db('about')->find(8);
        if ($mechanism) {
            if(request()->isPost()){
                $data=input('post.');
                $mechanism=new MechanismModel;
                $save=$mechanism->update($data);
                if($save){
                    $this->success('服务机构保存成功！',url('index'));
                }else{
                    $this->error('服务机构保存失败！');
                }
                return;
            }
        }else{
            $data=[
                'title'=>'服务机构' ,              
                'content'=>'服务机构。。。',
            ];   
            // 添加到数据库
            $mechanism=new MechanismModel;
            $save=$mechanism->save($data);
            if($save){
                $id = db('about')->getLastInsID();
                $mechanism = db('about')->find($id);
            }
        }
        $this->assign('mechanism',$mechanism);
        return view();
    }

}