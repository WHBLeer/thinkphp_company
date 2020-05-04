<?php
namespace app\index\validate;
use think\Validate;
class Guide extends Validate
{

	protected $rule=[
		'companyname'    => 'require',
		'creditcode'     => 'require',
		'legalperson'    => 'require',
		'legalphone'     => 'require',
		'officeaddress'  => 'require',
		'registaddress'  => 'require',
		'registmoney'    => 'require',
		'belongfield'    => 'require',
		'techefield'     => 'require',
		'companytotal'   => 'require',
		'zf'             => 'require',
		'lx'             => 'require',
		'sb'             => 'require',
		'gs'             => 'require',
		'gx'             => 'require',
		'entertime'      => 'require',
		'contact1'       => 'require',
		'contacttel1'    => 'require',
		'contact2'       => 'require',
		'contacttel2'    => 'require',
		'introduction'   => 'require',
		'rz'             => 'require',
		'times'          => 'require',
		'financingmoney' => 'require',
		'financingplan'  => 'require',
		'bg'             => 'require',
		'sh'             => 'require',
		'property'       => 'require',
		'patent'         => 'require',
		'software'       => 'require',
		'trademark'      => 'require',
		'scale'          => 'require',
		'nb'             => 'require',
		'abnormal'       => 'require',
		'total1'         => 'require',
		'total2'         => 'require',
		'total3'         => 'require',
		'total4'         => 'require',
		'indorsation'    => 'require',
    ];


    protected $message=[
		'companyname.require'    => '企业名称必须填写',
		'creditcode.require'     => '统一社会信用代码必须填写',
		'legalperson.require'    => '法人姓名必须填写',
		'legalphone.require'     => '法人联系电话必须填写',
		'officeaddress.require'  => '实际办公地址必须填写',
		'registaddress.require'  => '注册地址必须填写',
		'registmoney.require'    => '注册资金必须填写',
		'belongfield.require'    => '所属领域必须填写',
		'techefield.require'     => '技术领域必须填写',
		'companytotal.require'   => '企业人数必须填写',
		'zf.require'             => '是否获得政府奖励必须选择',
		'lx.require'             => '是否为留学归国创业必须选择',
		'sb.require'             => '是否社保登记必须选择',
		'gs.require'             => '是否工商登记必须选择',
		'gx.require'             => '是否为高新技术企业必须选择',
		'entertime.require'      => '入驻中心时间必须填写',
		'contact1.require'       => '财务联系人必须填写',
		'contacttel1.require'    => '财务联系电话必须填写',
		'contact2.require'       => '其他联系人必须填写',
		'contacttel2.require'    => '其他联系电话必须填写',
		'introduction.require'   => '公司或业务，产品简介必须填写',
		'rz.require'             => '是否获得投，融资必须选择',
		'times.require'          => '融资轮次必须填写',
		'financingmoney.require' => '融资金额必须填写',
		'financingplan.require'  => '未来融资计划必须填写',
		'bg.require'             => '是否被并购必须选择',
		'sh.require'             => '是否上市必须选择',
		'property.require'       => '知识产权总数必须填写',
		'patent.require'         => '发明专利数量必须填写',
		'software.require'       => '软件著作权数量必须填写',
		'trademark.require'      => '注册商标数量必须填写',
		'scale.require'          => '企业规模类型必须填写',
		'nb.require'             => '是否完成年报工作必须填写',
		'abnormal.require'       => '异常原因必须填写',
		'total1.require'         => '年收入必须填写',
		'total2.require'         => '年利润必须填写',
		'total3.require'         => '年纳税必须填写',
		'total4.require'         => '年研发投入必须填写',
		'indorsation.require'    => '希望获得哪方面的服务和支持必须填写',
    ];

    protected $scene=[
        'add'=>['companyname', 'creditcode' ,'legalperson', 'legalphone' ,'officeaddress', 'registaddress', 'registmoney', 'belongfield', 'techefield' ,'companytotal', 'zf', 'lx', 'sb', 'gs', 'gx', 'entertime', 'contact1', 'contacttel1', 'contact2', 'contacttel2', 'introduction', 'rz', 'times', 'financingmoney', 'financingplan', 'bg', 'sh', 'property', 'patent', 'software', 'trademark', 'scale', 'nb', 'abnormal', 'total1', 'total2', 'total3', 'total4', 'indorsation'],
    ];





    

    




   

	












}
