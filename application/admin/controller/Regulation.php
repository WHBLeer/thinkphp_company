<?php
namespace app\admin\controller;
use app\admin\model\Regulation as RegulationModel;
class Regulation extends Common
{
    public function index(){
        $regulation=new RegulationModel();
        $regulations=$regulation->order('create_time desc')->paginate(12);
        $this->assign('regulations',$regulations);
        $items = db('dictitem')->select();
        $this->assign('items',$items);
        return view();
    }

    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Regulation');
            if(!$validate->scene('add')->check($data)) $this->error($validate->getError());
            // 添加到数据库
            $add=db('Regulation')->insert($data);
            if($add){
                $this->success('添加成功！',url('index'));
            }else{
                $this->error('添加失败！');
            }
        }
        return view();
    }

}
