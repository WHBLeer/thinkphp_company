<?php
namespace app\admin\validate;
use think\Validate;
class Style extends Validate
{

    protected $rule=[
        'name'=>'unique:style|require|max:25',
        // 'photo'=>'require',
        'content'=>'require',
    ];


    protected $message=[
        'name.require'=>'员工姓名不能为空',
        'name.unique'=>'员工姓名不得重复！',
        'name.max'=>'员工姓名长度不能大于25个字符！',
        // 'photo.require'=>'员工照片必须上传',
        'content.require'=>'员工介绍不得为空！',
    ];

    protected $scene=[
        'add'=>['name','content'],
        'edit'=>['name','content'],
    ];

}
