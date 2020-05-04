<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
class Partner extends Model
{
	protected $autoWriteTimestamp = true;
	// 定义时间戳字段名
	protected $deleteTime = 'delete_time';
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    use  SoftDelete;

    protected static function init()
    {
		Partner::event('before_insert',function($partner){
			// $partner['delete_time']=$info->getSaveName();
		});


      	Partner::event('before_update',function($partner){
          	// $partner['pic']=$info->getSaveName();
      	});

      	Partner::event('before_delete',function($partner){
      		$arts=Partner::find($partner->id);
      		$picpath=ROOT_PATH . 'public' . DS . 'uploads' .'/'.$arts['pic'];
            if(file_exists($picpath)){
            	@unlink($picpath);
            }
        });


    }
    
    public function getAllConf()
    {
      return Db::name('partner')->where('delete_time','NULL')->select();
    }

}
