<?php
include('include/header.php');
include 'include/db_mysql.class.php';
include 'include/config.inc.php';

$DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error());
}

$USQL=sprintf("SELECT `uid`,`Name`,`Telephone`,`Mobilephone`,`Address`,`Type` FROM `User`");
$UserResult = $DBLINK->query($USQL);


?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">首页</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">用户管理</a><span class="divider"></span>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> 系统用户列表</h2>
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
								  <th>用户姓名</th>
								  <th>联系电话</th>
								  <th>手机</th>
								  <th>地址</th>
								  <th>角色</th>
								  <th>操作</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php 
						  
							  while ($UROW=$UserResult->fetch_array(MYSQL_ASSOC)) {
 
								printf("<tr>								            
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
											</td></tr>",$UROW['Name'],$UROW['Telephone'],$UROW['Mobilephone'],$UROW['Address'],$UROW['Type'],$UROW['uid'],$UROW['uid']);							  	
						  	
							  }
						  
						  ?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
<?php include('footer.php'); ?>