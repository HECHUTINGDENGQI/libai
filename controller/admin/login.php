<?php




if($_A =='index'){

    if($_POST){

    	if($_POST['code'] == ''){

    		script_error('验证码不能为空');
    	}else if(strtolower($_POST['code']) !=$_SESSION['vcode']){

    		script_error('验证码不正确');
    	}

    	$username = $_POST['username'];

    	/*if(!preg_match('/^[a-zA-z][a-zA-Z0-9_]{4,15}$/',$username)){
    		script_error('命名要以字母开头，5-16字符，可以是字母或者数字或者_');
    	}*/

	    $password = MD5($_POST['password']);

	    $check = empty($_POST['online'])?'':$_POST['online'];//记住是否选中我们

		$sql = "select * from libai where username='{$username}' and password='{$password}'";

		$result = sql_sel($mysqli,$sql);

		// var_dump($result);die;
		
		if($result){

            /*if($result['id'] !=1){

                $sql="select * from user_role inner join role_level on user_role.role_id=role_menu_id where user_role.user_id={$result['id']}";

                $_SESSION['level'] = sql_all($mysqli,$sql);
            }
*/








            

             $_SESSION['username'] = $_POST['username'];

           /*  $_SESSION['uid']   = $result['id'];*/



             /*var_dump($_SESSION['username']);*///记住用户名做登录验证权限

             if($check == 1){   //判断有选中记住checkbox复选框

             	setcookie('username',$username,time()+3600);//记住用户名

             	setcookie('password',$password,time()+3600);//记住密码

 			}else{

 				setcookie('username','',time()-3600);//删除用户名

 				setcookie('password',null,time()-3600);//删除密码

 			}

	         script_success('欢迎来到多迪江湖','index.php?mot=admin&ctl=index');
		}else{
	         script_error('你的信息不正确，请重新登录');
		}
    }else{
    	include  VIEW.$_M.'/'.$_C.'/'.$_A.'.html';
    }
   
	

    }
else if($_A == 'code'){


    include "code.php";

    vcode();

}


/*if($result){

             $_SESSION['username'] = $_POST['username'];*/
