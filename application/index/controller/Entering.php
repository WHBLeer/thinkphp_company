<?php
namespace app\index\controller;

class Entering extends Common
{
    public function index()
    {
        $enteringres=db('entering')->where('delete_time','NULL')->order('create_time desc')->paginate(12);
        $this->assign('enteringres',$enteringres);
        return $this->fetch();
    }

    /**
     * @Author   wanghongbin
     * @Email    wanghongbin@ngoos.org
     * @DateTime 2018-08-08
     * @return   [type]                [description]
     */
    public function detail()
    {
        $id=input('id');
        $entering=db('entering')->find($id);
        $this->assign('entering',$entering);
        return $this->fetch();
    }
}
