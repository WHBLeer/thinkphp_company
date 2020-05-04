<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
class About extends Model
{
    protected $autoWriteTimestamp = true;
	// 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    protected static function init()
    {
      	About::event('before_insert',function($about){
          // dump($about);exit;
      	});

      	About::event('before_update',function($about){
          // dump($about);exit;
      	});

      	About::event('before_delete',function($about){
          // dump($about);exit;
        });


    }

    public function getData($id=0)
    {
      return Db::name('about')->find($id);
    }
}
