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
        
      $sql = "select * from goods where 1";

      $arr = sql_all($mysqli,$sql);

      foreach($arr as $key => $value){
       
        $arr[$key]['display'] = $value['display']==1?'正常':'隐藏';

        $sql = "select cate_name from category where id = {$value['category_id']}";
        $data = sql_sel($mysqli,$sql);

        $arr[$key]['category_id'] = $data['cate_name']; 

        $data['create_time'] = date("Y-m-d H:i:s",time());
        
      }

      $sql2 = "select count(id) as count from goods where 1";

       $count =sql_sel($mysqli,$sql2);

     // var_dump($count);die;

  include VIEW.$_M.'/'.$_C.'/'.$_A.'.html';
}
  

//新闻添加
else if($_A == 'add'){

  if($_POST){

    /*var_dump($_POST);die;*/
   /* echo_print($_FILES);
*/
   /* $array = ['image/jpeg','image/png','image/gif'];
*/
    /*var_dump($array);die;*/
 $array = ['image/jpeg','image/png','image/gif']; 
       if($_FILES['image']['name']){ //判断是否存在文件名
          if(in_array($_FILES['image']['type'],$array)){ //判断是否为图片文件
               if($_FILES['image']['size']<2097152){//判断大小范图
                     // echo_print($_FILES['image']['name']);
                     $ext = strripos($_FILES['image']['name'],'.');
                     $exts = substr($_FILES['image']['name'],$ext);
                     // var_dump($exts);die;
                     $upload = 'upload/';
                     if(!file_exists($upload)){
                      mkdir($upload,0777); //生成目录 0777最高权限 可读 可写
                     }
                     $files = $upload.rand(10000,99999).date('Ymd',time()).$exts;
                     $image = move_uploaded_file($_FILES['image']['tmp_name'],$files);
                     $data['image']   = $files;
                     // var_dump($image);die;
               }
          }
       }




   
    $data['category_id'] = $_POST['category_id'];

    /*var_dump( $_POST['category_id']);die;*/
    $data['remarks'] = $_POST['remarks'];

    $data['content'] = $_POST['content'];

    $data['name'] = $_POST['name'];

    $data['price'] = $_POST['price'];
   
  
    $data['display'] = $_POST['display'];

    $data['create_time'] = date("Y-m-d H:i:s",time());

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
      $sql = "insert into goods($keys) values($values)";

      /*var_dump($sql);*/

      $result = sql_insert($mysqli,$sql);

      /*var_dump($result);die;*/

      if($result){

        script_success('添加成功','index.php?mot=admin&ctl=goods&act=index');

      }else{

        script_error('添加失败');

        }

      }else{

       /* $sql2 = "select * from menu where category_id = 0 and distinction = 2";

          $results= sql_all($mysqli,$sql2);
*/
         $arr= category_tree(324,0,'&nbsp;|-','category','cate_name','*', array(),'id','');

         /*var_dump($arr);die;*/


      include VIEW.$_M.'/'.$_C.'/'.$_A.'.html';

      }

    }

    // 删除页面
    
    else if($_A == 'del'){

      $id = $_GET['id'];

      $sql = "delete from goods where id ={$id}";

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

         $array = ['image/jpeg','image/png','image/gif']; 
       if($_FILES['image']['name']){ //判断是否存在文件名
          if(in_array($_FILES['image']['type'],$array)){ //判断是否为图片文件
               if($_FILES['image']['size']<2097152){//判断大小范图
                     // echo_print($_FILES['image']['name']);
                     $ext = strripos($_FILES['image']['name'],'.');
                     $exts = substr($_FILES['image']['name'],$ext);
                     // var_dump($exts);die;
                     $upload = 'upload/';
                     if(!file_exists($upload)){
                      mkdir($upload,0777); //生成目录 0777最高权限 可读 可写
                     }
                     $files = $upload.rand(10000,99999).date('Ymd',time()).$exts;
                     $image = move_uploaded_file($_FILES['image']['tmp_name'],$files);
                     $data['image']   = $files;
                     // var_dump($image);die;
               }
          }
       }



        $id = $_POST['id'];

        /*var_dump($id);die;
*/
       // echo_print($_FILES);

    $data['category_id'] = $_POST['category_id'];

    /*var_dump( $_POST['category_id']);die;*/
    $data['remarks'] = $_POST['remarks'];

    
    $data['content'] = $_POST['content'];

    $data['name'] = $_POST['name'];

    $data['price'] = $_POST['price'];
   
  
    $data['display'] = $_POST['display'];

    $data['create_time'] = date("Y-m-d H:i:s",time());



        $keys ='';

        foreach($data as $key => $value){

          $keys .=$key."='".$value."',";
        }

          $keys = rtrim($keys,',');

          $sql = "update goods set $keys where id={$id}";

          /*echo $sql;die;
*/
          $result = sql_edit($mysqli,$sql);

          /*var_dump($result);die;*/

          // echo 1;die;
          if($result){

            script_success('可以嘛你娃儿','index.php?mot=admin&ctl=goods&act=index');

          }else{

            script_error('跟你说你不信，拐了哇');
          }

        }else{

          $id = $_GET['id'];

         /* var_dump($id);die;*/

          $sql = "select * from goods where id = {$id}";

          /*echo $sql;die;*/

          $result = sql_sel($mysqli,$sql);

          
         $arr= category_tree(324,0,'&nbsp;|-','category','cate_name','*', array(),'id','');

          /*var_dump($result);die;
*/
        include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';  

      }
    }
   