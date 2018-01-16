<?php 

header("Content-Type: text/html; charset=utf-8");

$sql = "select * from menu where category_id=0 and distinction=2 and display=1";

$menu = sql_all($mysqli,$sql);

foreach ($menu as $key => $value){

	if(isset($value['controller']) or isset($value['action'])){

		$menu[$key]['urls'] = "index.php?mot={$_M}&ctl={$value['controller']}&act={$value['action']}";
	}

	
}

$sql2 = "select logo from contact where 1";

$result2 = sql_sel($mysqli,$sql2);

$sqlc = "select * from category where category_id = 343";

$resultc = sql_all($mysqli,$sqlc);


      foreach($resultc as $key => $value){
       
        /*$arr[$key]['display'] = $value['display']==1?'正常':'隐藏';*/

        $sql = "select cate_name from category where id = {$value['category_id']}";
        $data = sql_sel($mysqli,$sql);

        $arr[$key]['category_id'] = $data['cate_name']; }
  

$sqld = "select copyright from about where 1";

$resultd = sql_sel($mysqli,$sqld);

// switch ($_C){

// 	case 'index':

// 	$category_id = 312;


// 	break;

// 	case 'goods':

// 	$category_id = 324;

// 	break;

// 	case 'news':

// 	$category_id = 323;

// 	break;

// 	case 'about':

// 	$category_id = 343;

// 	break;

// 	case 'goods_details':

// 	$category_id = 331;

// 	break;

// 	case 'news_details':

// 	$category_id = 332;

// 	break;

// 	case 'contact':

// 	$category_id = 330;

// 	break;


// }






require_once VIEW.$_M.'/header.html';
require_once VIEW.$_M.'/'.$_C.'.html';
require_once VIEW.$_M.'/footer.html';

