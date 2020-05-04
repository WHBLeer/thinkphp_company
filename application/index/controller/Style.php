<?php
namespace app\index\controller;
use app\admin\model\Style as StyleModel;
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
        db('about')->where('id', 6)->setInc('browse');
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

}
