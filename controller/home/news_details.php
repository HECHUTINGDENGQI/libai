<?php
$sql = "select * from banner where category_id = 331";

$image = sql_all($mysqli,$sql);

$sql2 = "select * from news order by id desc limit 2";

$arr2 = sql_all($mysqli,$sql2);

/*$sql3 = "select * from category where category_id = 323";
$arr3 = sql_all($mysqli,$sql3);
$id = $arr3['id'];

	// $cate_id = empty($_GET['id'])?80:$_GET['id'];

	foreach($arr as $key => $value){

		$id = $value['cate_name'];
	}*/
$sql2 = "select * from category where category_id=323";
// var_dump($sql);

$news_cate = sql_all($mysqli,$sql2);

//跟随左边栏变化
$id = empty($_GET['id'])?35:$_GET['id'];

// var_dump($id);

$sql5 = "select * from category where id = $id";

// var_dump($sql3);
$arr5 = sql_sel($mysqli,$sql5);

	// var_dump($arr3);die;




//内容
$news_id = $_GET['id'];

$sql3 = "select * from news where news where id=$news_id";

$news_list = sql_all($mysqli,$sql3);
//翻页
$sql = "select * from news where category_id = {$_GET['category_id']} and (id < $news_id) order by id desc limit 1";

$prev = sql_sel($mysqli,$sql);

$sql2 = "select * from news where category_id = {$_GET['category_id']} and (id > $news_id) order by id desc limit 1";

$next = sql_sel($mysqli,$sql2);

require_once 'common.php';