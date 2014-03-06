<?php

include('include/header.php');
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

//获取主机名
$HostNameSQL="SELECT `hid` FROM `cloudhost_information` ORDER BY `hid` DESC LIMIT 1";
$HostNameResult=$DBLINK->query($HostNameSQL);
$HostNameOld=$HostNameResult->fetch_array(MYSQL_ASSOC);

if ($HostNameOld['hid']<100 and $HostNameOld['hid']>10){
	++$HostNameOld['hid'];
	$HostName='CABU-00'.$HostNameOld['hid'];
	
} else if ($HostNameOld['hid']>100 and $HostNameOld['hid']<1000) {
	++$HostNameOld['hid'];
	$HostName='CABU-0'.$HostNameOld['hid'];
}else {
	++$HostNameOld['hid'];
	$HostName='CABU-'.$HostNameOld['hid'];
}

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
			<form class="form-horizontal" method="post" action="HostManagerProcess.php?action=Add">
				<fieldset>

				  <div class="control-group">
						<label class="control-label" for="disabledInput">主机名称</label>
						<div class="controls">
						 <input class="input-xlarge disabled" id="disabledInput" type="text" placeholder="<?php echo $HostName;?>" disabled="">
						 <input type="hidden" name="HostName" value="<?php echo $HostName;?>" /> 
						 
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="selectError">所属客户</label>
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
					<label class="control-label" for="selectError3">操作系统</label>
					<div class="controls">
					  <select id="selectError3" name="OS">
						<option value="WIN2003 CN 32Bit">Windows2003中文标准版32位</option>
						<option value="WIN2003 CN 64Bit">Windows2003中文标准版64位</option>
						<option value="WIN2003 EN 32Bit">Windows2003英文标准版32位</option>
						<option value="WIN2008R2 CN 64Bit">Windows2008中文标准版64位</option>
						<option value="WIN2008R2 EN 64Bit">Windows2008英文标准版64位</option>
						<option value="CentoS5.9 32Bit">CentOS5.9标准版32位</option>
						<option value="CentoS5.9 64Bit">CentOS5.9标准版64位</option>
						<option value="CentoS6.4 32Bit">CentOS6.4标准版32位</option>
						<option value="CentoS6.4 64Bit">CentOS6.4标准版64位</option>
					  </select>
					</div>
				  </div>  

				  <div class="control-group">
						<label class="control-label" for="appendedInput">中央处理器CPU</label>
						<div class="controls">
						  <div class="input-append">
							<input id="appendedInput" size="16" type="text" Name="CPU"><span class="add-on">核</span>
						  </div>						  
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="appendedInput">内存</label>
						<div class="controls">
						  <div class="input-append">
							<input id="appendedInput" size="16" type="text" Name="RAM"><span class="add-on">GB</span>
						  </div>						  
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="appendedInput">硬盘</label>
						<div class="controls">
						  <div class="input-append">
							<input id="appendedInput" size="16" type="text" Name="HDD"><span class="add-on">GB</span>
						  </div>						  
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="appendedInput">带宽</label>
						<div class="controls">
						  <div class="input-append">
							<input id="appendedInput" size="16" type="text" Name="BW"><span class="add-on">Mbps</span>
						  </div>						  
						</div>
				  </div>
				  
				 <div class="control-group">
					<label class="control-label" for="focusedInput">数据库系统</label>
					<div class="controls">
					    <input class="input-xlarge focused" id="focusedInput" type="text" name="DB" value="">
					</div>
				  </div>
				  
				  <div class="control-group">
					<label class="control-label" for="focusedInput">FTP</label>
					<div class="controls">
					  <input class="input-xlarge focused" id="focusedInput" type="text"  name="FTP" value="">
					</div>
				  </div>

				  <div class="control-group">
						<label class="control-label" for="selectError">申请人</label>
						<div class="controls">
						<select id="selectError1" data-rel="chosen" name="ApplyUser" style="width: 110px;">
						<?php 
						while ($ResponsiblePeopleROW=$ApplyUserResult->fetch_array(MYSQL_ASSOC)) {
							printf("<option value=\"%d\">%s</option>",$ResponsiblePeopleROW['uid'],$ResponsiblePeopleROW['Name']); 
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
							printf("<option value=\"%d\">%s</option>",$RPROW['uid'],$RPROW['Name']); 
						}
						?>
						</select>
						</div>
				  </div>
				  
		  		  <div class="control-group">
					  <label class="control-label" for="date01">开通日期</label>
					  <div class="controls">
						<input type="text" class="input-xlarge datepicker" id="date01" value="<?php echo Date("Y-m-d H:i:s");?>" name="StartTime">
					  </div>
				  </div>
				  <div class="control-group">
					  <label class="control-label" for="date02">到期日期</label>
					  <div class="controls">
						<input type="text" class="input-xlarge datepicker" id="date02" value="<?php echo date('Y-m-d H:i:s', $EndTimecycle);?>" name="EndTime">
					  </div>
				  </div>
				  
				  <div class="control-group">
					  <label class="control-label" for="date01">正式用户</label>
					  <div class="controls">
						<!--  <input data-no-uniform="true" type="checkbox" class="iphone-toggle" name="OpenFlag" value="">   -->
						<label><input name=OpenFlag type="radio" value="1" />是 </label>
						<label><input name="OpenFlag" type="radio" value="0" />否 </label>
					  </div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="selectError">主机型号</label>
						<div class="controls">
						<select id="selectError6" data-rel="chosen" name="HostType" style="width: 110px;">
							<option value="A">华云A型</option>
							<option value="B">华云B型</option>
							<option value="C">华云C型</option>
							<option value="D">华云D型</option>
							<option value="E">华云E型</option>
							<option value="F">华云F型</option>
							<option value="G">华云G型</option>
							<option value="H">华云H型</option>
							<option value="H">华云I型</option>
							<option value="J">华云J型</option>
							<option value="K">华云K型</option>
							<option value="L">华云L型</option>
						</select>
						</div>
				  </div>
				  
				  <div class="control-group">
						<label class="control-label" for="selectError">所在机房</label>
						<div class="controls">
						<select id="IDC" data-rel="chosen" name="IDC" style="width: 220px;">							
							<option value="上海张江数据中心S">上海张江数据中心S</option>
							<option value="武汉南垸数据中心">武汉南垸数据中心</option>
							<option value="北京南苑数据中心S">北京南苑数据中心S</option>
							<option value="北京木樨园数据中心">北京木樨园数据中心</option>
							<option value="香港DC数据中心">香港DC数据中心</option>
							<option value="香港DC数据中心2">香港DC数据中心2</option>
							<option value="香港DC数据中心S">香港DC数据中心S</option>
							<option value="中国电信美洲数据中心">中国电信美洲数据中心</option>
							<option value="中国电信美洲数据中心S">中国电信美洲数据中心S</option>
						</select>
						</div>
				  </div>
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">新增</button>
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