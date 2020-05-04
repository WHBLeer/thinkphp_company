<?php
namespace app\admin\controller;
use app\admin\model\About as CreationModel;
class Creation extends Common
{
    
    /**
     * 创事记
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-10-27
     * @return   [type]                [description]
     */
    public function index(){
        $creation = db('about')->find(7);
        if ($creation) {
            if(request()->isPost()){
                $data=input('post.');
                $creation=new CreationModel;
                $save=$creation->update($data);
                if($save){
                    $this->success('创事记保存成功！',url('index'));
                }else{
                    $this->error('创事记保存失败！');
                }
                return;
            }
        }else{
            $data=[
                'title'=>'创事记' ,              
                'content'=>'创事记。。。',
            ];   
            // 添加到数据库
            $creation=new CreationModel;
            $save=$creation->save($data);
            if($save){
                $id = db('about')->getLastInsID();
                $creation = db('about')->find($id);
            }
        }
        
        $this->assign('creation',$creation);
        return view();
    }

}
