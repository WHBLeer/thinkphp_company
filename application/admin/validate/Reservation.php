<?php
namespace app\index\validate;
use think\Validate;
class Reservation extends Validate
{

    protected $rule=[
		'companyname' => 'require',
		'legalperson' => 'require',
		'legalphone'  => 'require',
		'service'     => 'require',
		'indorsation' => 'require',
    ];


    protected $message=[
		'companyname.require' => '企业名称必须填写',
		'legalperson.require' =>'企业负责人名称必须填写',
		'legalphone.require'  => '企业负责人联系电话必须填写',
		'service.require'     => '预约的服务必须选择',
		'indorsation.require' => '请填写希望获得哪方面的服务和支持',
    ];

    protected $scene=[
        'add'=>['companyname', 'legalperson', 'legalphone', 'service', 'indorsation',],
    ];

}
