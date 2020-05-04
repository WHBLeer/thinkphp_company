<?php
namespace app\admin\validate;
use think\Validate;
class Service extends Validate
{

    protected $rule=[
        'title'=>'require|max:25',
    ];


    protected $message=[
        'title.require'=>'链接标题不得为空！',
        // 'title.unique'=>'链接标题不得重复！',
        'title.max'=>'链接标题长度大的大于25个字符！',
    ];

    protected $scene=[
        'add'=>['title'],
        'edit'=>['title'],
    ];





    

    




   

	












}
