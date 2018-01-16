<?php
//banner图管理

if($_A=='index'){

    $sql = "select * from banner where 1";

    $arr = sql_all($mysqli,$sql);
    // var_dump($arr);die;

    foreach ($arr as $key => $value) {

   $sql = "select * from menu where id={$value['category_id']}";
   // var_dump($sql);
   $data = sql_sel($mysqli,$sql);

   // var_dump($data);die;
     
    $arr[$key]['category_id'] = $data['menu_name'];


     $arr[$key]['display'] = $value['display']==1?'显示':'隐藏';

   }

    $sql_count = "select count('id') as count from banner where 1";

    $count = sql_sel($mysqli,$sql_count);

  include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';


}else if($_A=='add'){

  if($_POST){
    
    // var_dump($_POST);die;

     if(!is_numeric($_POST['place'])){

        script_error('位置必须是数字');
      }

    $data = $_POST;

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

    $data['create_time'] = date("Y-m-d H:i:s",time());

     $keys = '';
     $values = '';

     foreach ($data as $key => $value){

       $keys .= $key.',';
       $values .= "'".$value."',";

     }

     $keys = rtrim($keys,',');
     $values = rtrim($values,',');
     
     $sql = "insert into banner($keys) values($values)";
     // var_dump($sql);die;

     $result = sql_insert($mysqli,$sql);
     // var_dump($result);die;
     if($result){
          script_success('添加成功','index.php?mot=admin&ctl=banner&act=index');
     }else{
          script_error('添加失败');
     }

  }else{

   $array = category_tree(0,0,'&nbsp;|-','menu','menu_name','*',array(),'id','distinction=2');
    // var_dump($result);die;

    include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';

   }

}else if($_A == 'del'){

      $id = $_GET['id'];

     /* var_dump($id);die;
*/
      $sql = "delete from banner where id ={$id}";

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

       
        $data['image_name'] = $_POST['image_name'];

        $data['create_time'] = date("Y-m-d H:i:s",time());

        $data['place'] = $_POST['place'];
/*
        $data['hit'] = $_POST['hit'];

        var_dump($data['hit']);die;*/

        $data['display'] = $_POST['display'];

        $data['remarks'] = $_POST['remarks'];



        /*var_dump($data['remarks']);die;
*/


        $keys ='';

        foreach($data as $key => $value){

          $keys .=$key."='".$value."',";
        }

          $keys = rtrim($keys,',');

          $sql = "update banner set $keys where id={$id}";

          /*echo $sql;*/

          $result = sql_edit($mysqli,$sql);

          /*var_dump($result);die;
*/
          // echo 1;die;
          if($result){

            script_success('可以嘛你娃儿','index.php?mot=admin&ctl=banner&act=index');

          }else{

            script_error('跟你说你不信，拐了哇');
          }

        }else{

          $id = $_GET['id'];

         /* var_dump($id);die;*/

          $sql = "select * from banner where id = {$id}";

          /*echo $sql;die;*/

          $result = sql_sel($mysqli,$sql);

          $sql2 = "select * from menu where category_id = 0 and distinction = 2";

          $results = sql_all($mysqli,$sql2);


          /*var_dump($result);die;
*/
        include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';  

      }
    }