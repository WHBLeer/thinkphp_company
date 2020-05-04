<?php
namespace app\admin\validate;
use think\Validate;
class Partner extends Validate
{

    protected $rule=[
        'title'=>'unique:partner|require|max:25',
        'url'=>'url|require',
        // 'pic'=>'require',
        'desc'=>'require',
    ];


    protected $message=[
        'title.require'=>'链接标题不得为空！',
        'title.unique'=>'链接标题不得重复！',
        'title.max'=>'链接标题长度大的大于25个字符！',
        'url.url'=>'链接地址格式不正确！',
        // 'pic.require'=>'合作伙伴图标必须上传',
        'desc.require'=>'链接描述不得为空！',
    ];

    protected $scene=[
        'add'=>['title','url','desc'],
        'edit'=>['url'],
    ];





    

    




   

	












}
