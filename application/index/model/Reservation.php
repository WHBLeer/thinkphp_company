<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
class Reservation extends Model
{
    
	protected $autoWriteTimestamp = true;
	// 定义时间戳字段名
	protected $deleteTime = 'delete_time';
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    use  SoftDelete;

    protected static function init()
    {
		Service::event('before_insert',function($reservation){
			// $reservation['delete_time']=$info->getSaveName();
		});


      	Service::event('before_update',function($reservation){
          	// $reservation['pic']=$info->getSaveName();
      	});

      	Service::event('before_delete',function($reservation){
        });


    }
}
