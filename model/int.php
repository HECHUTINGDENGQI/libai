<?php
//debug报错开启
define('DEBUG',true);

if(DEBUG == true){

	error_reporting(E_ALL);

}else{

	error_reporting(0);

}
//开启session
if(empty($_SESSION)){

	session_start();

}
//路径常量
define('CONTROLLER','controller');//控制器目录

define('TYPE',1);//切换路由

define('A_COMMON','common/admin/');//资源目录 后台js css font

define('VIEW','view/');//视图目录
//数据库初始配置
define('DBHOST','127.0.0.1');

define('DBUSER','root');

define('DBPASSWORD','root');

define('DBNAME','libai');
/*define('DBNAME2','menu');*/
define('CHARSET','utf8');

define('ADMIN','h-ui.admin/');





include 'config.php';

include 'function.php';

include 'common.php';

include 'code.php';

include 'upload.php';

include 'page.php';


db();
/*db2();*/
// var_dump($mysqli);die;
if(TYPE==1){

	$_M = isset($_GET['mot'])?$_GET['mot']:'admin';

	$_C = empty($_GET['ctl'])?'index':$_GET['ctl'];

	$_A = empty($_GET['act'])?'index':$_GET['act'];

}


define('MAP','index.php?mot=home&ctl=map&act=index');


define('H_COMMON','common/home/');
/*
if(TYPE==2){

	$_M = isset($_GET['hot'])?$_GET['hot']:'home';

	$_C = empty($_GET['ctl'])?'index':$_GET['ctl'];

	$_A = empty($_GET['act'])?'index':$_GET['act'];

}*/


define('INDEX','index.php?mot=home&ctl=index&act=index');

define('ABOUT','index.php?mot=home&ctl=about&act=index');

define('GOODS','index.php?mot=home&ctl=goods&act=index');

define('NEWS','index.php?mot=home&ctl=news&act=index');

define('GOODS_DETAILS','index.php?mot=home&ctl=goods_details&act=index');

define('NEWS_DETAILS','index.php?mot=home&ctl=news_details&act=index');

define('CONTACT','index.php?mot=home&ctl=contact&act=index');


