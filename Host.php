<?php
include('include/header.php');
include 'include/db_mysql.class.php';
include 'include/config.inc.php';

$DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error);
}

?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">首页</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">云主机</a><span class="divider"></span>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> 云主机信息表</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
							
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>所属客户</th>
								  <th>主机名称</th>
								  <th>主机IP</th>
								  <th>操作系统</th>
								  <th>CPU（核）</th>
								  <th>内存</th>
								  <th>硬盘</th>
								  <th>带宽</th>
								  <td>申请人</td>
								  <td>开通日期</td>
								  <td>终止日期</td>
								  <td>云主机类型</td>
								  <td>所属机房</td>
								  <td>状态</td>
								  <td>操作</td>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php 
						  $UserResult = $DBLINK->query('SELECT `hid`,cid`,`Name`,`IP`,`OS`,`CPU`,`RAM`,`HDD`,`BW`,`DB`,`FTP`,`ApplyUser`,`StartTime`,`EndTime`,`SubjectionAccount`,`OpenFlag`,`HostType`,`IDC` FROM `cloudhostinfo`');
						  
						  
							  while ($HROW=$UserResult->fetch_array(MYSQL_ASSOC)) {
								$CNAMESQL=sprintf("SELECT `Name` FROM `customerbaseinfor` Where `cid`='%s'",$HROW['cid']);	
								$CustomerName=$DBLINK-query($CNAMESQL);
								
								
								$ApplyUserNameSQL=sprintf("SELECT `Name` FROM `user` WHERE `uid`='%s'",$HROW['ApplyUser']);
								$ApplyUserName=$DBLINK->query($ApplyUserNameSQL);
 
								printf("<tr>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td class=\"center\">
												<a class=\"btn btn-info\" href=\"UserEdit.php?uid=%s\">
												    <i class=\"icon-edit icon-white\"></i> 编辑</a>
												<a class=\"btn btn-danger\" href=\"UserEdit.php?uid=%s\">
													<i class=\"icon-trash icon-white\"></i>删除</a>
											</td></tr>",$HROW['username'],$HROW['Name'],$HROW['Telephone'],$HROW['Mobilephone'],$HROW['Address'],$HROW['Type'],$HROW['uid'],$HROW['uid']);							  	
						  	
								//释放MYSQL连接
								
								$CustomerName->free();
								$ApplyUserName->free();
								
							  }
						  
						  ?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
<?php include('footer.php'); ?>