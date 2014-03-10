<?php

include('include/header.php');
include 'include/config.inc.php';
$DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error);
}

$hid=$_GET['hid'];

//客户信息
$CustomerInfoSQL="SELECT cid,customer_name FROM `customerbaseinformation`";
$CustomerInfoResult=$DBLINK->query($CustomerInfoSQL);

//主机申请人信息  ResponsiblePeople
$ApplyUserSQL="SELECT uid,Name FROM `user` WHERE isTech='0'";
$ApplyUserResult=$DBLINK->query($ApplyUserSQL);

//主机开通人信息  
$ResponsiblePeopleSQL="SELECT uid,Name FROM `user` WHERE isTech='1'";
$ResponsiblePeopleResult=$DBLINK->query($ResponsiblePeopleSQL);

//获取主机名
$HostNameSQL="SELECT `hid` FROM `cloudhost_information` ORDER BY `hid` DESC LIMIT 1";
$HostNameResult=$DBLINK->query($HostNameSQL);
$HostNameOld=$HostNameResult->fetch_array(MYSQL_ASSOC);

//获取主机信息
$HostSQL = sprintf("SELECT `chi`.`hid`,`chi`.`HostName`,`chi`.`customerID`,`chi`.`IP`,`chi`.`OS`,`chi`.`CPU`,`chi`.`RAM`,`chi`.`HDD`,`chi`.`BW`,`chi`.`DB`,
						   `chi`.`FTP`,`chi`.`ApplyUser`,`chi`.`Responsiblepeople`,`chi`.`StartTime`,`chi`.`EndTime`,`chi`.`SubjectionAccount`,`chi`.`OpenFlag`,
		 				   `chi`.`HostType`,`chi`.`IDC`,`chi`.`EX1` FROM `cloudhost_information` AS `chi`,`customerbaseinformation` AS `cbi` WHERE (`chi`.`hid`= '%d')",$hid);

$HostRecodeResult = $DBLINK->query($HostSQL);
$HostRecode=$HostRecodeResult->fetch_array(MYSQL_ASSOC);

//定义时期和时间 试用一般为3天
$EndTimecycle=time() + (3 * 24 * 60 * 60);

?>

<div>
	<ul class="breadcrumb">
		<li>
			<a href="index.php">首页</a><span class="divider">/</span> 
		</li>
		<li>
			<a href="Host.php">云主机管理</a><span class="divider">/</span> 
		</li>
		<li>
			<a href="#">新增主机</a><span class="divider"></span> 
		</li>
	</ul>
</div>

<div class="row-fluid sortable">
	<div class="box span6">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>新增主机信息</h2>
			<div class="box-icon">
				<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="HostManagerProcess.php?action=Edit&hid=<?php echo $HostRecode['hid'];?>">
				<fieldset>

				  <div class="control-group">
						<label class="control-label" for="disabledInput">主机名称</label>
						<div class="controls">
						 <input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="<?php echo $HostRecode['HostName'];?>" disabled="">
						 <input type="hidden" name="hid" value="<?php echo $HostRecode['hid'];?>" /> 
						 <input type="hidden" name="HostName" value="<?php echo $HostRecode['HostName'];?>" /> 
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="selectError">所属客户</label>
						<div class="controls">
						<select id="selectError" data-rel="chosen" name="CustomerID" style="width: 220px;">
						<?php 
						while ($CustomerROW=$CustomerInfoResult->fetch_array(MYSQL_ASSOC)) {

							if ($HostRecode['customerID']==$CustomerROW['cid']) {
								printf("<option value=\"%d\" selected=\"selected\">%s</option>",$CustomerROW['cid'],$CustomerROW['customer_name']);
							} else {
								printf("<option value=\"%d\">%s</option>",$CustomerROW['cid'],$CustomerROW['customer_name']);
							} 
						}
						?>
						</select>
						</div>
				  </div>
				  
				   <div class="control-group">
						<label class="control-label" for="appendedPrependedInput">IP</label>
						<div class="controls">
						  <div class="input-prepend input-append">
								<input id="appendedPrependedInput" size="16" type="text" Name="IP" value="<?php echo $HostRecode['IP'];?>" ><span class="add-on">IPv4</span>
						  </div>
						</div>
				  </div>
				  
				  <div class="control-group">
					<label class="control-label" for="selectError3">操作系统</label>
					<div class="controls">
					  <select id="selectError3" name="OS">					  
						<?php 
							for ($i = 0; $i < count($HostOSA); $i++) {
								if($HostRecode['OS']==$HostOSA[$i]){
									echo "<option value=\"$HostOSA[$i]\" selected=\"selected\">$HostOSA[$i]</option>";
								} else {
									echo "<option value=\"$HostOSA[$i]\">$HostOSA[$i]</option>";
								}
							}
						?>	
					  </select>
					</div>
				  </div>  

				  <div class="control-group">
						<label class="control-label" for="appendedInput">中央处理器CPU</label>
						<div class="controls">
						  <div class="input-append">
							<input id="appendedInput" size="16" type="text" Name="CPU" value="<?php echo $HostRecode['CPU']?>" ><span class="add-on">核</span>
						  </div>						  
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="appendedInput">内存</label>
						<div class="controls">
						  <div class="input-append">
							<input id="appendedInput" size="16" type="text" Name="RAM" value="<?php echo $HostRecode['RAM']?>"><span class="add-on">GB</span>
						  </div>						  
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="appendedInput">硬盘</label>
						<div class="controls">
						  <div class="input-append">
							<input id="appendedInput" size="16" type="text" Name="HDD" value="<?php echo $HostRecode['HDD']?>"><span class="add-on">GB</span>
						  </div>						  
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="appendedInput">带宽</label>
						<div class="controls">
						  <div class="input-append">
							<input id="appendedInput" size="16" type="text" Name="BW" value="<?php echo $HostRecode['BW']?>"><span class="add-on">Mbps</span>
						  </div>						  
						</div>
				  </div>
				  
				 <div class="control-group">
					<label class="control-label" for="focusedInput">数据库系统</label>
					<div class="controls">
					    <input class="input-xlarge focused" id="focusedInput" type="text" name="DB" value="<?php echo $HostRecode['DB']?>">
					</div>
				  </div>
				  
				  <div class="control-group">
					<label class="control-label" for="focusedInput">FTP</label>
					<div class="controls">
					  <input class="input-xlarge focused" id="focusedInput" type="text"  name="FTP" value="<?php echo $HostRecode['FTP']?>">
					</div>
				  </div>

				  <div class="control-group">
						<label class="control-label" for="selectError">申请人</label>
						<div class="controls">
						<select id="selectError1" data-rel="chosen" name="ApplyUser" style="width: 110px;">
						<?php 
						while ($ApplyUserROW=$ApplyUserResult->fetch_array(MYSQL_ASSOC)) {
							if($HostRecode['ApplyUser']==$ApplyUserROW['uid']) {
								printf("<option value=\"%d\" selected=\"selected\">%s</option>",$ApplyUserROW['uid'],$ApplyUserROW['Name']);
							} else {
								printf("<option value=\"%d\">%s</option>",$ApplyUserROW['uid'],$ApplyUserROW['Name']);
							} 
						}
						?>
						</select>
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="selectError">开通人</label>
						<div class="controls">
						<select id="selectError2" data-rel="chosen" name="Responsiblepeople"  style="width: 110px;" >
						<?php 
						while ($RPROW=$ResponsiblePeopleResult->fetch_array(MYSQL_ASSOC)) {
							if($HostRecode['Responsiblepeople']==$RPROW['uid']) {
								printf("<option value=\"%d\" selected=\"selected\">%s</option>",$RPROW['uid'],$RPROW['Name']);
							} else  {
								printf("<option value=\"%d\">%s</option>",$RPROW['uid'],$RPROW['Name']);		
							} 
							
						}
						?>
						</select>
						</div>
				  </div>
				  
		  		  <div class="control-group">
					  <label class="control-label" for="date01">开通日期</label>
					  <div class="controls">
						<input type="text" class="input-xlarge" id="StartTime" value="<?php echo $HostRecode['StartTime']?>" name="StartTime">
					  </div>
				  </div>
				  <div class="control-group">
					  <label class="control-label" for="date02">到期日期</label>
					  <div class="controls">
						<input type="text" class="input-xlarge" id="EndTime" value="<?php echo $HostRecode['EndTime']?>" name="EndTime">
					  </div>
				  </div>
				  
				  <div class="control-group">
					  <label class="control-label" for="date01">正式用户</label>
					  <div class="controls">
						<!--  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="OpenFlag" value="">   -->
						<?php 
						     if ($HostRecode['OpenFlag']==1) {
						     	echo "<label><input name=\"OpenFlag\" type=\"radio\" checked=\"checked\" value=\"1\" />是 </label>";
								echo "<label><input name=\"OpenFlag\" type=\"radio\" value=\"0\" />否 </label>";
						     } elseif ($HostRecode['OpenFlag']==0) {
								echo "<label><input name=\"OpenFlag\" type=\"radio\" value=\"1\" />是 </label>";
								echo "<label><input name=\"OpenFlag\" type=\"radio\" checked=\"checked\" value=\"0\" />否 </label>";						     	
						     } else {
								echo "<label><input name=\"OpenFlag\" type=\"radio\" value=\"1\" />是 </label>";
								echo "<label><input name=\"OpenFlag\" type=\"radio\" value=\"0\" />否 </label>";						     	
						     }
						?>
					  </div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="selectError">主机型号</label>
						<div class="controls">
						<select id="selectError6" data-rel="chosen" name="HostType" style="width: 110px;">
						<?php 
							for ($i = 0; $i < count($HostTypeA); $i++) {
								if($HostRecode['HostType']==$HostTypeA[$i]){
									echo "<option value=\"$HostTypeA[$i]\" selected=\"selected\">$HostTypeA[$i]型</option>";
								} else {
									echo "<option value=\"$HostTypeA[$i]\">$HostTypeA[$i]型</option>";
								}
							}
						?>	
						</select>
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="selectError">所在机房</label>
						<div class="controls">
						<select id="IDC" data-rel="chosen" name="IDC" style="width: 220px;">	
							<?php 
								for ($i = 0; $i < count($IDCNameA); $i++) {
									if($HostRecode['IDC']==$IDCNameA[$i]){
										echo "<option value=\"$IDCNameA[$i]\" selected=\"selected\">$IDCNameA[$i]</option>";
									} else {
										echo "<option value=\"$IDCNameA[$i]\">$IDCNameA[$i]</option>";
									}
								}
							?>	
						</select>
						</div>
				  </div>
  				  <div class="control-group">
					  <label class="control-label" for="textarea2">备注</label>
					  <div class="controls">
						<textarea class="cleditor" id="textarea2" rows="3" name="EX1"><?php echo $HostRecode['EX1'];?></textarea>
					  </div>
				  </div>
				  
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">更新</button>
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
<script>
$('#StartTime').datetimepicker({
	format:'Y-m-d H:i',
	step:10
});
$('#EndTime').datetimepicker({
	format:'Y-m-d H:i',
	step:10
});
</script>