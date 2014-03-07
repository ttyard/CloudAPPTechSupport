<?php 
	include('include/header.php');
	include 'include/db_mysql.class.php';
	include 'include/config.inc.php';	
	
	$DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
	$DBLINK->set_charset(DBCHARSET);
	
	if (!$DBLINK) {
		die("数据库连接失败！".$DBLINK->connect_error);
	}
	
//客户信息
$CustomerInfoSQL="SELECT cid,customer_name FROM `customerbaseinformation`";
$CustomerInfoResult=$DBLINK->query($CustomerInfoSQL);

//主机申请人信息  ResponsiblePeople
$ApplyUserSQL="SELECT uid,Name FROM `user` WHERE isTech='0'";
$ApplyUserResult=$DBLINK->query($ApplyUserSQL);

//主机开通人信息  
$ResponsiblePeopleSQL="SELECT uid,Name FROM `user` WHERE isTech='1'";
$ResponsiblePeopleResult=$DBLINK->query($ResponsiblePeopleSQL);
	


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
			<form class="form-horizontal" method="post" action="RepairRecordManager.php?action=Add">
				<fieldset>
				  <div class="control-group">
						<label class="control-label" for="selectError">客户名称</label>
						<div class="controls">
						<select id="selectError" data-rel="chosen" name="CustomerID" style="width: 220px;">
						<?php 
						while ($CustomerROW=$CustomerInfoResult->fetch_array(MYSQL_ASSOC)) {
							printf("<option value=\"%d\">%s</option>",$CustomerROW['cid'],$CustomerROW['customer_name']); 
						}
						?>
						</select>
						</div>
				  </div>
				  
				   <div class="control-group">
						<label class="control-label" for="appendedPrependedInput">IP</label>
						<div class="controls">
						  <div class="input-prepend input-append">
								<input id="appendedPrependedInput" size="16" type="text" Name="IP"><span class="add-on">IPv4</span>
						  </div>
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="selectError">受理人</label>
						<div class="controls">
						<select id="selectError2" data-rel="chosen" name="Responsiblepeople"  style="width: 110px;" >
						<?php 
						while ($RPROW=$ResponsiblePeopleResult->fetch_array(MYSQL_ASSOC)) {
							printf("<option value=\"%d\">%s</option>",$RPROW['uid'],$RPROW['Name']); 
						}
						?>
						</select>
						</div>
				  </div>
				  
		  		  <div class="control-group">
					  <label class="control-label" for="date01">受理日期</label>
					  <div class="controls">
						<input type="text" class="input-xlarge datepicker" id="date01" value="<?php echo Date("Y-m-d H:i:s");?>" name="RequestTime">
					  </div>
				  </div>
				  
  				  <div class="control-group">
					  <label class="control-label" for="textarea2">故障描述</label>
					  <div class="controls">
						<textarea class="cleditor" id="textarea2" rows="3" name="description"></textarea>
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

include('footer.php'); 
?>			