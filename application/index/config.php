<?php

return [
   //输出替换
   'view_replace_str'  =>  [
        '__INDEX__'=>SITE_URL.'/static/index',
        '__COMMON__'=>SITE_URL.'/static/common',
        '__IMG__'=>SITE_URL.'/uploads',
    ],
    //分页配置
    'paginate'          => [
        'type'      => 'Fpagination',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],
];
