<?php
namespace app\admin\controller;
use app\admin\model\About as AboutModel;
class About extends Common
{
    
    /**
     * 关于我们
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-10-27
     * @return   [type]                [description]
     */
    public function index(){
        $about = db('about')->find(1);
        if ($about) {
            if(request()->isPost()){
                $data=input('post.');
                $about=new AboutModel;
                $save=$about->update($data);
                if($save){
                    $this->success('关于我们保存成功！',url('index'));
                }else{
                    $this->error('关于我们保存失败！');
                }
                return;
            }
        }else{
            $data=[
                'title'=>'关于我们' ,              
                'content'=>'关于我们。。。',
            ];   
            // 添加到数据库
            $about=new AboutModel;
            $save=$about->save($data);
            if($save){
                $id = db('about')->getLastInsID();
                $about = db('about')->find($id);
            }
        }
        
        $this->assign('about',$about);
        return view();
    }

}
