<?php
namespace app\admin\validate;
use think\Validate;
class Office extends Validate
{

    protected $rule=[
        'title'=>'unique:office|require|max:25',
        // 'album'=>'require',
        'content'=>'require',
    ];


    protected $message=[
        'title.require'=>'办公空间名称不能为空',
        'title.unique'=>'办公空间名称不得重复！',
        'title.max'=>'办公空间名称长度不能大于25个字符！',
        // 'album.require'=>'办公空间名称照片必须上传',
        'content.require'=>'办公空间名称介绍不得为空！',
    ];

    protected $scene=[
        'add'=>['title','content'],
        'edit'=>['title','content'],
    ];

}
