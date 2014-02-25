<?php
include('include/header.php');
include 'include/db_mysql.class.php';
include 'include/config.inc.php';

$DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error);
}

$uid=$_GET['uid'];
$EditUserSQL=printf("SELECT `uid`,`username`,`Name`,`Telephone`,`Mobilephone`,`Address`,`Type` FROM `user` WHERE `uid`='%s'",$uid);
$UserResult = $DBLINK->query($EditUserSQL);
$UserData=$UserResult->fetch_array(MYSQL_ASSOC);
?>

<div>
	<ul class="breadcrumb">
		<li>
			<a href="index.php">首页</a><span class="divider">/</span> 
		</li>
		<li>
			<a href="user.php">用户管理</a><span class="divider">/</span> 
		</li>
		<li>
			<a href="#">编辑</a><span class="divider"></span> 
		</li>
	</ul>
</div>


<div class="row-fluid sortable">
	<div class="box span6">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>用户信息修改</h2>
			<div class="box-icon">
				<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="UserEditProcess.php">
				<fieldset>
				<div class="control-group">
					<label class="control-label">用户名</label>
					<div class="controls">
					  <span class="input-xlarge uneditable-input"><?php echo $UserData['username']; ?></span>
					</div>
				  </div>
				  
				 <div class="control-group">
					<label class="control-label" for="focusedInput">用户姓名</label>
					<div class="controls">
					  <input class="input-xlarge focused" id="focusedInput" type="text" name="Name" value="<?php echo $UserData['Name']; ?>">
					</div>
				  </div>
				  
				  <div class="control-group">
					<label class="control-label" for="focusedInput">联系电话</label>
					<div class="controls">
					  <input class="input-xlarge focused" id="focusedInput" type="text"  name="Telephone" value="<?php echo $UserData['Telephone'];?>">
					</div>
				  </div>
				  
				  
				  <div class="control-group">
					<label class="control-label" for="focusedInput">手机号码</label>
					<div class="controls">
					  <input class="input-xlarge focused" id="focusedInput" type="text" name="Mobilephone" value="<?php echo $UserData['Mobilephone'];?>">
					</div>
				  </div>
				  
				  <div class="control-group">
					<label class="control-label" for="focusedInput">通讯地址</label>
					<div class="controls">
					  <input class="input-xlarge focused" id="focusedInput" type="text" name="Address" value="<?php echo $UserData['Address'];?>">
					</div>
				  </div>
				  
				 <div class="control-group">
					<label class="control-label" for="selectError3">受理人</label>
					<div class="controls">
					  <select id="selectError3" name="Type">
							<option value="技术人员">技术人员</option>
							<option value="BD业务拓展人员">BD业务拓展人员</option>
							<option value="市场运营人员">市场运营人员</option>
							<option value="部门经理">部门经理</option>
							<option value="总监">总监</option>
					  </select>
					</div>
				  </div>
				  
				  <div class="form-actions">
					<button type="submit" class="btn btn-primary">提交</button>
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