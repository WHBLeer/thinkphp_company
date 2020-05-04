<?php
namespace app\admin\controller;
use app\admin\model\Conf as ConfModel;
class Conf extends Common
{

    public function index(){
        if(request()->isPost()){
            $sorts=input('post.');
            $conf=new ConfModel();
            foreach ($sorts as $k => $v) {
                $conf->update(['id'=>$k,'sort'=>$v]);
            }
            $this->success('更新排序成功！',url('index'));
            return;
        }
        $confres=ConfModel::order('sort asc')->paginate(15);
        $this->assign('confres',$confres);
        return view();
    }

    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Conf');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            if($data['values']){
                $data['values']=str_replace('，', ',', $data['values']);
            }
            $conf=new ConfModel();
            $add=db('conf')->insert($data);
            if($add!==false){
                $this->success('添加配置成功！',url('index'));
            }else{
                $this->error('添加配置失败！');
            }
        }
        return view();
    }

    public function edit(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Conf');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            if($data['values']){
                $data['values']=str_replace('，', ',', $data['values']);
            }
            $conf=new ConfModel();
            $save=$conf->update($data);
            // $save=$conf->save($data,['id'=>$data['id']]);
            if($save!==false){
                $this->success('修改配置成功！',url('index'));
            }else{
                $this->error('修改配置失败！');
            }
        }
        $confs=ConfModel::find(input('id'));
        $this->assign('confs',$confs);
        return view();
    }

    public function del(){
        $del=ConfModel::destroy(input('id'));
        if($del){
           $this->success('删除配置项成功！',url('index')); 
        }else{
            $this->error('删除配置项失败！');
        }
    }

    public function conf(){
        if(request()->isPost()){
            $data=input('post.');
            /*$formarr=array();
            foreach ($data as $k => $v) {
                $formarr[]=$k;
            }
            $_confarr=db('conf')->field('enname')->select();
            $confarr=array();
            foreach ($_confarr as $k => $v) {
                $confarr[]=$v['enname'];
            }
            $checkboxarr=array();
            foreach ($confarr as $k => $v) {
                if(!in_array($v, $formarr)){
                    $checkboxarr[]=$v;
                }
            }
            if($checkboxarr){
                foreach ($checkboxarr as $ke => $v) {
                    ConfModel::where('enname',$v)->update(['value'=>'']);
                }
            }*/
            if($data){
                foreach ($data as $k=>$v) {
                    ConfModel::where('enname',$k)->update(['value'=>$v]);
                }

                $this->success('修改配置成功！');

            }
            return;
        }
        // $confres=ConfModel::order('sort asc')->select();
        $confres=db('conf')->select();
        $system = array();
        $files = array();
        $email = array();
        $index = array();
        foreach ($confres as $k => $v) {
            if ($v['sort']==1) $system[] = $v;
            if ($v['sort']==2) $files[] = $v;
            if ($v['sort']==3) $email[] = $v;
            if ($v['sort']==4) $index[] = $v;
        }
        $this->assign('system',$system);
        $this->assign('files',$files);
        $this->assign('email',$email);
        $this->assign('index',$index);
        if (input('filesuccess')) {
            $this->assign('filesuccess','文件上传成功，配置已更新');
        }else{
            $this->assign('filesuccess','');
        }
        return view();
    }

    public function upload()
    {
        $files1 =  request()->file('index_banner');
        $files2 =  request()->file('inner_banner');
        $files3 =  request()->file('favicon');
        $files4 =  request()->file('footericon');
        $files5 =  request()->file('footerewm');
        if (!empty($files1)) {
            $fileArr = [];
            foreach($files1 as $file){
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $fileArr[] = $info->getSaveName();
                }
            }
            $old = db('conf')->where('enname','index_banner')->find();
            ConfModel::where('enname','index_banner')->update(['value'=>implode(',', $fileArr).','.$old['value']]);
        }
        if ($files2){
            $info = $files2->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $old = db('conf')->where('enname','inner_banner')->find();
                if (is_file(ROOT_PATH . 'public' . DS . 'uploads'.DS.$old['value']))
                    unlink (ROOT_PATH . 'public' . DS . 'uploads'.DS.$old['value']);
                ConfModel::where('enname','inner_banner')->update(['value'=>$info->getSaveName()]);
            }
        }
        if ($files3){
            $info = $files3->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $old = db('conf')->where('enname','favicon')->find();
                if (is_file(ROOT_PATH . 'public' . DS . 'uploads'.DS.$old['value']))
                    unlink (ROOT_PATH . 'public' . DS . 'uploads'.DS.$old['value']);
                
                ConfModel::where('enname','favicon')->update(['value'=>$info->getSaveName()]);
            }
        }
        if ($files4){
            $info = $files4->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $old = db('conf')->where('enname','footericon')->find();
                if (is_file(ROOT_PATH . 'public' . DS . 'uploads'.DS.$old['value']))
                    unlink (ROOT_PATH . 'public' . DS . 'uploads'.DS.$old['value']);
                
                ConfModel::where('enname','footericon')->update(['value'=>$info->getSaveName()]);
            }
        }
        if ($files5){
            $info = $files5->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $old = db('conf')->where('enname','footerewm')->find();
                if (is_file(ROOT_PATH . 'public' . DS . 'uploads'.DS.$old['value']))
                    unlink (ROOT_PATH . 'public' . DS . 'uploads'.DS.$old['value']);
                
                ConfModel::where('enname','footerewm')->update(['value'=>$info->getSaveName()]);
            }
        }
        $this->redirect('conf/conf', ['filesuccess' => 1]);
    }


    /**
     * 发送测试邮件
     * @return [type] [description]
     */
    public function send()
    {
        $conf = input('post.');
        file_put_contents('conf.log', date('Y-m-d H:i:s') .'==='.json_encode($conf) . chr(10), FILE_APPEND | LOCK_EX);
        $send = send_test_email($conf);
        if ($send) {
            $this->success('测试邮件已发送！');
        }else{
            $this->error($send);  
        }
    }

}