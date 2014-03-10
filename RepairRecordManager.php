<?php

include 'include/db_mysql.class.php';
include 'include/config.inc.php';


@ $DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error);
}

$Action=$_GET['action'];

//定义时期和时间 试用一般为0.5小时
$EndTimecycle=time() + (0.5 * 60 * 60);
print_r($_POST);
echo "<br/>";

switch ($Action){  
	case Add:
		$CustomerID=trim($_POST['CustomerID']);
		$IP=trim($_POST['IP']);
		$Responsiblepeople=trim($_POST['Responsiblepeople']);
		$RequestTime=trim($_POST['RequestTime']);
		$QuestionCategory=trim($_POST['QuestionCategory']); 
		$description=trim($_POST['description']);
		$reason=trim($_POST['reason']);
		$completetime=trim($_POST['completetime']);
		$ProcessingMethod=trim($_POST['ProcessingMethod']);
		$RequestRecordState=trim($_POST['RequestRecordState']);
		
		if (!get_magic_quotes_gpc()) {
			$CustomerID=addslashes($CustomerID);
			$IP=addslashes($IP);
			$Responsiblepeople=addslashes($Responsiblepeople);
			$RequestTime=addslashes($RequestTime);			
			$QuestionCategory=addslashes($QuestionCategory);
			$description=addslashes($description);
			$reason=addslashes($reason);
			$completetime=addslashes($completetime);
			$qid=addslashes($qid);
			$ProcessingMethod=addslashes($ProcessingMethod);
			$RequestRecordState=addslashes($RequestRecordState);
		}
				
		
		//生成故障处理表 编号`customerequestrecord` crid
		$cridSQL="SELECT `crid` FROM `customerequestrecord` ORDER BY `crid` DESC LIMIT 1";
		$cridResult=$DBLINK->query($cridSQL);
		$cridOld=$cridResult->fetch_array(MYSQL_ASSOC);
		$crid=$cridOld['crid']+1;
// echo '$crid='.$crid."<br/>";

		//生成故障处理流程表 编号`requestprocess` rpid
		$rpidSQL="SELECT `rpid` FROM `requestprocess` ORDER BY `rpid` DESC LIMIT 1";
		$rpidResult=$DBLINK->query($rpidSQL);
		$rpidOld=$rpidResult->fetch_array(MYSQL_ASSOC);
		$rpid=$rpidOld['rpid']+1;
// 		echo '$rpid='.$rpid."<br/>";
		

		//生成故障报修工单		
		echo $RepairAddSQL=sprintf("INSERT INTO `customerequestrecord` (`crid`,`cid`,`requestime`,`uid`,`description`,`state`,`reason`,`IP`,`qid`,`rpid`,`completetime`) 
														   value('%s','%d','%s','%d','%s','%s','%s','%s','%d','%d','%s')",
															$crid,$CustomerID,$RequestTime,$Responsiblepeople,$description,$RequestRecordState,$reason,$IP,$QuestionCategory,$rpid,$completetime);

		$requestprocessSQL=sprintf("INSERT INTO `requestprocess` (`rpid`,`crid`,`uid`,`QuestionDescription`,`ProcessingMethod`)  value('%d','%d','%d','%s','%s')",$rpid,$crid,$CustomerID,$description,$ProcessingMethod);

		$isINSERT=$DBLINK->query($RepairAddSQL);
		$isINSERT2=$DBLINK->query($requestprocessSQL);
	
		
	     if (($isINSERT==1) and ($isINSERT2==1)) {
	     	header("Location:repairsrecord.php");

	     } else {
	     	echo "<br/>"."生成报修工单失败!".mysql_error()."\n".mysql_errno();
	     }		
		break;
		
	case Edit:
			
		$HostUpdateSQL=sprintf("UPDATE  `cloudhost_information` SET `customerID`='%d',`IP`='%s',`OS`='%s',`CPU`='%d',`RAM`='%d',`HDD`='%d',`BW`='%d',`DB`='%s',`FTP`='%s',
									`ApplyUser`='%d',`Responsiblepeople`='%d',`StartTime`='%s',`EndTime`='%s',`OpenFlag`='%d',`HostType`='%s',`IDC`='%s',`EX1`='%s' WHERE `hid`='%s'",
									$CustomerID,$IP,$OS,$CPU,$RAM,$HDD,$BW,$DB,$FTP,$ApplyUser,$Responsiblepeople,$StartTime,$EndTime,$OpenFlag,$HostType,$IDC,$EX1,$GetHostID);
		
		$isUpdate=$DBLINK->query($HostUpdateSQL);
// 	     if ($isINSERT==1) {
	     	header("Location:Host.php");
// 	     } else {
// 	     	echo "<br/>"."云主机信息更新失败！请联系管理员，谢谢。".mysql_error($isUpdate);
// 	     }	
	     break;
	     
	case Delete:
		$hid=trim($GetHostID);
		$hid=addslashes($GetHostID);
		$DeleteSQL=sprintf("UPDATE `cloudhost_information` set `isDelete`='1' WHERE `hid`='%d'",$hid);
		$DeleteQuery=$DBLINK->query($DeleteSQL);
		if ($DeleteQuery==1) {
			header("Location:Host.php?isDelete=success");
		} else 
		{
			echo "<br/>"."云主机删除失败！请联系管理员，谢谢。";
		}
 		
		break;
	}



?>