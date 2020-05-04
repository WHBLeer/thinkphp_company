<?php
namespace app\admin\model;
use think\Model;
class Regulation extends Model
{
    protected $autoWriteTimestamp = true;
	// 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    protected static function init()
    {
      	Regulation::event('before_insert',function($regulation){
          // dump($regulation);exit;
      	});

      	Regulation::event('before_update',function($regulation){
          // dump($regulation);exit;
      	});

      	Regulation::event('before_delete',function($regulation){
          // dump($regulation);exit;
        });


    }
}
