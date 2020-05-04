<?php
namespace app\index\controller;
use app\index\model\Reservation as ReservationModel;
class Reservation extends Common
{
    public function index(){
        $reservation=new ReservationModel();
        $reservationres=$reservation->order('create_time desc')->paginate(12);
        $this->assign('reservationres',$reservationres);
        return view();
    }

    public function add(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Reservation');
            if(!$validate->scene('add')->check($data)) $this->error($validate->getError());
            // 添加到数据库
            $add=db('reservation')->insert($data);
            if($add){
                $this->success('添加成功！',url('index'));
            }else{
                $this->error('添加失败！');
            }
        }
        return view();
    }

}
