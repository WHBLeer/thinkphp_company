<?php
namespace app\admin\controller;
use app\admin\model\Admin as AdminModel;
use app\admin\controller\Common;
class Admin extends Common
{
    public function info(){
        $admins =new AdminModel();
        $admin = $admins->info();
        if(request()->isPost()){
            $data=input('post.');
            $save=$admins->update($data);
            if($save !== false){
                $this->success('信息修改成功！',url('info'));
            }else{
                $this->error('信息修改失败！');
            }
            return;
        }
        $this->assign('admin',$admin);
        return view();
    }

    public function avatar()
    {
        if(request()->isPost()){
            $data=input('post.');
            $admins =new AdminModel();
            $admin = $admins->info();
            if($admin){
                $file = request()->file('avatar');
                if($file){
                    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                    if($info){
                        $avatar=$info->getSaveName();
                        $data['avatar']=$avatar;
                    }
                    $save=$admins->update($data);
                    if($save !== false){
                        session('avatar', $data['avatar']);
                        $this->success('头像修改成功！',url('info'),['avatar'=>$data['avatar']]);
                    }else{
                        $this->error('头像修改失败！');
                    }
                }
            }else{
                $this->error('该用户不存在！');
            }
        }
    }

    public function pwd()
    {
        if(request()->isPost()){
            $data=input('post.');
            $admins =new AdminModel();
            $admin = $admins->info();
            if($admin){
                if($admin['password']===md5($data['oldpwd'])){
                    $data['password'] = md5($data['password']);
                    unset($data['oldpwd']);
                    unset($data['confirm_password']);
                    $save=$admins->update($data);
                    if($save !== false){
                        $this->success('密码修改成功！',url('info'));
                    }else{
                        $this->error('密码修改成功！');
                    }
                }else{
                    $this->error('原始密码错误！');
                }
            }else{
                $this->error('该用户不存在！');
            }
        }
    }

    /**
     * 清除缓存
     */
    public function clear() {
        if (delete_dir_file(CACHE_PATH) || delete_dir_file(TEMP_PATH)) {
            $this->success('清除缓存成功!');
        } else {
            $this->error('清除缓存失败!');
        }
    }

    public function logout(){
        session(null); 
        $this->redirect('login/index');
        // $this->success('退出系统成功！',url('login/index'));
    }

	/*public function add()
    {
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Admin');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $admin=new AdminModel();
            if($admin->addadmin($data)){
                $this->success('添加管理员成功！',url('lst'));
            }else{
                $this->error('添加管理员失败！');
            }
            return;
        }
        $authGroupRes=db('auth_group')->select();
        $this->assign('authGroupRes',$authGroupRes);
        return view();
	}

	public function edit($id)
    {
        $admins=db('admin')->find($id);

        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Admin');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $admin=new AdminModel();
            $savenum=$admin->saveadmin($data,$admins);
            if($savenum == '2'){
                $this->error('管理员用户名不得为空！');
            }
            if($savenum !== false){
                $this->success('修改成功！',url('lst'));
            }else{
                $this->error('修改失败！');
            }
            return;
        }
        
        if(!$admins){
            $this->error('该管理员不存在');
        }
        $authGroupAccess=db('auth_group_access')->where(array('uid'=>$id))->find();
        $authGroupRes=db('auth_group')->select();
        $this->assign('authGroupRes',$authGroupRes);
        $this->assign('admin',$admins);
        $this->assign('groupId',$authGroupAccess['group_id']);
        return view();
	}

    public function del($id){
        $admin=new AdminModel();
        $delnum=$admin->deladmin($id);
        if($delnum == '1'){
            $this->success('删除管理员成功！',url('lst'));
        }else{
            $this->error('删除管理员失败！');
        }
    }*/

}
