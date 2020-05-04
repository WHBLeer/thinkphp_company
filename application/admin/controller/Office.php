<?php
namespace app\admin\controller;
use app\admin\model\Office as OfficeModel;
use app\admin\controller\Common;
class Office extends Common
{
    /**
     * 办公环境列表
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-10-27
     * @return   [type]                [description]
     */
    public function index(){
        $office=new OfficeModel();
        if(request()->isPost()){
            $sorts=input('post.');
            foreach ($sorts as $k => $v) {
                $office->update(['id'=>$k,'sort'=>$v]);
            }
            $this->success('更新排序成功！',url('index'));
            return;
        }
        $officeres=$office->order('sort asc')->paginate(12);
        // dump(db('office')->fetchSql());exit;
        $this->assign('officeres',$officeres);
        return view();
    }

    /**
     * 添加员工风采
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-10-27
     */
    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Office');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            if($_FILES['album']['tmp_name']){
                $file = request()->file('album');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $data['album']=$info->getSaveName();
                }
            }
            
            $office=new OfficeModel;
            // $add=$office->save($data);
            $add=db('office')->insert($data);
            if($add){
                $this->success('添加办公环境成功！',url('index'));
            }else{
                $this->error('添加办公环境失败！');
            }
            return;
        }
        return view();
    }

    /**
     * 编辑员工风采
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-10-27
     * @return   [type]                [description]
     */
    public function edit(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Office');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }

            $office=new OfficeModel;
            $save=$office->update($data);
            if($save){
                $this->success('修改办公环境成功！',url('index'));
            }else{
                $this->error('修改办公环境失败！');
            }
            return;
        }
        $office=OfficeModel::find(input('id'));
        $this->assign('office',$office);
        return view();
    }

    public function del(){
        $del=OfficeModel::destroy(input('id'));
        if($del){
            $this->success('删除办公环境成功！',url('index'));
        }else{
            $this->error('删除办公环境失败！');
        }
    }


}
