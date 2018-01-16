<?php

 $sql = "select * from banner where category_id = 330";

 $image = sql_all($mysqli,$sql);


if($_A == 'index'){

  if($_POST){
 
    $data['phone'] = $_POST['phone'];

    /*var_dump( $_POST['category_id']);die;*/
    $data['email'] = $_POST['email'];

    $data['message'] = $_POST['message'];

    $data['fax'] = $_POST['fax'];

    $data['name'] = $_POST['name'];

    $data['address'] = $_POST['address'];

   
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
      $sql = "insert into message($keys) values($values)";

      /*var_dump($sql);*/

      $result = sql_insert($mysqli,$sql);

      /*var_dump($result);die;*/

      if($result){

        script_success('提交成功','index.php?mot=home&ctl=contact&act=index');

      }else{

        script_error('提交失败');

        }

      }
    }

else if($_A == 'code'){
  
   header("content-type:text/html;charset=utf-8");

    // include "model/code.php";

    vcode();

}

 
  require_once 'common.php';







