<?php

include 'include/db_mysql.class.php';
include 'include/config.inc.php';


@ $DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error);
}

$Action=$_GET['action'];

switch ($Action){
	case Add:
		
		$HostName=trim($_POST['HostName']);
		$CustomerID=trim($_POST['CustomerID']);
		$IP=trim($_POST['IP']);
		$OS=trim($_POST['OS']);
		$CPU=trim($_POST['CPU']);
		$RAM=trim($_POST['RAM']);
		$HDD=trim($_POST['HDD']);
		$BW=trim($_POST['BW']);
		$DB=trim($_POST['DB']);
		$FTP=trim($_POST['FTP']);
		$ApplyUser=trim($_POST['ApplyUser']);
		//$StartTime=trim($_POST['StartTime']);
		//$EndTime=trim($_POST['EndTime']);
		$StartTime=$_POST['StartTime'];
		$EndTime=$_POST['EndTime'];
		$OpenFlag=$_POST['OpenFlag'];
		$HostType=trim($_POST['HostType']);
		$IDC=trim($_POST['IDC']);
		$Responsiblepeople=trim($_POST['Responsiblepeople']);
		
		if (!get_magic_quotes_gpc()) {
			$HostName=addslashes($HostName);
			$CustomerID=addslashes($CustomerID);
			$IP=addslashes($IP);
			$OS=addslashes($OS);
			$CPU=addslashes($CPU);
			$RAM=addslashes($RAM);
			$HDD=addslashes($HDD);
			$BW=addslashes($BW);
			$DB=addslashes($DB);
			$FTP=addslashes($FTP);
			$ApplyUser=addslashes($ApplyUser);
			//$StartTime=addslashes($uid);
			//$EndTime=addslashes($EndTime);
			$OpenFlag=addslashes($OpenFlag);
			$HostType=addslashes($HostType);
			$IDC=addslashes($IDC);
			$Responsiblepeople=addslashes($Responsiblepeople);
		}
		//生成HID
		$HidSQL="SELECT `hid` FROM `cloudhost_information` ORDER BY `hid` DESC LIMIT 1";
		$HidResult=$DBLINK->query($HidSQL);
		$HidOld=$HidResult->fetch_array(MYSQL_ASSOC);
		$Hid=$HidOld['hid']+1;	
		
		$HostAddSQL=sprintf("INSERT INTO `cloudhost_information` (`hid`,`HostName`,`customerID`,`IP`,`OS`,`CPU`,`RAM`,`HDD`,`BW`,`DB`,`FTP`,
									`ApplyUser`,`Responsiblepeople`,`StartTime`,`EndTime`,`OpenFlag`,`HostType`,`IDC`) value('%d','%s','%s','%s','%s','%s','%s','%s','%s','%s'
									,'%s','%s','%s','%s','%s','%s','%s','%s')",$Hid,$HostName,$CustomerID,$IP,$OS,$CPU,$RAM,$HDD,$BW,$DB,$FTP,$ApplyUser,$Responsiblepeople,$StartTime
									,$EndTime,$OpenFlag,$HostType,$IDC);
		
		$isINSERT=$DBLINK->query($HostAddSQL);
	     if ($isINSERT==FALSE)
	     	echo "新增主机失败";
		
		header("Location:Host.php");
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
		
// 		header("Location:user.php");
		break;
			
	case Delete:
		$uid=trim($_POST['uid']);
		$uid=addslashes($uid);
		$DeleteSQL=sprintf("UPDATE `user` set `EX1`='FALSE' WHERE `uid`='%s'",$uid);
		$DeleteQuery=$DBLINK->query($DeleteSQL);
		
// 		header("Location:user.php");
		break;
	}



?>