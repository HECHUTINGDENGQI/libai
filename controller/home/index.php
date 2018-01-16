<?php

$sql = "select * from banner where category_id = 312";

$image = sql_all($mysqli,$sql);

$sql1 = "select * from about order by id desc limit 1";

$result1 = sql_all($mysqli,$sql1);

$sql2 = "select * from goods order by id desc limit 4";


$arr2 = sql_all($mysqli,$sql2);

// var_dump($result2);die;

$sql3 = "select image from news order by id desc limit 1";


$result3 = sql_all($mysqli,$sql3);


$sql4 = "select content from news order by id desc limit 3";


$result4 = sql_all($mysqli,$sql4);


$sql5 = "select * from contact where 1";


$result5 = sql_all($mysqli,$sql5);


if($_A == 'index'){

  if($_POST){
 
    $data['phone'] = $_POST['phone'];

    $data['email'] = $_POST['email'];

    $data['name'] = $_POST['name'];

    
   
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

        script_success('提交成功','index.php?mot=home&ctl=index&act=index');

      }else{

        script_error('提交失败');

        }

      }
    }














require_once "common.php";

