<?php

if($_A == 'index'){

	$sql = "select * from user where 1";

	$arr = sql_all($mysqli,$sql);

	foreach($arr as $key => $value){
           	$sql = "select * from role where id={$value['level']}";


			$res = sql_sel($mysqli,$sql);
            $arr[$key]['level']=$res['name'];
            if($value['level']==0){
            	$arr[$key]['level']='超级管理员';
            }


	}

	/*var_dump($result);die;*/

	$sql_count = "select count('id') as count from user where 1";

	$count = sql_sel($mysqli,$sql_count);

	include VIEW.$_M.'/'.$_C.'/'.$_A.'.html';


}else if($_A == 'add'){

	if($_POST){

		$data['username'] = trim($_POST['username']);

		$data['password'] = MD5(trim($_POST['password']));

		$repassword = trim($_POST['repassword']);

		$data['remarks'] = $_POST['remarks'];

		$data['level'] = $_POST['level'];

	

		$data['time'] = date("Y-m-d H:i:s",time());

		$sql = "select username from user where username='".$data['username']."'";

		$name = sql_sel($mysqli,$sql);

			

		if($name){

			script_error('用户已存在，单证呗');

		}
		if($data['password'] != MD5($repassword)){

			script_error('密码不一样');
		}

			$keys = '';

			$values = '';

			foreach($data as $key =>$value){

				$keys .=$key.',';

				$values .= "'".$value."',";
			}

			$keys = rtrim($keys,',');

			$values = rtrim($values,',');
            mysqli_autocommit($mysqli,FALSE);
			$sql = "insert into user ($keys) values ($values)";

			$result =sql_insert($mysqli,$sql);
            $datas = [
               /* 'user_id'=>$result,*/
                'role_id'=>$data['level']
            ];
			// var_dump($result);die;
			$result_all = insert_into('user_role',$datas);

			/*var_dump($result_all);die;
      */
			

			if($result && $result_all){
                mysqli_commit($mysqli);
	       	    mysqli_close($mysqli);
				script_success('添加成功','index.php?mot=admin&ctl=user&act=index');
			}else{
                mysqli_rollback($mysqli);
	       	    mysqli_close($mysqli);
				script_error('添加失败');

			}

		}else{


			$sql = "select * from role where 1";


			$result = sql_all($mysqli,$sql);

			foreach($result as $key => $value){

				$sql2 = "select * from role where category_id={$value['role_id']}";

				$r = sql_all($mysqli,$sql2);

				$result[$key]['children'] = $r;	

						}

				include VIEW.$_M.'/'.$_C.'/'.$_A.'.html';


		}



}else if($_A == 'del'){

		$id = $_GET['id'];

		if($id == 1){

			script_error('超级用户不能删除');
		}

		$sql = "delete from user where id = {$id}";

		$result = sql_del($mysqli,$sql);

		if ($result) {

			echo json_encode(1);

			die;

		}else{

			echo json_encode(0);

			die;
		}
	

	//修改页面
}else if($_A=='edit'){

  if($_POST){

  	/*var_dump($_POST);die;*/	

     $id = $_POST['id'];

     $data['username']      = trim($_POST['username']);

     $data['password']      = MD5(trim($_POST['password']));

     $repassword            = trim($_POST['repassword']);

     $pass                  = MD5($_POST['password_old']);

     $data['remarks']  = $_POST['remarks'];

     $data['time']          = date("Y-m-d H:i:s",time());

     
      //用户和密码判断
      $sql = "select * from user where username='{$data['username']}' and password='{$pass}'";
     /* var_dump($sql);
*/
      $user = sql_sel($mysqli,$sql);
      /*var_dump($user);die;*/

      if(!$user){
        script_error('初始密码错误');

      }

      if($data['password'] !=MD5($repassword)){

        script_error('密码不一致');
      }



        $data['level'] = $_POST['level'];

         mysqli_autocommit($mysqli,FALSE);


			$result =edit_set('user',$data,'id='.$id);
            $datas = [
                'role_id'=>$data['level']
            ];
			// var_dump($result);die;
			$result_all = edit_set('user_role',$datas,'user_id='.$id);

     


         if($result && $result_all){
         		mysqli_commit($mysqli);
	       	    mysqli_close($mysqli);
                script_success('修改成功','index.php?mot=admin&ctl=user&act=index');
         }else{
         		mysqli_rollback($mysqli);
	       	    mysqli_close($mysqli);
                script_error('修改失败');
         
        }

  }else{

     $id = $_GET['id'];

     $sql = "select * from user where id={$id}";

     $result = sql_sel($mysqli,$sql);

    /* var_dump($result);die;*/


    $sql = "select * from role where 1";

	$results = sql_all($mysqli,$sql);

	foreach($results as $key => $value){

		$sql2 = "select * from role where category_id={$value['role_id']}";

		$r = sql_all($mysqli,$sql2);

		$results[$key]['children'] = $r;	

	}
     // print_r($result);die;

    include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';

  }


}
		
			/*$data['remarks_user'] = $_POST['remarks'];

			$data['time'] = time();

			$pass = MD5($_POST['password_old']);

			$sql = "select * from libai where username='{$data['username']}' and id !={$id}"
*/
			

	
?>