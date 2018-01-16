<?php
$sql = "select * from banner where category_id = 343";

$image = sql_all($mysqli,$sql);


	$sql_cate = "select * from category where category_id = 343";

	$arr = sql_all($mysqli,$sql_cate);

	$id = empty($_GET['id'])?80:$_GET['id'];

	$sql = "select * from category where id = $id";

	$arrs = sql_sel($mysqli,$sql);

	$cate_id = empty($_GET['id'])?80:$_GET['id'];

	foreach($arr as $key => $value){

		$cate_id = $value['cate_name'];
	}

	$sql2 = "select * from about where category_id={$id}";

	/*var_dump($sql2);
*/
	$arr2 = sql_all($mysqli,$sql2);

	/*var_dump($)*/

	

	




require_once 'common.php';