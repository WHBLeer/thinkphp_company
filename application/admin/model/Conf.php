<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Conf extends Model
{
    

    public function getAllConf()
    {
    	return Db::name('conf')->select();
    }






}
