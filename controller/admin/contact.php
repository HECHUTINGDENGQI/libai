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
        
      $sql = "select * from contact where 1";

      $arr = sql_all($mysqli,$sql);

      foreach($arr as $key => $value){
       
        $arr[$key]['display'] = $value['display']==1?'正常':'隐藏';
/*
        $sql = "select menu_name from menu where id = {$value['category_id']}";
        $data = sql_sel($mysqli,$sql);

        $arr[$key]['category_id'] = $data['menu_name'];*/

      }

      $sql2 = "select count(id) as count from contact where 1";

       $count =sql_sel($mysqli,$sql2);

     // var_dump($count);die;

  include VIEW.$_M.'/'.$_C.'/'.$_A.'.html';
}
  

//新闻添加
else if($_A == 'add'){

  if($_POST){

         $array = ['image/jpeg','image/png','image/gif']; 
       if($_FILES['logo']['name']){ //判断是否存在文件名
          if(in_array($_FILES['logo']['type'],$array)){ //判断是否为图片文件
               if($_FILES['logo']['size']<2097152){//判断大小范图
                     // echo_print($_FILES['image']['name']);
                     $ext = strripos($_FILES['logo']['name'],'.');
                     $exts = substr($_FILES['logo']['name'],$ext);
                     // var_dump($exts);die;
                     $upload = 'upload/';
                     if(!file_exists($upload)){
                      mkdir($upload,0777); //生成目录 0777最高权限 可读 可写
                     }
                     $files = $upload.rand(10000,99999).date('Ymd',time()).$exts;
                     $image = move_uploaded_file($_FILES['logo']['tmp_name'],$files);
                     $data['logo']   = $files;
                     // var_dump($image);die;
               }
          }
       }

     $data['display'] = $_POST['display'];


      $keys = '';

      $values = '';

      foreach ($data as $key => $value){

        $keys .= $key.',';

        $values .="'".$value."',";
      }

      $keys = rtrim($keys,',');

      

      $values = rtrim($values,',');

      //插入
      $sql = "insert into contact($keys) values($values)";

     /* var_dump($sql);*/

      $result = sql_insert($mysqli,$sql);

      /*var_dump($result);die;*/

      if($result){

        script_success('添加成功','index.php?mot=admin&ctl=contact&act=index');

      }else{

        script_error('添加失败');

        }

      }else{

        
        /* $arr= category_tree(5,0,'&nbsp;|-','menu','menu_name','*', array(),'id','');*/


      include VIEW.$_M.'/'.$_C.'/'.$_A.'.html';

      }

    }

    // 删除页面
    
    else if($_A == 'del'){

      $id = $_GET['id'];

      $sql = "delete from contact where id ={$id}";

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
       if($_FILES['logo']['name']){ //判断是否存在文件名
          if(in_array($_FILES['logo']['type'],$array)){ //判断是否为图片文件
               if($_FILES['logo']['size']<2097152){//判断大小范图
                     // echo_print($_FILES['image']['name']);
                     $ext = strripos($_FILES['logo']['name'],'.');
                     $exts = substr($_FILES['logo']['name'],$ext);
                     // var_dump($exts);die;
                     $upload = 'upload/';
                     if(!file_exists($upload)){
                      mkdir($upload,0777); //生成目录 0777最高权限 可读 可写
                     }
                     $files = $upload.rand(10000,99999).date('Ymd',time()).$exts;
                     $image = move_uploaded_file($_FILES['logo']['tmp_name'],$files);
                     $data['logo']   = $files;
                     // var_dump($image);die;
               }
          }
       }

        $id = $_POST['id'];

     $data['display'] = $_POST['display'];

        $keys ='';

        foreach($data as $key => $value){

          $keys .=$key."='".$value."',";
        }

          $keys = rtrim($keys,',');

          $sql = "update contact set $keys where id={$id}";

          /*echo $sql;*/

          $result = sql_edit($mysqli,$sql);

          /*var_dump($result);die;*/

          // echo 1;die;
          if($result){

            script_success('可以嘛你娃儿','index.php?mot=admin&ctl=contact&act=index');

          }else{

            script_error('跟你说你不信，拐了哇');
          }

        }else{

          $id = $_GET['id'];

         /* var_dump($id);die;*/

          $sql = "select * from contact where id = {$id}";

          /*echo $sql;die;*/

          $result = sql_sel($mysqli,$sql);

        /* $arr= category_tree(323,$num =0,'&nbsp;|-','category','cate_name','*', array(),'id','');*/

          /*var_dump($result);die;
*/
        include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';  

      }
    }
    /*$array = ['image/jpeg','image/png','image/gif'];

    if($_FILES['image']['name']){

      print_r($_FILES['image']['name']);die;

      if(in_array($_FILES['image']['type'],$array)){

        if($_FILES['image']['size']<2097152){

          $ext = strripos($_FILES['image']['name'],'.');

          $exts = substr($_FILES['image']['name'],$ext);

          $upload = 'upload/';

          if(!file_exists($upload)){

            mkdir($upload,0777);//生成目录 0777最高权限 可选 可读


          }

          $files = $upload.rand(10000,99999).date('Ymd',time()).$exts;

          $image = move_uploaded_file($_FILES['image']['tmp_name'],$files);

        }
      }
    }
  }
}

*/
