<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
class Office extends Model
{
    protected $autoWriteTimestamp = true;
  // 定义时间戳字段名
  protected $deleteTime = 'delete_time';
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    use  SoftDelete;
	protected static function init()
    {
      	Office::event('before_insert',function($office){
          // dump('model');
          // dump($_FILES);
          //   dump(request()->file('album'));exit;
          // if($_FILES['album']['tmp_name']){
          //       $file = request()->file('album');
          //       $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
          //       if($info){
          //           // $album=ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getExtension();
          //           $album=$info->getSaveName();
          //           $office['album']=$album;
          //       }
          //   }
      });


      	Office::event('before_update',function($office){
          if(isset($_FILES['album']) && $_FILES['album']['tmp_name']){
          		$officeres=Office::find($office->id);
          		$albumpath=$_SERVER['DOCUMENT_ROOT'].$officeres['album'];
                if(file_exists($albumpath)){
                	@unlink($albumpath);
                }
                $file = request()->file('album');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    // $album=ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getExtension();
                    $album=$info->getSaveName();
                    $office['album']=$album;
                }

            }
      });

      	Office::event('before_delete',function($office){
          		$officeres=Office::find($office->id);
          		$albumpath=$_SERVER['DOCUMENT_ROOT'].$officeres['album'];
                if(file_exists($albumpath)){
                	@unlink($albumpath);
                }
        });


    }

    public function getAllConf($page=0)
    {
      if ($page==0) {
        return Db::name('office')->where('delete_time','NULL')->select();
      }else{
        return Db::name('office')->where('delete_time','NULL')->paginate($page);
      }
    }
}
