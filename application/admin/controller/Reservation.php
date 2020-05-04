<?php
namespace app\admin\controller;
use app\admin\model\Reservation as ReservationModel;
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

    public function del(){
        $del=ReservationModel::destroy(input('id'));
        if($del){
            $this->success('删除成功！',url('index'));
        }else{
            $this->error('删除失败！');
        }
    }

    /**
     * tp5 使用excel导出
     * @param
     * @author staitc7  * @return mixed
     */
    public function excel() {
        $name = '预约企业列表';
        $header=['企业名称','负责人', '电话','预约服务','需求','预约时间'];
        $datas=db('reservation')->alias('a')
            ->join('service s','s.id=a.service','LEFT')
            ->field('a.companyname,a.legalperson,a.legalphone,a.indorsation,s.title,a.create_time')
            ->order('a.create_time asc')
            ->select();
        excel_export($name,$header,$datas);
    }
}
