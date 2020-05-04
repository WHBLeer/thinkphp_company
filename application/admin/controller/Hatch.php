<?php
namespace app\admin\controller;
use app\admin\model\About as AboutModel;
use app\admin\controller\Common;
class Hatch extends Common
{
    
    /**
     * 关于我们
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-10-27
     * @return   [type]                [description]
     */
    public function index(){
        $hatch = db('about')->find(2);
        if ($hatch) {
            if(request()->isPost()){
                $data=input('post.');
                $hatch=new AboutModel;
                $save=$hatch->update($data);
                if($save){
                    $this->success('孵化器简介保存成功！',url('index'));
                }else{
                    $this->error('孵化器简介保存失败！');
                }
                return;
            }
        }else{
            $data=[
                'title'=>'孵化器简介' ,              
                'content'=>'孵化器简介。。。',
            ];   
            // 添加到数据库
            $hatch=new AboutModel;
            $save=$hatch->save($data);
            if($save){
                $id = db('about')->getLastInsID();
                $hatch = db('about')->find($id);
            }
        }
        
        $this->assign('hatch',$hatch);
        return view();
    }

}
