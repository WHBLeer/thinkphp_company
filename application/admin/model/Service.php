<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
class Service extends Model
{
	protected $autoWriteTimestamp = true;
	// 定义时间戳字段名
	protected $deleteTime = 'delete_time';
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    use  SoftDelete;

    protected static function init()
    {
		Service::event('before_insert',function($service){
			// $service['delete_time']=$info->getSaveName();
		});


      	Service::event('before_update',function($service){
          	// $service['pic']=$info->getSaveName();
      	});

      	Service::event('before_delete',function($service){
      		// $arts=Service::find($service->id);
      		// $picpath=IMG_PATH .'/'.$arts['pic'];
        //     if(file_exists($picpath)){
        //     	@unlink($picpath);
        //     }
        });


    }

    public function getAllConf($page=0)
    {
      if ($page==0) {
        return Db::name('service')->where('type=1')->select();
      }else{
        return Db::name('service')->where('type=1')->paginate($page);
      }
    }

    

}
