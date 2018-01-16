
<?php

if(empty($_SESSION['username'])){

  echo"<script>alert('非法登录，请到到登录页');window.location.href='index.php?mot=admin&ctl=login';</script>";
}

// echo 1;die;
/*if($_A == 'index'){

  $limit = 'limit 0,3';

  $sql = "select * from news {$limit}";

  $result = sql_all($mysqli,$sql);

  include VIEW .$_M.'/'.$_C.'/'.$_A.'.html';
*/
if($_A == 'index'){   

        /*var_dump($result);die;*/

        // $arr = category_tree(0,0,'&nbsp;|-','news');
        
      $sql = "select * from message where 1";

      $arr = sql_all($mysqli,$sql);


      $sql2 = "select count(id) as count from message where 1";

       $count =sql_sel($mysqli,$sql2);

     // var_dump($count);die;

  include VIEW.$_M.'/'.$_C.'/'.$_A.'.html';
}
  

//新闻添加
else if($_A == 'add'){

  if($_POST){


   /* $data['image'] = $files;*/

    $data['name'] = $_POST['name'];

   

    $data['phone'] = $_POST['phone'];

    $data['email'] = $_POST['email'];

    $data['fax'] = $_POST['fax'];

    $data['address'] = $_POST['address'];

     $data['messgae'] = $_POST['message'];

      $keys = '';

      $values = '';

      foreach ($data as $key => $value){

        $keys .= $key.',';

        $values .="'".$value."',";
      }

      $keys = rtrim($keys,',');

     /* var_dump($keys);die;
*/
      $values = rtrim($values,',');

      //插入
      $sql = "insert into message ($keys) values($values)";

      $result = sql_insert($mysqli,$sql);

      if($result){

        script_success('添加成功','index.php?mot=admin&ctl=message&act=index');

      }else{

        script_error('添加失败');

        }

      }else{

        
         // $arr= category_tree(323,$num =0,'&nbsp;|-','category','cate_name','*', array(),'id','');


      include VIEW.$_M.'/'.$_C.'/'.$_A.'.html';

      }

    }

    // 删除页面
    
    else if($_A == 'del'){

      $id = $_GET['id'];

      $sql = "delete from message where id ={$id}";

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


   