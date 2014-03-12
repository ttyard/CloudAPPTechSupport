<?php 
//	include('include/header.php');
	include 'include/db_mysql.class.php';
	include 'include/config.inc.php';	
	
	$DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
	$DBLINK->set_charset(DBCHARSET);
	
	if (!$DBLINK) {
		die("数据库连接失败！".$DBLINK->connect_error);
	}
	
$CRID=$_GET['crid'];
//获取用户报修工单列表
$RequestRecordListSQL=sprintf("SELECT `crid`,`cid`,`requestime`,`uid`,`description`,`state`,`reason`,`IP`,`hid`,`qid`,`rpid`,`completetime` 
									  FROM `customerequestrecord` WHERE `crid`='%s'",$CRID);	
$RequestRecordListResult=$DBLINK->query($RequestRecordListSQL);
$RRLR=$RequestRecordListResult->fetch_array(MYSQL_ASSOC);


$RequestProcessListSQL=sprintf("SELECT `ProcessingMethod` FROM `requestprocess` WHERE `crid`='%s'",$CRID);
$RequestProcessListResult=$DBLINK->query($RequestProcessListSQL);
$RPLR=$RequestProcessListResult->fetch_array(MYSQL_ASSOC);



//客户信息
$CustomerInfoSQL="SELECT cid,customer_name FROM `customerbaseinformation`";
$CustomerInfoResult=$DBLINK->query($CustomerInfoSQL);


//主机申请人信息  ResponsiblePeople
$ApplyUserSQL="SELECT uid,Name FROM `user` WHERE isTech='0'";
$ApplyUserResult=$DBLINK->query($ApplyUserSQL);

//主机开通人信息  
$ResponsiblePeopleSQL="SELECT uid,Name FROM `user` WHERE isTech='1'";
$ResponsiblePeopleResult=$DBLINK->query($ResponsiblePeopleSQL);
	
//故障问题分类
$QuestionCategorySQL="SELECT qid,QDescription FROM `questioncategory`";
$ResultQuestionCategory=$DBLINK->query($QuestionCategorySQL);

//定义时期和时间 试用一般为0.5小时
$completeTimeCycle=time() + (0.5 * 60 * 60);


?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>	
	<meta charset="utf-8">
	<title>云应用技术支持统计系统</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Muhammad Usman">

	<!-- The styles -->
	<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	  .textareaRP {width:250px;}
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/charisma-app.css" rel="stylesheet">
	<link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='css/fullcalendar.css' rel='stylesheet'>
	<link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='css/chosen.css' rel='stylesheet'>
	<link href='css/uniform.default.css' rel='stylesheet'>
	<link href='css/colorbox.css' rel='stylesheet'>
	<link href='css/jquery.cleditor.css' rel='stylesheet'>
	<link href='css/jquery.noty.css' rel='stylesheet'>
	<link href='css/noty_theme_default.css' rel='stylesheet'>
	<link href='css/elfinder.min.css' rel='stylesheet'>
	<link href='css/elfinder.theme.css' rel='stylesheet'>
	<link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='css/opa-icons.css' rel='stylesheet'>
	<link href='css/uploadify.css' rel='stylesheet'>
	<link href='css/jquery.datetimepicker.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>

<?php 
//载入左导航菜单
include 'include/LeftMenu.php';
?>
<div>
	<ul class="breadcrumb">
		<li>
			<a href="index.php">首页</a><span class="divider">/</span> 
		</li>
		<li>
			<a href="repairsrecord.php">客户报修</a>
		</li>
	</ul>
</div>

<div class="row-fluid sortable">
	<div class="box span6">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>报修记录</h2>
			<div class="box-icon">
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="RepairRecordManager.php?action=Update">
				<fieldset>
				  <input type="hidden" name="crid" value="<?php echo $CRID;?>" /> 
				  <div class="control-group">
						<label class="control-label" for="selectError">客户名称</label>
						<div class="controls">
						<select id="selectError" data-rel="chosen" name="CustomerID" style="width: 220px; " disabled="disabled">
						<?php 
						while ($CustomerROW=$CustomerInfoResult->fetch_array(MYSQL_ASSOC)) {
							if ($CustomerROW['cid']==$RRLR['cid']) {
								printf("<option value=\"%d\" selected=\"selected\">%s</option>",$CustomerROW['cid'],$CustomerROW['customer_name']);;
							} else {
								printf("<option value=\"%d\">%s</option>",$CustomerROW['cid'],$CustomerROW['customer_name']);;
							}
							 
						}
						?>
						</select>
						</div>
				  </div>
				  
				   <div class="control-group">
						<label class="control-label" for="appendedPrependedInput" >IP</label>
						<div class="controls">
						  <div class="input-prepend input-append">
								<input id="appendedPrependedInput" size="16" type="text" Name="IP" value="<?php echo $RRLR['IP'];?>" disabled="disabled"><span class="add-on">IPv4</span>
						  </div>
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="selectError">受理人</label>
						<div class="controls">
						<select id="Responsiblepeople" data-rel="chosen" name="Responsiblepeople"  style="width: 110px;" disabled="disabled" >
						<?php 
						while ($RPROW=$ResponsiblePeopleResult->fetch_array(MYSQL_ASSOC)) {
							
							if ($RPROW['uid']==$RRLR['uid']) {
								printf("<option value=\"%d\" selected=\"selected\">%s</option>",$RPROW['uid'],$RPROW['Name']);
							} else {
								printf("<option value=\"%d\">%s</option>",$RPROW['uid'],$RPROW['Name']); 
							}
						}
						?>
						</select>
						</div>
				  </div>
				  
		  		  <div class="control-group">
					  <label class="control-label" for="date01">受理时间</label>
					  <div class="controls">
						<input type="text" id="datetimepicker" value="<?php echo $RRLR['requestime'];?>" name="RequestTime" disabled="disabled">
					  </div>
				  </div>
				  
				   <div class="control-group">
						<label class="control-label" for="selectError">故障分类</label>
						<div class="controls">
						<select id="QuestionCategory" data-rel="chosen" name="QuestionCategory"  style="width: 110px;">
						<?php 
						while ($RQROW=$ResultQuestionCategory->fetch_array(MYSQL_ASSOC)) {
							if ($RQROW['qid']==$RRLR['qid']) {
								printf("<option value=\"%d\" selected=\"selected\">%s</option>",$RQROW['qid'],$RQROW['QDescription']);
							} else {
								printf("<option value=\"%d\">%s</option>",$RQROW['qid'],$RQROW['QDescription']);
							}

						}
						?>
						</select>
						</div>
				  </div>
				  
  				  <div class="control-group">
					  <label class="control-label" for="textarea2">故障描述</label>
					  <div class="controls">
						<textarea  class="autogrow textareaRP" id="description" rows="2" name="description" style="height:90px;"><?php echo $RRLR['description']?></textarea>
					  </div>
				  </div>
				  
				  <div class="control-group">
					  <label class="control-label" for="textarea2">故障原因</label>
					  <div class="controls">
						<textarea  class="autogrow textareaRP" id="reason"" rows="2" name="reason" style="height:90px;"><?php echo $RRLR['reason']?></textarea>
					  </div>
				  </div>
				  
				 <div class="control-group">
						<label class="control-label" for="selectError">主机状态</label>
						<div class="controls">
						<select id="selectError6" data-rel="chosen" name="RequestRecordState" style="width: 110px;">
						<?php 
							for ($i = 0; $i < count($RequestRecordState); $i++) {
								if($RequestRecordState[$i]==$RRLR['state']) {
									echo "<option value=\"$RequestRecordState[$i]\" selected=\"selected\">$RequestRecordState[$i]</option>";
								} else {
									echo "<option value=\"$RequestRecordState[$i]\">$RequestRecordState[$i]</option>";
								}
							}
						?>
						</select>
						</div>
				  </div>
				  
				  <div class="control-group">
					  <label class="control-label" for="date01">完成时间</label>
					  <div class="controls">
						<input type="text" id="CompleteTime" value="<?php  echo $RRLR['completetime'];?>" name="completetime">
					  </div>
				  </div>
				  
				  <div class="control-group">
					  <label class="control-label" for="textarea2">处理方法</label>
					  <div class="controls">
						<textarea  class="autogrow textareaRP" id="ProcessingMethod"" rows="2" name="ProcessingMethod" style="height:90px;"><?php echo $RPLR['ProcessingMethod'];?></textarea>
					  </div>
				  </div>
					
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">提交问题</button>
					<button class="btn">取消</button>
				  </div>
				</fieldset>
			  </form>					
		</div>
	</div><!--/span-->			
</div><!--/row-->
<?php 
//include 'footer.php';
?>
<script>

$('#datetimepicker').datetimepicker({
	format:'Y-m-d H:i',
	step:10
});
$('#CompleteTime').datetimepicker({
	format:'Y-m-d H:i',
	step:10
});
</script>			
			
<?php 
$CustomerInfoResult->free();
$ResponsiblePeopleResult->free();
$DBLINK->close();

include('footer.php');
 
?>			