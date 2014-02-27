<?php

include 'include/db_mysql.class.php';
include 'include/config.inc.php';


@ $DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error);
}

$Action=$_POST['action'];

switch ($Action){
	case Add:
		$username=trim($_POST['username']);
		$Name=trim($_POST['Name']);
		$Telephone=trim($_POST['Telephone']);
		$Mobilephone=trim($_POST['Mobilephone']);
		$Address=trim($_POST['Address']);
		$Type=trim($_POST['Type']);
		$uid=trim($_POST['uid']);
		
		if (!get_magic_quotes_gpc()) {
			$username=addslashes($username);
			$Name=addslashes($Name);
			$Telephone=addslashes($Telephone);
			$Mobilephone=addslashes($Mobilephone);
			$Address=addslashes($Address);
			$Type=addslashes($Type);
			$uid=addslashes($uid);
		}
		
		$GetUser=sprintf("SELECT COUNT(*) WHERE (`username`='%s') or (`Name`='%s') or (`Telephone`='%s') or (`Mobilephone`='%s')",
				                 $username,$Name,$Telephone,$Mobilephone);
		$exist=$DBLINK->query($GetUser);
		if ($exist=0) {
			$ADDSQL=sprintf("INSERT INTO `user` (`username`,`Name`,`Telephone`,`Mobilephone`,`Address`,`Type`) value(%s,%s,%s,%s)",
                                               $username,$Name,$Telephone,$Mobilephone,$Address,$Type);
			$ADDQuery=$DBLINK->query($ADDSQL);
			
			if ($ADDQuery=FALSE)
				echo "系统用户新增失败，请检查输入数据，谢谢。";
			
			header("Location:user.php");
			
			
		} else {
			
			echo "该用户已存在！";
			
			header("Location:user.php");			
			
		}
		break;
		
	case Edit:
		$Name=trim($_POST['Name']);
		$Telephone=trim($_POST['Telephone']);
		$Mobilephone=trim($_POST['Mobilephone']);
		$Address=trim($_POST['Address']);
		$Type=trim($_POST['Type']);
		$uid=trim($_POST['uid']);
		
	    if (!get_magic_quotes_gpc()) {
	    	$Name=addslashes($Name);
	    	$Telephone=addslashes($Telephone);
	    	$Mobilephone=addslashes($Mobilephone);
	    	$Address=addslashes($Address);
	    	$Type=addslashes($Type);
	    	$uid=addslashes($uid);
	    }
		
		$UserEditSQL=sprintf("UPDATE `user` set `Name`='%s',`Telephone`='%s',`Mobilephone`='%s',`Address`='%s',`Type`='%s' WHERE `uid`='%s'"
		                          ,$Name,$Telephone,$Mobilephone,$Address,$Type,$uid);
		$UpdateUserInfo=$DBLINK->query($UserEditSQL);
		
		header("Location:user.php");
		break;
			
	case Delete:
		$uid=trim($_POST['uid']);
		$uid=addslashes($uid);
		$DeleteSQL=sprintf("UPDATE `user` set `EX1`='FALSE' WHERE `uid`='%s'",$uid);
		$DeleteQuery=$DBLINK->query($DeleteSQL);
		
		header("Location:user.php");
		break;
	}



?>