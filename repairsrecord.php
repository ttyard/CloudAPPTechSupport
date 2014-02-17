<?php 
	include('include/header.php');
	include 'include/db_mysql.class.php';
	include 'include/config.inc.php';	
	
	$DBLink = mysqli_connect(DBHOST,DBUSER,DBPW);
	
	if (!$DBLink) {
		die('Could not connect:'.mysql_error());		
	}
	
	mysql_select_db(DBNAME,$DBLink);
	mysql_set_charset(DBCHARSET,$DBLink);
	
	
	$AcceptNameResult=mysql_query('SELECT opt_uid,name FROM optusers',$DBLink);
	
	
	$CustomerNameResult=mysql_query('SELECT cid,CompayName FROM customerbaseinformation',$DBLink);
	
	$QuestionCategoryResult=mysql_query('SELECT qc_id,qc_name FROM questioncategory',$DBLink);
	
	



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

			<div class="sortable row-fluid">
				<a data-rel="tooltip" title="6 new members." class="well span3 top-block" href="repairsrecord_list.php">
					<span class="icon32 icon-red icon-user"></span>
					<div>客户报修一览表</div>
					<div>507</div>
					<span class="notification">6</span>
				</a>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> 客户故障报修</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal">
							<fieldset>
							<div class="control-group">
								<label class="control-label">工单编号</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input">20140217001</span>
								</div>
							  </div>
							  
							 <div class="control-group">
								<label class="control-label" for="selectError">客户名称</label>
								<div class="controls">
									  <select id="selectError" data-rel="chosen">
										<option>麦琪礼物</option>
										<option>智龙</option>
									  </select>
								</div>
							  </div>
							  
							 <div class="control-group">
								<label class="control-label" for="selectError3">受理人</label>
								<div class="controls">
								  <select id="selectError3">
										<option>奚文杰</option>
										<option>朱丽</option>
										<option>王立杰</option>
								  </select>
								</div>
							  </div>
							  
							  <div class="control-group">
							 	 <label class="control-label" for="date01">受理日期</label>
								  <div class="controls">
									<input type="text" class="input-xlarge datepicker" id="date01" value="02/16/12">
								  </div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="selectError3">故障分类</label>
								<div class="controls">
								  <select id="selectError3">
									<option>系统故障</option>
									<option>软件故障</option>
									<option>网络故障</option>
									<option>Option 4</option>
									<option>Option 5</option>
								  </select>
								</div>
							  </div>
							  							  
							  <div class="control-group">
								<label class="control-label" for="appendedPrependedInput">主机IP地址</label>
								<div class="controls">
								  <div class="input-prepend input-append">
									<input id="appendedPrependedInput" size="16" type="text"><span class="add-on">IPv4</span>
								  </div>
								</div>
							  </div>
						
							<div class="control-group">
							  <label class="control-label" for="textarea2">故障描述</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3"></textarea>
							  </div>
							</div>
							
							  <div class="control-group">
								<label class="control-label" for="selectError1">Multiple Select / Tags</label>
								<div class="controls">
								  <select id="selectError1" multiple data-rel="chosen">
									<option>Option 1</option>
									<option selected>Option 2</option>
									<option>Option 3</option>
									<option>Option 4</option>
									<option>Option 5</option>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError2">Group Select</label>
								<div class="controls">
									<select data-placeholder="Your Favorite Football Team" id="selectError2" data-rel="chosen">
										<option value=""></option>
										<optgroup label="NFC EAST">
										  <option>Dallas Cowboys</option>
										  <option>New York Giants</option>
										  <option>Philadelphia Eagles</option>
										  <option>Washington Redskins</option>
										</optgroup>
										<optgroup label="NFC NORTH">
										  <option>Chicago Bears</option>
										  <option>Detroit Lions</option>
										  <option>Green Bay Packers</option>
										  <option>Minnesota Vikings</option>
										</optgroup>										
								  </select>
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
mysql_close($DBLink);
include('footer.php'); 
?>			