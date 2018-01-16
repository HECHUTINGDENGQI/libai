<?php
header("Content-Type: text/html; charset=utf-8");
include 'model/int.php';

if(TYPE==1){

	$_M = isset($_GET['mot'])?$_GET['mot']:'home';

	$_C = empty($_GET['ctl'])?'index':$_GET['ctl'];

	$_A = empty($_GET['act'])?'index':$_GET['act'];
}


$url = CONTROLLER.'/'.$_M.'/'.$_C.'.php';

if(file_exists($url)){

	include $url;

}else{

	return false;

}

