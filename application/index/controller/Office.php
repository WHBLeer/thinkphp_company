<?php
namespace app\index\controller;
use app\admin\model\Office as OfficeModel;
class Office extends Common
{
    /**
     * 风采列表
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

}
