<?php
namespace app\admin\controller;
use app\admin\model\Partner as PartnerModel;
use app\admin\controller\Common;
class Partner extends Common
{
    public function index()
    {
        $partner=new PartnerModel();
        if(request()->isPost()){
            $sorts=input('post.');
            foreach ($sorts as $k => $v) {
                $partner->update(['id'=>$k,'sort'=>$v]);
            }
            $this->success('更新排序成功！',url('index'));
            return;
        }
        $partnerres=$partner->order('sort asc')->paginate(12);
        // dump(db('Partner')->fetchSql());exit;
        $this->assign('partnerres',$partnerres);
        return view();
	}

    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Partner');
            if(!$validate->scene('add')->check($data)) $this->error($validate->getError());

            $file = request()->file('pic');  
            if(empty($file)) $this->error('请选择上传文件');  
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'); 
            $data['pic'] = $info->getSaveName();
            $add=db('partner')->insert($data);
            if($add){
                $this->success('添加合作伙伴成功！',url('index'));
            }else{
                $this->error('添加合作伙伴失败！');
            }
        }
        return view();
    }

    public function edit(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Partner');
            if(!$validate->scene('edit')->check($data)) $this->error($validate->getError());

            $file = request()->file('pic'); 
            if(!empty($file)) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'); 
                $data['pic'] = $info->getSaveName();
            }else{
                $data['pic'] = $data['oldpic'];
            }
                unset($data['oldpic']);
            $partner=new PartnerModel();
            $save=$partner->save($data,['id'=>$data['id']]);
            if($save !== false){
                $this->success('修改合作伙伴成功！',url('index'));
            }else{
                $this->error('修改合作伙伴失败！');
            }
            return;
        }
        $partner=PartnerModel::find(input('id'));
        $this->assign('partner',$partner);
        return view();
    }

    public function del(){
        $del=PartnerModel::destroy(input('id'));
        if($del){
           $this->success('删除合作伙伴成功！',url('index')); 
        }else{
            $this->error('删除合作伙伴失败！');
        }
    }

    




   

	












}
