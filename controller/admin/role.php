<?php

if(empty($_SESSION['username'])){

  echo"<script>alert('非法登录，请到到登录页');window.location.href='index.php?mot=admin&ctl=login';</script>";
}


if($_A == 'index'){

	$sql = "select * from role where 1";

	$arr = sql_all($mysqli,$sql);

	/*var_dump($arr);die;*/

	/*foreach ($arr as $key => $value) {
		# code...
	}

	$sql_count = "select * from role where id=1";

	$data = sql_sel($mysqli,$sql);
	
	*/


     $sql_count = "select count('role_id') as count from role where 1";

     $count =sql_sel($mysqli,$sql_count);

	include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';	
}

else if ($_A == 'add'){

	if($_POST){

		$data['role_name'] = $_POST['role_name'];

		

		$sql_select = "select role_name from role where role_name = '{$data['role_name']}'";
		/*var_dump($sql);die;*/

		$name = sql_sel($mysqli,$sql_select);

		/*var_dump($name);die;
*/
		if($name){

			script_error('用户名已存在，单整一个');
		}	

			$data['remarks'] = $_POST['remarks'];

			/*var_dump($data['remarks']);die;
*/
			$data['time'] = date("Y-m-d H:i:s",time());

			/*var_dump($data['time']);die;*/

			if($data['role_name'] == ''){

	        script_error('带*号的内容不填走不脱，不信你告看看');
	      }

			$keys = '';

			$values = '';

			foreach ($data as $key => $value){

				$keys .= $key.',';

				$values .="'".$value."',";
			}

			$keys = rtrim($keys,',');

			$values = rtrim($values,',');

			$sql = "insert into role($keys) values($values)";

			$result = sql_insert($mysqli,$sql);

			/*var_dump($result);die;
*/


			if($result){

				script_success('添加成功','index.php?mot=admin&ctl=role&act=index');

			}else{

				script_error('添加失败');


			}
		}

		 include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';
		 //删除页面
	}else if($_A == 'del'){

		$id = $_GET['id'];//是id，不是role_id

		$sql = "delete from role where role_id ={$id}";

		/*var_dump($sql);die;
*/
		$result = sql_del($mysqli,$sql);

		/*var_dump($result);die;*/

		if($result){

			echo json_encode(1);

			die;

		}else{

			echo json_encode(0);

			die;
		}


	}else if($_A == 'edit'){

		if($_POST){

			$id = $_POST['role_id'];

			/*var_dump($id);die;*/

			$data['role_name'] = $_POST['role_name'];

			$data['remarks'] = $_POST['remarks'];

			/*$data['time'] = date("Y-m-d H:i:s",time());
*/
			$keys = '';

			foreach($data as $key => $value){

				$keys .=$key."='".$value."',";
			}

			$keys = rtrim($keys,',');

			$sql = "update role set $keys where role_id = {$id}";

			/*var_dump($sql);die;
*/
			$result = sql_edit($mysqli,$sql);

			if($result){

				script_success('你还是凶嘛','index.php?mot=admin&ctl=role&act=index');

			}else{

				script_error('又是卵的');
			}

		}else{

			$id = $_GET['id'];//是id，不是role_id


			/*var_dump($id);die;*/

			$sql = "select * from role where role_id = {$id}";

			$result = sql_sel($mysqli,$sql);
	
		include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';

		}
	}
	

