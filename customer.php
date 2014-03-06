<?php
include('include/header.php');
include 'include/db_mysql.class.php';
include 'include/config.inc.php';

$DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error());
}

$CustomerSQL=sprintf("SELECT `cid`,`customer_name`,`BD`,`TechName`,`Contact`,`TelePhone`,`CompanyAddress`,`CompanyTelephone`,`Email`,`CompanyLevel` FROM `customerbaseinformation`;");
$CustomerResult = $DBLINK->query($CustomerSQL);


?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">首页</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">客户管理</a><span class="divider"></span>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> 客户列表</h2>
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
								  <th>客户名称</th>
								  <th>所属BD</th>
								  <th>技术负责人</th>
								  <th>联系人</th>
								  <th>联系电话</th>
								  <th>公司地址</th>
								  <th>办公电话</th>
								  <th>电子邮件</th>
								  <th>公司等级</th>
								  <th>操作</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php 
						  
							  while ($CROW=$CustomerResult->fetch_array(MYSQL_ASSOC)) {
 
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
											<td class=\"center\">
											    <a class=\"btn btn-success\" href=\"CusomterManagerProcess.php?action=viewdetail&cid=%s\">
													<i class=\"icon-trash icon-white\"></i>查看</a>	
												<a class=\"btn btn-info\" href=\"CusomterManagerProcess.php?action=edit&cid=%s\">
												    <i class=\"icon-edit icon-white\"></i> 编辑</a>
												<a class=\"btn btn-danger\" href=\"CusomterManagerProcess.php?action=delete&cid=%s\">
													<i class=\"icon-trash icon-white\"></i>删除</a>
												
											</td></tr>",$CROW['customer_name'],$CROW['BD']?$CROW['BD']:'无',$CROW['TechName']?$CROW['TechName']:'无',$CROW['Contact']?$CROW['Contact']:'无',$CROW['TelePhone']?$CROW['TelePhone']:'无',$CROW['CompanyAddress']?$CROW['CompanyAddress']:'无',$CROW['CompanyTelephone']?$CROW['CompanyTelephone']:'无',$CROW['Email']?$CROW['Email']:'无',$CROW['CompanyLevel']?$CROW['CompanyLevel']:'无',$CROW['cid'],$CROW['cid'],$CROW['cid']);							  	
						  	
							  }
						  
						  ?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
<?php include('footer.php'); ?>