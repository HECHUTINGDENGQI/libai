<?php

if($_A == 'index'){

	$sql = "select * from category where 1";

	$arr = sql_all($mysqli,$sql);

  foreach($arr as $key => $value){
       
        $arr[$key]['display'] = $value['display']==1?'正常':'隐藏';

        $sql = "select * from menu where id = {$value['category_id']}";

        // var_dump($sql);

        $data = sql_sel($mysqli,$sql);

        // var_dump($data);die;

        $arr[$key]['category_id'] = $data['menu_name']; 
     
         }

	$sql_count = "select count('id') as count from category where 1";

	$count = sql_sel($mysqli,$sql_count);

	include VIEW.$_M.'/'.$_C.'/'.$_A.'.html';
	
}

else if($_A == 'add'){


	if($_POST){

      if(!is_numeric($_POST['place'])){

        script_error('位置必须是数字');
      }

      $data = $_POST;

      $data['create_time']     = date("Y-m-d H:i:s",time());

      if(!empty($data['cate_id'])){

        $data['category_id'] = $data['cate_id'];
        
      }
      unset($data['cate_id']);
      

      $keys = '';

      $values = '';
      
      foreach ($data as $key => $value){

        $keys .= $key.',';

        $values .="'".$value."',";
      }

      $keys = rtrim($keys,',');

      $values = rtrim($values,',');

      $sql = "insert into category($keys) values($values)";

      $result = sql_insert($mysqli,$sql);

        if($result){

          script_success('添加成功','index.php?mot=admin&ctl=category&act=index');

       }else{

          script_error('添加失败');
       }

    }else{

      $sql = "select * from menu where distinction=2 and category_id=0";

      $arr = sql_all($mysqli,$sql);

      include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';
    }

} else if($_A == 'del'){

      $id = $_GET['id'];

      $sql = "delete from category where id ={$id}";

      $result = sql_del($mysqli,$sql);

      // var_dump($result);die;


      if($result){

        echo json_encode(1);

        die;
      }else{

        echo json_encode(0);

        die;
      }
    }


    //修改页面
    
    else if($_A == 'edit'){

      if($_POST){

        $id = $_POST['id'];

        /*var_dump($id);die;
*/
       // echo_print($_FILES);
       if(!is_numeric($_POST['place'])){

      script_error('位置必须是数字');
    }

    $data = $_POST;

    /**/

    if(!empty($data['cate_id'])){

      $data['category_id'] = $data['cate_id'];
    }


    unset($data['cate_id']);

       /* $data['category_id'] = $_POST['category_id'];

        $data['create_time'] = date("Y-m-d H:i:s",time());

        $data['display'] = $_POST['display'];

        $data['remarks'] = $_POST['remarks'];
        $data['cate_name'] = $_POST['cate_name'];

        $data['place'] = $_POST['place'];
*/

        /*var_dump($data['remarks']);die;
*/


        $keys ='';

        foreach($data as $key => $value){

          $keys .=$key."='".$value."',";
        }

          $keys = rtrim($keys,',');

          $sql = "update category set $keys where id={$id}";

         /* var_dump($sql);
*/
          $result = sql_edit($mysqli,$sql);

          /*var_dump($result);die;*/

          if($result){

            script_success('可以嘛你娃儿','index.php?mot=admin&ctl=category&act=index');

          }else{

            script_error('跟你说你不信，拐了哇');
          }

        }else{

          $id = $_GET['id'];

          /*var_dump($id);die;
*/
          $sql = "select * from category where id = {$id}";

          /*echo $sql;die;*/

          $result = sql_sel($mysqli,$sql);

          $sql2 = "select * from menu where category_id = 0 and distinction = 2";

          $results = sql_all($mysqli,$sql2);

          /*var_dump($result);die;
*/
        include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';  

      }
    }