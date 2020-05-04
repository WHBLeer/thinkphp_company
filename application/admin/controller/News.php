<?php
namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
use app\admin\model\News as NewsModel;
use app\admin\controller\Common;
class News extends Common
{

    public function index(){
        $newsres=db('news')->field('a.*,b.catename')->alias('a')->join('hatch_cate b','a.cateid=b.id')->where('a.delete_time','NULL')->order('a.id desc')->paginate(12);
        $this->assign('newsres',$newsres);
        return view();
    }

    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('News');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            if($_FILES['thumb']['tmp_name']){
                $file = request()->file('thumb');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    $data['thumb']=$info->getSaveName();
                }
            }
            
            $news=new NewsModel;
            $add=db('news')->insert($data);
            if($add){
                $this->success('添加新闻成功',url('index'));
            }else{
                $this->error('添加新闻失败！');
            }
            return;
        }
        $cate=new CateModel();
        $cateres=$cate->catetree();
        $this->assign('cateres',$cateres);
        return view();
    }

    public function edit(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('News');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }

            $news=new NewsModel;
            $save=$news->update($data);
            if($save){
                $this->success('修改新闻成功！',url('index'));
            }else{
                $this->error('修改新闻失败！');
            }
            return;
        }
        $cate=new CateModel();
        $cateres=$cate->catetree();
        $news=db('news')->where(array('id'=>input('id')))->find();
        $this->assign(array(
            'cateres'=>$cateres,
            'news'=>$news,
            ));
        return view();
    }

    public function del(){
        $del=NewsModel::destroy(input('id'));
        if($del){
            $this->success('删除新闻成功！',url('index'));
        }else{
            $this->error('删除新闻失败！');
        }
    }


 



   

	












}
