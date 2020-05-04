<?php
namespace app\admin\model;
use think\Model;
use traits\model\SoftDelete;
class Style extends Model
{
    protected $autoWriteTimestamp = true;
  // 定义时间戳字段名
  protected $deleteTime = 'delete_time';
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    use  SoftDelete;
	protected static function init()
    {
      	Style::event('before_insert',function($style){
          // dump('model');
          // dump($_FILES);
          //   dump(request()->file('photo'));exit;
          // if($_FILES['photo']['tmp_name']){
          //       $file = request()->file('photo');
          //       $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
          //       if($info){
          //           // $photo=ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getExtension();
          //           $photo=$info->getSaveName();
          //           $style['photo']=$photo;
          //       }
          //   }
      });


      	Style::event('before_update',function($style){
          if(isset($_FILES['photo']) && $_FILES['photo']['tmp_name']){
          		$styleres=Style::find($style->id);
          		$photopath=$_SERVER['DOCUMENT_ROOT'].$styleres['photo'];
                if(file_exists($photopath)){
                	@unlink($photopath);
                }
                $file = request()->file('photo');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    // $photo=ROOT_PATH . 'public' . DS . 'uploads'.'/'.$info->getExtension();
                    $photo=$info->getSaveName();
                    $style['photo']=$photo;
                }

            }
      });

      	Style::event('before_delete',function($style){
          		$styleres=Style::find($style->id);
          		$photopath=$_SERVER['DOCUMENT_ROOT'].$styleres['photo'];
                if(file_exists($photopath)){
                	@unlink($photopath);
                }
        });


    }

}
