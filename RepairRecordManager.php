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

//当前日期
$NowDateTime=Date("Y-m-d H:i:s");

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

		//获取报修主机ID
		$GetHidSQL=sprintf("SELECT `hid` FROM `cloudhost_information` WHERE `customerID`='%d' AND `IP`='%s'",$CustomerID,$IP);
		$GetHidResult=$DBLINK->query($GetHidSQL);
		$GetHid=$GetHidResult->fetch_array(MYSQL_ASSOC);
		$hid=$GetHid['hid'];
		
		//生成故障处理表 编号`customerequestrecord` crid
		$cridSQL="SELECT `crid` FROM `customerequestrecord` ORDER BY `crid` DESC LIMIT 1";
		$cridResult=$DBLINK->query($cridSQL);
		$cridOld=$cridResult->fetch_array(MYSQL_ASSOC);
   		(int) $crid=$cridOld['crid']+1;

		//生成故障处理流程表 编号`requestprocess` rpid
		$rpidSQL="SELECT `rpid` FROM `requestprocess` ORDER BY `rpid` DESC LIMIT 1";
		$rpidResult=$DBLINK->query($rpidSQL);
		$rpidOld=$rpidResult->fetch_array(MYSQL_ASSOC);
		$rpid=$rpidOld['rpid']+1;

		//生成故障报修工单		
		$RepairAddSQL=sprintf("INSERT INTO `customerequestrecord` (`crid`,`cid`,`requestime`,`uid`,`description`,`state`,`reason`,`IP`,`hid`,`qid`,`rpid`,`completetime`) 
														   value('%s','%d','%s','%d','%s','%s','%s','%s','%d','%d','%d','%s')",
															$crid,$CustomerID,$RequestTime,$Responsiblepeople,$description,$RequestRecordState,$reason,$IP,$hid,$QuestionCategory,$rpid,$completetime);
		
		$requestprocessSQL=sprintf("INSERT INTO `requestprocess` (`rpid`,`crid`,`uid`,`AcceptTime`,`QuestionDescription`,`ProcessingMethod`)  value('%d','%d','%d','%s','%s','%s')",$rpid,$crid,$Responsiblepeople,$NowDateTime,$description,$ProcessingMethod);

		$isINSERT=$DBLINK->query($RepairAddSQL);
		$isINSERT2=$DBLINK->query($requestprocessSQL);
		
	     if (!$isINSERT && !$isINSERT2) {	     	
	     	echo "<br/>"."生成报修工单失败!".mysql_error()."\n".mysql_errno();
	     } else {
	     	header("Location:RepairsRecord.php");
	     }		
		break;
		
	case Update:

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
		
		
		//获取故障处理表 编号`customerequestrecord` crid
		$crid=$_POST['crid'];
		
		// 检测故障处理流程表 是否存在`requestprocess` rpid
		$rpidSQL=sprintf("SELECT `rpid` FROM `requestprocess` WHERE `crid`='%s' ORDER BY `crid` DESC LIMIT 1",$crid);
		$rpidResult=$DBLINK->query($rpidSQL);
		$DBRPID=$rpidResult->fetch_array(MYSQL_ASSOC);
 		$issetRPID=$DBRPID['rpid'];
		$rpidResult->free();
 
		//更新故障报修工单
		if ( $issetRPID==NULL or $issetRPID=='0') {
			
			//生成故障处理流程表 编号`requestprocess` rpid
			$rpidSQL="SELECT `rpid` FROM `requestprocess` ORDER BY `rpid` DESC LIMIT 1";
			$rpidResult=$DBLINK->query($rpidSQL);
			$rpidOld=$rpidResult->fetch_array(MYSQL_ASSOC);
			$rpid=$rpidOld['rpid']+1;
			
			$requestprocessSQL=sprintf("INSERT INTO `requestprocess` (`rpid`,`crid`,`uid`,`AcceptTime`,`QuestionDescription`,`ProcessingMethod`)  
												value('%d','%d','%d','%s','%s','%s')",$rpid,$crid,$Responsiblepeople,$NowDateTime,$description,$ProcessingMethod);
			
			$RepairUpdateSQL=sprintf("UPDATE `customerequestrecord` SET `description`='%s',`state`='%s',`reason`='%s',`qid`='%s',`completetime`='%s',`rpid`='%s' WHERE `crid`='%d' ",
					$description,$RequestRecordState,$reason,$QuestionCategory,$completetime,$rpid,$crid);
			
			$isUpdate1=$DBLINK->query($RepairUpdateSQL);
 			$isUpdate2=$DBLINK->query($requestprocessSQL);
 			
 			if (!$isUpdate1 and !$isUpdate2) {
 				$ErrorMSG="故障报修工单更新失败，请联系管理员，谢谢。";
 				header("Location:RepairsRecord.php?SYSMSG=$ErrorMSG");
 			} else {
 				$MSG="故障报修工单更新成功。";
 				header("Location:RepairsRecord.php?SYSMSG=$MSG");
 				
 			}			
		} else {
			$RepairUpdateSQL=sprintf("UPDATE `customerequestrecord` SET `description`='%s',`state`='%s',`reason`='%s',`qid`='%s',`completetime`='%s' WHERE `crid`='%d' ",
					$description,$RequestRecordState,$reason,$QuestionCategory,$completetime,$crid);
						
			$requestprocessSQL=sprintf("UPDATE `requestprocess` SET `QuestionDescription`='%s',`ProcessingMethod`='%s',`AcceptTime`='%s' WHERE `rpid`='%s' AND `crid`='%s'",
											$description,$ProcessingMethod,$NowDateTime,$issetRPID,$crid);
			
			$isUpdate1=$DBLINK->query($RepairUpdateSQL);
			$isUpdate2=$DBLINK->query($requestprocessSQL);
			
			if (!$isUpdate1 and !$isUpdate2) {
	 				$ErrorMSG="故障报修工单更新失败，请联系管理员，谢谢。";
	 				header("Location:RepairsRecord.php?SYSMSG=$ErrorMSG");
	 			} else {
	 				$MSG="故障报修工单更新成功。";
	 				header("Location:RepairsRecord.php?SYSMSG=$MSG");
	 				
	 			}
		}		
	     break;	   
	}

?>