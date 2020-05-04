<?php
namespace app\admin\validate;
use think\Validate;
class Entering extends Validate
{

    protected $rule=[
        'content'=>'require',
    ];


    protected $message=[
        'content.require'=>'内容不得为空！',
    ];

    protected $scene=[
        'add'=>['content'],
        'edit'=>['content'],
    ];





    

    




   

	












}
