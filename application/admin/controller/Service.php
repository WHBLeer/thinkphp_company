<?php
namespace app\admin\controller;
use app\admin\model\About as ServiceTxtModel;
use app\admin\model\Service as ServiceModel;
use think\Request;
class Service extends Common
{
    /**
     * 我们的服务
     * @return [type] [description]
     */
    public function index()
    {
        $service = new ServiceModel();
        $services = $service->where('type=1')->order('create_time desc')->paginate(15);
        $this->assign('services',$services);
        return view();
    }

    /**
     * 服务项目
     * @return [type] [description]
     */
    public function project(){
        $service = new ServiceModel();
        $services = $service->where('type=2')->order('create_time desc')->paginate(15);
        $this->assign('services',$services);
        return view();
    }

    public function add(){
        $type=input('type');
        $this->assign('type',$type);
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Service');
            if(!$validate->scene('add')->check($data)) $this->error($validate->getError());

            $add=db('service')->insert($data);
            if($add){
                $this->success('添加服务项目成功！',url('project'));
            }else{
                $this->error('添加服务项目失败！');
            }
        }
        return view();
    }

    public function edit(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Service');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }

            $service=new ServiceModel;
            $save=$service->update($data);
            if($save){
                $this->success('修改服务项目成功！',url('project'));
            }else{
                $this->error('修改服务项目失败！');
            }
            return;
        }

        $service=ServiceModel::find(input('id'));
        $this->assign('service',$service);
        return view();
    }

    public function del(){
        $id=input('id');
        if($id){
            if(db('service')->delete(input('id'))){
                $this->success('删除服务项目成功！','project');
            }else{
                $this->error('删除服务项目失败！');
            }
        }
    }
}
