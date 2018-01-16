<?php 
// 
$sql = "select * from banner where category_id = 323";

$image = sql_all($mysqli,$sql);

//
	$sql_cate = "select * from category where category_id = 323";

	$arr = sql_all($mysqli,$sql_cate);
//
	$id = empty($_GET['id'])?35:$_GET['id'];

	$sql = "select * from category where id = $id";

	$arrs = sql_sel($mysqli,$sql);

	



	// $sql2 = "select * from news where category_id={$id}";

	/*var_dump($sql2);
*/
	// $arr2 = sql_all($mysqli,$sql2);

	/*var_dump($arr2);die;
*/
$p = empty($_GET['p'])?1:$_GET['p'];

// var_dump($p);

$news_list = pageData('news',$p,4,"category_id={$id}");//

// var_dump($news_list);
$page = page_home('news',$p,4,"mot=home&ctl=news&id={$id}",3,"category_id={$id}");

// var_dump($page);die;

require_once "common.php";

