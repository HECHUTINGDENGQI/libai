<?php
// header("Content-Type: text/html; charset=utf-8");
if(empty($_SESSION['username'])){

	echo "<script>alert('非法登录，请到登录页');window.location.href='index.php?mot=admin&ctl=login';</script>";
}
//遍历左边导航栏
/*if($_A=='index'){

	$sql= "select * from menu where display =1 and distinction=1 and category_id=0 order by place asc";
    // echo $sql;die;
	$result = sql_all($mysqli,$sql);
    // print_r($result);die;
	foreach ($result as $key => $value){

		if(is_array($value)){

			var_dump($value['id']);

			$sql2 = "select * from menu where display=1 and disinction=1

			and category_id={$value['id']} order by place asc";

			$result[$key]['next'] = sql_all($mysqli,$sql2);


		}
	}

		// print_r($result);die;

	include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';



}  
*/

//遍历左边导航栏
if($_A=='index'){

     $sql = "select * from menu where display=1 and distinction=1 and category_id=0  order by place asc";
     $result = sql_all($mysqli,$sql);
    /* var_dump($result);die;*/

     foreach ($result as $Key => $value) {
     	
              $sql2 = "select * from menu where display=1 and distinction=1

              and category_id={$value['id']} order by place asc";


             $r = sql_all($mysqli,$sql2);
             // var_dump($r);die;
             $arr ='';
           if(is_array($value)){
	             foreach  ($r as $k=> $v) {

	             	 /*$result[$key]['next'] = sql_all($mysqli,$sql2);*/

	            	 $r[$k]['urls']  = "index.php?mot=admin&ctl={$v['controller']}&act={$v['action']}";

	            	 /*var_dump($r[$k]['urls']);die;*/
	             }
            

             

             /*var_dump($result[$key]['url']);die;*/
          }
          $result[$Key]['next'] = $r;


     }
    /* var_dump($result);die;*/

    include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';

}else if($_A == 'welcome'){

  $sql = "select count(id) as count from news where 1";

       $count =sql_sel($mysqli,$sql);

	include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';

}else if($_A == 'selects'){

   $id = $_POST['id'];

   if($id){

    $sql = "select * from category where category_id = {$id}";

    $result = sql_all($mysqli,$sql);

    $selects = '';

    if($result){

    $selects .= '<div class="formControls col-xs-8 col-sm-2"><span class="select-box"><select class="select" size="1" name="cate_id" > <option value="">请选择分类</option>';

      for ($i=0; $i < count($result); $i++){
        $selects .=  '<option value="'.$result[$i]['id'] .'">'.$result[$i]['cate_name'].'</option>';
      }

      /*for($i=0; $i <count($result); $i++){

        $selects .= '<option vallue="'.$result[$i]['cid'] .'">'.$result[$i]['cate_name'].'</option>';

      }*/
    $selects .='<select></span></div>';
    echo $selects;
    exit();

    }

   }

}



else if($_A=='logout'){
	$_SESSION=array();

	@session_destroy($_SESSION['username']);

	echo "<script> alert('退出成功');window.location.href='index.php?mot=admin&ctl=login';</script>";

	exit;



}