<?php

return [
  'app_debug'=>true,
  'app_trace'=>false,
  
  //关闭模板缓存
  'TMPL_CACHE_ON' => false,  
  'HTML_CACHE_ON'=>false,
  
   //输出替换
   'view_replace_str'  =>  [
        '__INDEX__'=>SITE_URL.'/static/index',
	    '__ADMIN__'=>SITE_URL.'/static/admin',
      '__COMMON__'=>SITE_URL.'/static/common',
	    '__IMG__'=>SITE_URL.'/uploads',
	],
	//分页配置
    'paginate'			=> [
        'type'      => 'Bpagination',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],
];
