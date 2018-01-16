<?php

function sql_sel($mysqli,$sql,$pri=2){

	   // 查询一条数据  
	    if($pri==1){
           echo_sql($sql);
           exit('数据库语名打印');
        }
		$result  = mysqli_query($mysqli,$sql); //执业sql语句

		// var_dump($result);
        if($result){

        	return mysqli_fetch_assoc($result); //取出结果集一条数据  有数据会取出结果，没数据输出一个NULL值

        }else{

        	return false;
        }
		
}


function sql_all($mysqli,$sql){
	  //查询多条
	  $result  = mysqli_query($mysqli,$sql); //执业sql语句
    // var_dump($result);die;
	  $arr = [];
	  if($result){
	  	
	    while($row =mysqli_fetch_assoc($result)){
		      $arr[]= $row;
	    }
	  }else{
	  	      $arr = false;
	  }
	  return $arr;
}

/**
   *添加新数据
**/
function sql_insert($mysqli,$sql){

	$result = mysqli_query($mysqli,$sql);

 /* var_dump($result);*/

    if($result){
    	$row = mysqli_insert_id($mysqli);
    }else{
    	$row = false;
    }
    return $row;

}

/**
   *修改数据
   *@prama $myslqi 数据库连接
   *@prama $sql  sql语句
**/

function sql_edit($mysqli,$sql){

	$result = mysqli_query($mysqli,$sql);
    if($result){
    	return $result;
    }else{
    	return false;
    }

}
/**删除数据**/

function sql_del($mysqli,$sql){
 
	$result = mysqli_query($mysqli,$sql);
  // var_dump($result);die;
    if($result){
    	return $result;
    }else{
    	return false;
    }
}

function category_tree($pid =0,$num =0,$str = '&nbsp;|-',$table = 'menu',$file='menu_name',$filed='*', $arr=array(),$id='id',$where=''){

  static $arr;
  global $mysqli;

  $sql ="select {$filed} from {$table} where category_id={$pid}";
  if($where !=''){
     $sql .= " and $where";
  }

  $result = sql_all($mysqli,$sql);

  $num++;

  foreach ($result as $key =>$value){

   /* $value[$name]= str_repeat($str,$num).$value[$name];
*/
    $arr[] = $value;

    category_tree($value[$id],$num,$str,$table,$file,$filed,$arr,$id,$where);
  }
  return $arr;
}


/**查询语句，有数据过滤数据**/


// function sql_check($msyqli,$sql,$string,$string){
   
//     $stmt = mysqli_prepare($mysqli,$sql);
//     mysqli_stmt_bind_param($stmt,'ss',$string,$string);
//     mysqli_stmt_execute($stmt);
//     mysqli_stmt_bind_result()
// }
function insert_into($table,$data){
      global $mysqli;
      if(!is_array($data)){
          return false;
      }
      $keys = '';
      $values ='';
      foreach ($data as $key => $value) {  //key k e y  k,e,y, y,
                   $keys .= $key.',';
                   $values .= "'".$value."',";
      }
      $keys = rtrim($keys,',');
      $values = rtrim($values,',');
      $sql = "insert into $table($keys) values($values)";
              // echo $sql;
              // die;
      return sql_insert($mysqli,$sql);  //添加用用户
}

function edit_set($table,$data,$where){
      global $mysqli;
      if(!is_array($data)){
          return false;
      }
      $keys   = '';
     
      foreach ($data as $key => $value) {
        $keys   .= $key."='".$value."',";
      
      }
     
      $keys   = rtrim($keys,',');
   
     

      $sql = "update {$table} set $keys where $where";
      // echo $sql;die;
      return sql_edit($mysqli,$sql);//修改
}



function CountNum($table,$where='',$count='count',$filed='id'){
    global $mysqli;

    $sql ="select count($filed) as $count from $table";
    
    if($where != ''){
       $sql .=" where $where";
    }
     // 查询一条数据  
    
    $result  = mysqli_query($mysqli,$sql); //执业sql语句

    // var_dump($result);
        if($result){

          return mysqli_fetch_assoc($result); //取出结果集一条数据  有数据会取出结果，没数据输出一个NULL值

        }else{

          return false;
        }
    
}


function sql_list($table,$where='',$order='',$limit='',$filed='*'){
    //查询多条
    global $mysqli;

    $sql ="select $filed from $table";
    
    if($where != ''){
       $sql .=" where $where";
    }

    $sql .= $order != ''? " order by $order"  :'';
    $sql .= $limit != ''? " limit $limit"  :'';


    $result  = mysqli_query($mysqli,$sql); //执业sql语句

    $arr = [];
    if($result){
      
      while($row =mysqli_fetch_assoc($result)){
          $arr[]= $row;
      }
    }else{
            $arr = false;
    }
    return $arr;
}