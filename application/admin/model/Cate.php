<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;
class Cate extends Model
{
    // 定义时间戳字段名
    protected $autoWriteTimestamp = true;
    protected $deleteTime = 'delete_time';
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    use  SoftDelete;
    protected static function init()
    {
        Cate::event('before_insert',function($cate){
            // dump($cate->pid); die;
        });

        Cate::event('before_delete',function(){
            dump(111); die;
            return false;
        });
    }

    public function catetree(){
        $cateres=$this->order('sort asc')->select();
        // dump($cateres);
        return $this->sort($cateres);
    }

    public function sort($data,$pid=0,$level=0){
        static $arr=array();
        foreach ($data as $k => $v) {
            if($v['pid']==$pid){
                $v['level']=$level;
                $arr[]=$v;
                $this->sort($data,$v['id'],$level+1);
            }
        }
        return $arr;
    }

    public function getchilrenid($cateid){
        $cateres=$this->select();
        return $this->_getchilrenid($cateres,$cateid);
    }

    public function _getchilrenid($cateres,$cateid){
        static $arr=array();
        foreach ($cateres as $k => $v) {
            if($v['pid'] == $cateid){
                $arr[]=$v['id'];
                $this->_getchilrenid($cateres,$v['id']);
            }
        }

        return $arr;
    }

    






}
