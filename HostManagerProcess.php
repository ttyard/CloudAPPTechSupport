<?php

include 'include/db_mysql.class.php';
include 'include/config.inc.php';


@ $DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error);
}

$Action=$_GET['action'];
$GetHostID=$_GET['hid'];
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
	     if ($isINSERT==1) {
	     	header("Location:Host.php");
	     } else {
	     	echo "<br/>"."新增主机失败";
	     }		
		break;
		
	case Edit:
		//$HostName=trim($_POST['HostName']);
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
		$Responsiblepeople=trim($_POST['Responsiblepeople']);
		//$StartTime=trim($_POST['StartTime']);
		//$EndTime=trim($_POST['EndTime']);
		$StartTime=$_POST['StartTime'];
		$EndTime=$_POST['EndTime'];
		$OpenFlag=$_POST['OpenFlag'];
		$HostType=trim($_POST['HostType']);
		$IDC=trim($_POST['IDC']);
		$EX1=htmlspecialchars($_POST['EX1']);
		$EX1= mysql_escape_string($EX1);

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
			$EX1= addslashes($EX1);
		}
// 		$HostUpdateSQL=sprintf("UPDATE  `cloudhost_information` SET `customerID`='%d',`IP`='%s',`OS`='%s',`CPU`='%d',`RAM`='%d',`HDD`='%d',`BW`='%d',`DB`='%s',`FTP`='%s',
// 									`ApplyUser`='%d',`Responsiblepeople`='%d',`StartTime`='%s',`EndTime`='%s',`OpenFlag`='%d',`HostType`='%s',`IDC`='%s' WHERE `hid`='%s'",
// 				$CustomerID,$IP,$OS,$CPU,$RAM,$HDD,$BW,$DB,$FTP,$ApplyUser,$Responsiblepeople,$StartTime,$EndTime,$OpenFlag,$HostType,$IDC,$GetHostID);
		
		$HostUpdateSQL=sprintf("UPDATE  `cloudhost_information` SET `customerID`='%d',`IP`='%s',`OS`='%s',`CPU`='%d',`RAM`='%d',`HDD`='%d',`BW`='%d',`DB`='%s',`FTP`='%s',
									`ApplyUser`='%d',`Responsiblepeople`='%d',`StartTime`='%s',`EndTime`='%s',`OpenFlag`='%d',`HostType`='%s',`IDC`='%s',`EX1`='%s' WHERE `hid`='%s'",
									$CustomerID,$IP,$OS,$CPU,$RAM,$HDD,$BW,$DB,$FTP,$ApplyUser,$Responsiblepeople,$StartTime,$EndTime,$OpenFlag,$HostType,$IDC,$EX1,$GetHostID);
		
		$isUpdate=$DBLINK->query($HostUpdateSQL);
		
  	     if (!$isINSERT==1) {
	     	header("Location:Host.php");
  	     } else {
  	     	echo "<br/>"."云主机信息更新失败！请联系管理员，谢谢。".mysql_error()."\n".mysql_errno();
  	     }	
	     break;
	     
	case Delete:
		$hid=trim($GetHostID);
		$hid=addslashes($GetHostID);
		$DeleteSQL=sprintf("UPDATE `cloudhost_information` set `isDelete`='1' WHERE `hid`='%d'",$hid);
		$DeleteQuery=$DBLINK->query($DeleteSQL);
		if (!$DeleteQuery==1) {
			header("Location:Host.php?isDelete=success");
		} else 
		{
			echo "<br/>"."云主机删除失败！请联系管理员，谢谢。";
		}
 		
		break;
	}



?>