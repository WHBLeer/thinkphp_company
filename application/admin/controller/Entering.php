<?php
namespace app\admin\controller;
use app\admin\model\Entering as EnteringModel;
class Entering extends Common
{
    
    /**
     * 政策法规
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-10-27
     * @return   [type]                [description]
     */
    public function index(){
        $entering=new EnteringModel();
        $enterings=$entering->order('create_time desc')->paginate(12);
        $this->assign('enterings',$enterings);
        return view();
    }

    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Entering');
            if(!$validate->scene('add')->check($data)) $this->error($validate->getError());
            // 添加到数据库
            $add=db('entering')->insert($data);
            if($add){
                $this->success('添加成功！',url('index'));
            }else{
                $this->error('添加失败！');
            }
        }
        return view();
    }

    public function edit(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Entering');
            if(!$validate->scene('edit')->check($data)) $this->error($validate->getError());

            $entering=new EnteringModel();
            $save=$entering->save($data,['id'=>$data['id']]);
            if($save !== false){
                $this->success('修改入孵指南成功！',url('index'));
            }else{
                $this->error('修改入孵指南失败！');
            }
            return;
        }
        $entering=EnteringModel::find(input('id'));
        $this->assign('entering',$entering);
        return view();
    }

    public function del(){
        $del=EnteringModel::destroy(input('id'));
        if($del){
           $this->success('删除入孵指南成功！',url('index')); 
        }else{
            $this->error('删除入孵指南失败！');
        }
    }
}
