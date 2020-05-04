<?php
namespace app\admin\controller;
use app\admin\model\Style as StyleModel;
use app\admin\model\About as StyleTxtModel;
use app\admin\controller\Common;
class Style extends Common
{
    /**
     * 风采列表
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-10-27
     * @return   [type]                [description]
     */
    public function index(){
        $style = db('about')->find(6);
        if ($style) {
            if(request()->isPost()){
                $data=input('post.');
                $style=new StyleTxtModel;
                $save=$style->update($data);
                if($save){
                    $this->success('员工风采保存成功！',url('index'));
                }else{
                    $this->error('员工风采保存失败！');
                }
                return;
            }
        }else{
            $data=[
                'title'=>'员工风采' ,              
                'content'=>'员工风采。。。',
            ];   
            // 添加到数据库
            $style=new StyleTxtModel;
            $save=$style->save($data);
            if($save){
                $id = db('about')->getLastInsID();
                $style = db('about')->find($id);
            }
        }
        
        $this->assign('style',$style);
        return view();
    }

    /**
     * 风采列表
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-10-27
     * @return   [type]                [description]
     */
    public function index2(){
        $style=new StyleModel();
        if(request()->isPost()){
            $sorts=input('post.');
            foreach ($sorts as $k => $v) {
                $style->update(['id'=>$k,'sort'=>$v]);
            }
            $this->success('更新排序成功！',url('index'));
            return;
        }
        $styleres=$style->order('sort asc')->paginate(12);
        // dump(db('style')->fetchSql());exit;
        $this->assign('styleres',$styleres);
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
            $validate = \think\Loader::validate('Style');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            if($_FILES['photo']['tmp_name']){
                $file = request()->file('photo');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $data['photo']=$info->getSaveName();
                }
            }
            
            $style=new StyleModel;
            // $add=$style->save($data);
            $add=db('style')->insert($data);
            if($add){
                $this->success('添加员工风采成功',url('index'));
            }else{
                $this->error('添加员工风采失败！');
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
            $validate = \think\Loader::validate('Style');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }

            $style=new StyleModel;
            $save=$style->update($data);
            if($save){
                $this->success('修改员工风采成功！',url('index'));
            }else{
                $this->error('修改员工风采失败！');
            }
            return;
        }
        $style=StyleModel::find(input('id'));
        $this->assign('style',$style);
        return view();
    }

    public function del(){
        $del=StyleModel::destroy(input('id'));
        if($del){
            $this->success('删除员工风采成功！',url('index'));
        }else{
            $this->error('删除员工风采失败！');
        }
    }


 



   

	












}
