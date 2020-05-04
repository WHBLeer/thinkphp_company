<?php
namespace app\admin\controller;
use app\admin\model\Guide as GuideModel;
use app\admin\model\About as AboutModel;
use think\Request;
class Guide extends Common
{
    public function index(){
        $guide=new GuideModel();
        $guideres=$guide->order('create_time desc')->paginate(12);
        $this->assign('guideres',$guideres);
        return view();
    }

    public function del(){
        $del=GuideModel::destroy(input('id'));
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
        $name = '入驻申请列表';
        $header=['企业名称','统一社会信用代码','法人姓名','法人联系电话','实际办公地址','注册地址','注册资金','所属领域','技术领域','企业人数','是否获得政府奖励','是否为留学归国创业','社保登记','工商登记','是否为高新技术企业','入驻中心时间','财务联系人','财务联系电话','其他联系人','其他联系电话','公司或业务，产品简介','是否获得投，融资','融资轮次','融资金额（万元）','未来融资计划','是否被并购','是否上市','知识产权总数','发明专利数量','软件著作权数量','注册商标数量','企业规模类型','是否完成年报工作','异常原因','年收入（万元）','年利润（万元）','年纳税（万元）','年研发投入（万元）','希望获得哪方面的服务和支持','申请时间'];
        $datas= db('guide')->field('companyname,creditcode,legalperson,legalphone,officeaddress,registaddress,registmoney,belongfield,techefield,companytotal,zf,lx,sb,gs,gx,entertime,contact1,contacttel1,contact2,contacttel2,introduction,rz,times,financingmoney,financingplan,bg,sh,property,patent,software,trademark,scale,nb,abnormal,total1,total2,total3,total4,indorsation,create_time')->order('create_time asc')->select();
        // dump($header);
        // dump($datas);exit;
        excel_export($name,$header,$datas);
    }

    public function zhinan()
    {
    	$zhinan = db('about')->find(3);
        if ($zhinan) {
            if(request()->isPost()){
                $data=input('post.');
                $zhinan=new AboutModel;
                $save=$zhinan->update($data);
                if($save){
                    $this->success('入孵指南保存成功！',url('zhinan'));
                }else{
                    $this->error('入孵指南保存失败！');
                }
                return;
            }
        }else{
            $data=[
                'title'=>'入孵指南' ,              
                'content'=>'入孵指南...',
            ];   
            // 添加到数据库
            $zhinan=new AboutModel;
            $save=$zhinan->save($data);
            if($save){
                $id = db('about')->getLastInsID();
                $zhinan = db('about')->find($id);
            }
        }
        
        $this->assign('zhinan',$zhinan);
        return view();
    }
}
