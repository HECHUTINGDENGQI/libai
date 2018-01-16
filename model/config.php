<?php 
//连接数据库
function db(){

	global $mysqli;

	$mysqli = @mysqli_connect(DBHOST,DBUSER,DBPASSWORD

		,DBNAME);//数据库连接

	mysqli_set_charset($mysqli,CHARSET);//设置编码

	if(mysqli_connect_error()){
		//判断数据库是否连接，失败后报错信息
		echo'数据库连接不上：'.mysqli_connect_error();

	}

}
/*function db2(){

	global $mysqlis;

	$mysqlis = @mysqli_connect(DBHOST,DBUSER,DBPASSWORD

		,DBNAME2);//数据库连接

	mysqli_set_charset($mysqlis,CHARSET);//设置编码

	if(mysqli_connect_error()){
		//判断数据库是否连接，失败后报错信息
		echo'数据库连接不上：'.mysqli_connect_error();

	}

}*/