
<?php
$sql = "select * from banner where category_id = 324";

$image = sql_all($mysqli,$sql);


	$sql_cate = "select * from category where category_id = 324";

	$arr = sql_all($mysqli,$sql_cate);

	$id = empty($_GET['id'])?44:$_GET['id'];

	$sql = "select * from category where id = $id";

	$arrs = sql_sel($mysqli,$sql);

/*	$cate_id = empty($_GET['id'])?44:$_GET['id'];

	foreach($arr as $key => $value){

		$cate_id = $value['cate_name'];
	}
*/
	/*$sql2 = "select * from goods where category_id={$id}";

	var_dump($sql2);

	$arr2 = sql_all($mysqli,$sql2);

	$p = empty($_GET['p'])?1:$_GET['p'];*/

// var_dump($p);

$p = empty($_GET['p'])?1:$_GET['p'];

$goods_list = pageData('goods',$p,6,"category_id={$id}");

// var_dump($news_list);
$page = page_home('goods',$p,6,"mot=home&ctl=goods&id={$id}",3,"category_id={$id}");

// var_dump($page);die;





	/*var_dump($arr2);die;
*/

require_once 'common.php';