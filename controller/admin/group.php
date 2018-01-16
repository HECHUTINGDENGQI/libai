<?php

if($_A == 'index'){

	$sql = "select * from role where 1";

	$result1 = sql_all($mysqli,$sql);

	/*var_dump($result1);die;*/

	$arr = [];

	foreach($result1 as $key => $value){

		$sql = "select * from user_role r inner join role_level m on r.role_id = m.role_id where r.role_id = {$value['id']}";

		$result2 = sql_all($mysqli,$sql);

		/*var_dump($result2);die;*/

		if(!empty($result2)){

			$menu = '';

			foreach($result2 as $k => $v){

				$v['role_id'] = $value['name'];

				$arr[] = $v;

				$sql = "select * from menu where id=".$v['user_id']; 

				$result3 = sql_sel($mysqli,$sql);

				$menu .='|'.$result3['name'];
			
			}

	$result2['user_id'] = $menu;

	$arr[$k]['user_id'] = $result2;

		}

	}
	$sql = "select count(id) as count from role where 1";

	$count = sql_sel($mysqli,$sql);

	/*var_dump($count);die;*/

	include VIEW.$_M.'/'.$_C.'/'.$_A.'.html';

	
}

if($_A == 'add'){

if($_POST){
	$level_arr  = $_POST['level_arr'];
       foreach ($level_arr as $key => $value) {

       	    $data['role_id'] = $_POST['role_id'];
       	    $data['user_id'] = $value;
       	    $data['create_time'] = time();


	/*if($data['name'] == ''){

		script_error('带*号的内容为必填内容');
	}*/

	$keys = '';

	$values = null;

			

	foreach($data as $key => $value){
		$keys .=$key.',';

		$values .="'".$value."',";

		}

	$keys = rtrim($keys,',');

	$values = rtrim($values,',');

	$sql = "insert into role_level($keys) values($values)";
   
	var_dump($sql);

	$result = sql_insert($mysqli,$sql);

			}

	var_dump($result);die;

	if($result){

		script_success('添加成功','index.php?mot=admin&ctl=group&act=index');

	}else{script_error('添加失败');

	}


}else{

	$sql = "select * from menu where category_id=0 and distinction=1";

	$result = sql_all($mysqli,$sql);

	/*var_dump($result);die;*/

	foreach($result as $key => $value){

		$sql2 = "select * from menu where category_id={$value['id']} and distinction=1";

		/*echo $sql2;die;*/

		$r = sql_all($mysqli,$sql2);

		$result[$key]['children'] = $r;

		}

		$sql = "select * from role where 1";

		$arr = sql_all($mysqli,$sql);

	include VIEW.$_M.'/'.$_C.'/'.$_A.'.html';


	}

}else if($_A=='del'){

	$id = $_GET['id'];

	$sql = "delete from level where id={$id}";

	$result = sql_del($mysqli,$sql);

	if($result){

		echo json_encode(1);

		die;

	}else{

		echo json_encode(0);

		die;

}

	
}

else if ($_A == 'edit'){

	if($_POST){

		$id = $_POST['id'];

		$data['name'] = $_POST['name'];

		$data['level_arr'] = json_encode($_POST['level_arr']);

		$data['remarks'] = $_POST['remarks'];

	/*	$data['time'] = date("Y-m-d H:i:s",time());
*/
		$keys = '';

		foreach($data as $key => $value){

			$keys .=$key."='".$value."',";
		}

		$keys = rtrim($keys,',');

		$sql = "update level set $keys where id = {$id}";

		$result = sql_edit($mysqli,$sql);

		if($result){

			script_success('还可以嘛','index.php?mot=admin&ctl=group&act=index');

		}else{

			script_error('假的吧');
		}

        }else{

		$id = $_GET['id'];

		$sql = "select * from level where id = {$id}";

		$result = sql_sel($mysqli,$sql);

		//遍历
		

		$sql2 ="select * from menu where category_id = 0 and distinction = 1";

		$result2 = sql_all($mysqli,$sql2);

		foreach($result2 as $key => $value){

			$sql3 = "select * from menu where category_id = {$value['id']} and distinction = 1";

			$r = sql_all($mysqli,$sql3);

			$result2[$key]['children'] = $r;

			}
			/*var_dump($result2);die;*/
		

		include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html'; 

	}
}