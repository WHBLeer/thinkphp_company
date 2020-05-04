<?php
namespace app\index\controller;

class Regulation extends Common
{
    public function index()
    {
        $type=input('type');

        $regulationres=db('regulation')->where('delete_time','NULL')->where('type',$type)->order('create_time desc')->paginate(12);
        // dump($regulations);exit;
        $this->assign('regulationres',$regulationres);
        $this->assign('type',$type);
        return $this->fetch();
    }

    /**
     * 博客详情
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-08-08
     * @return   [type]                [description]
     */
    public function detail()
    {
        $id=input('id');
        db('regulation')->where('id', $id)->setInc('click');
        $regulation=db('regulation')->find($id);
        $this->assign('regulation',$regulation);
        return $this->fetch();
    }
}