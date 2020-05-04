<?php
namespace app\admin\model;
use think\Model;
class Entering extends Model
{
    protected $autoWriteTimestamp = true;
	// 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    protected static function init()
    {
      	Entering::event('before_insert',function($entering){
          // dump($entering);exit;
      	});

      	Entering::event('before_update',function($entering){
          // dump($entering);exit;
      	});

      	Entering::event('before_delete',function($entering){
          // dump($entering);exit;
        });


    }
}
