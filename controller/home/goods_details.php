<?php
$sql = "select * from banner where category_id = 332";

$image = sql_all($mysqli,$sql);



$sql2 = "select * from goods  order by id desc limit 1 ";

$arr2 = sql_all($mysqli,$sql2);



$sql = "select * from category where category_id=324";
	// var_dump($sql);

$goods_cate = sql_all($mysqli,$sql);

//跟随左边栏变化
$id= empty($_GET['id'])?44:$_GET['id'];

// var_dump($id);

$sql5 = "select * from category where id = $id";

// var_dump($sql4);
$arr5= sql_sel($mysqli,$sql5);


// var_dump($arr4);die;


require_once 'common.php';