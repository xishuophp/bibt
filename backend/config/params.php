<?php
$params = [
    'adminEmail' => 'admin@example.com',
    'systemAdmin'=>['admin','mingyu.yue','xiaoling'],
    'languageArr' => ['zh-CN', 'en'],
    'pageSize' => 20,
    'userStatus'=>[
        200=>'正常',
        110=>'禁用',
        120=>'冻结',
    ],

    'sex'=>[
        0=>'女',
        1=>'男',
    ],

    'deptType'=>[
        1=>'行政',
        2=>'教学',
    ],

    'staffType' =>[
        1=>'教师',
        2=>'行政',
    ],

    'navType'=>[
        1=>'页面',
        2=>'资讯',
    ],

    'articleStatus'=>[
        1=>'发布',
        2=>'保存',
        3=>'过期',
    ],
    'ArticleTitleColorArr'=>[
        "#555"=>'#555',
        "#ac725e"=>"#ac725e",
        "#d06b64"=>"#d06b64",
        "#f83a22"=>"#f83a22",
        "#fa573c"=>"#fa573c",
        "#ff7537"=>"#ff7537",
        "#ffad46"=>"#ffad46",
        "#42d692"=>"#42d692",
        "#16a765"=>"#16a765",
        "#7bd148"=>"#7bd148",
        "#b3dc6c"=>"#b3dc6c",
        "#fbe983"=>"#fbe983",
        "#fad165"=>"#fad165",
        "#92e1c0"=>"#92e1c0",
        "#9fe1e7"=>"#9fe1e7",
        "#9fc6e7"=>"#9fc6e7",
        "#4986e7"=>"#4986e7",
        "#9a9cff"=>"#9a9cff",
        "#b99aff"=>"#b99aff",
        "#c2c2c2"=>"#c2c2c2",
        "#cabdbf"=>"#cabdbf",
        "#cca6ac"=>"#cca6ac",
        "#f691b2"=>"#f691b2",
        "#cd74e6"=>"#cd74e6",
        "#a47ae2"=>"#a47ae2",
    ],
    //员工的缓存文件名
    'staffList'=>'staff_list',

    'academicYear' => [
        1=>'第一学年上学期',
        2=>'第一学年下学期',
        3=>'第二学年上学期',
        4=>'第二学年下学期',
        5=>'第三学年上学期',
        6=>'第三学年下学期',
        7=>'第四学年上学期',
        8=>'第四学年下学期',
    ],

    'weekDay' => [
        1=>'周一',
        2=>'周二',
        3=>'周三',
        4=>'周四',
        5=>'周五',
        6=>'周六',
        7=>'周日',
    ],
];

//将缓存的数据加载进来
$params = array_merge(
        $params,
        require(__DIR__ . '/../../data/cache/cachedData.php')
);

return $params;