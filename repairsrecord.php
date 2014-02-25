<?php 
	include('include/header.php');
	include 'include/db_mysql.class.php';
	include 'include/config.inc.php';	
	
	$DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
	$DBLINK->set_charset(DBCHARSET);
	
	if (!$DBLINK) {
		die("数据库连接失败！".$DBLINK->connect_error);
	}
	
	$CustomerNameResult = $DBLINK->query('SELECT cid,CompanyName FROM customerbaseinformation');
	
	$AcceptNameResult=$DBLINK->query('SELECT opt_uid,name FROM optusers');
	
	$QuestionCategoryResult=$DBLINK->query('SELECT qc_id,qc_name FROM questioncategory');


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
						<form class="form-horizontal" method="post" action="rs_insert_process.php">
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
									  <select id="selectError" data-rel="chosen" name="CustomerID">
										  <?php 
										  
											  while ($CNROW=$CustomerNameResult->fetch_array(MYSQL_ASSOC)) {
											      echo '<option value='.$CNROW[cid].'>'.$CNROW[CompanyName].'</option>';
											  }
										  ?>
									  </select>
								</div>
							  </div>
							  
							 <div class="control-group">
								<label class="control-label" for="selectError3">受理人</label>
								<div class="controls">
								  <select id="selectError3" name="OPTUID">
										<?php 
										  
											  while ($ACROW=$AcceptNameResult->fetch_array(MYSQL_ASSOC)) {
											      echo '<option value='.$ACROW[opt_uid].'>'.$ACROW[name].'</option>';
											  }
										  ?>
										
										
								  </select>
								</div>
							  </div>
							  
							  <div class="control-group">
							 	 <label class="control-label" for="date01">受理日期</label>
								  <div class="controls">
									<input type="text" class="input-xlarge datepicker" id="date01" value="02/16/12" name="AcceptDateTime">
								  </div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="selectError3">故障分类</label>
								<div class="controls">
								  <select id="selectError3" name="QCID">
										<?php 										  
											  while ($QCROW=$QuestionCategoryResult->fetch_array(MYSQL_ASSOC)) {
											      echo '<option value='.$QCROW[qc_id].'>'.$QCROW[qc_name].'</option>';
											  }
										  ?>
								  </select>
								</div>
							  </div>
							  							  
							  <div class="control-group">
								<label class="control-label" for="appendedPrependedInput">主机IP地址</label>
								<div class="controls">
								  <div class="input-prepend input-append">
									<input id="appendedPrependedInput" size="16" type="text" name="HostIP"><span class="add-on">IPv4</span>
								  </div>
								</div>
							  </div>
						
							<div class="control-group">
							  <label class="control-label" for="textarea2">故障描述</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="Description"></textarea>
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