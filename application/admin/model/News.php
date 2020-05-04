<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
class News extends Model
{
    protected $autoWriteTimestamp = true;
  // 定义时间戳字段名
  protected $deleteTime = 'delete_time';
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    use  SoftDelete;
	protected static function init()
    {
      	News::event('before_insert',function($news){
          // dump('model');
          // dump($_FILES);
          //   dump(request()->file('thumb'));exit;
          // if($_FILES['thumb']['tmp_name']){
          //       $file = request()->file('thumb');
          //       $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
          //       if($info){
          //           // $thumb=ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getExtension();
          //           $thumb=$info->getSaveName();
          //           $news['thumb']=$thumb;
          //       }
          //   }
      });


      	News::event('before_update',function($news){
          if(isset($_FILES['thumb']) && $_FILES['thumb']['tmp_name']){
          		$newsres=News::find($news->id);
          		$thumbpath=$_SERVER['DOCUMENT_ROOT'].$newsres['thumb'];
                if(file_exists($thumbpath)){
                	@unlink($thumbpath);
                }
                $file = request()->file('thumb');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    // $thumb=ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getExtension();
                    $thumb=$info->getSaveName();
                    $news['thumb']=$thumb;
                }

            }
      });

      	News::event('before_delete',function($news){
          		$newsres=News::find($news->id);
          		$thumbpath=$_SERVER['DOCUMENT_ROOT'].$newsres['thumb'];
                if(file_exists($thumbpath)){
                	@unlink($thumbpath);
                }
        });


    }
    

    public function getAllNews($page=0)
    {
      if ($page==0) {
        return Db::name('news')->where('delete_time','NULL')->select();
      }else{
        return Db::name('news')->where('delete_time','NULL')->paginate($page);
      }
    }

    public function getIndexNews()
    {
        return Db::name('news')->where('rec','1')->where('delete_time','NULL')->paginate(4);
    }




}
