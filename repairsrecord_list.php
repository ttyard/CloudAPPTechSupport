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
						<a href="#">客户报修</a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">客户报修一览表</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> 客户报修记录</h2>
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
								  <th>客户类型</th>
								  <th>受理人</th>
								  <th>受理日期</th>
								  <th>故障分类</th>
								  <th>主机IP</th>
								  <th>问题描述</th>
								  <th>问题原因</th>
								  <th>处理办法</th>
								  <th>完成日期</th>
								  <th>状态</th>
								  <th>操作</th>
							  </tr>
						  </thead>   
						  <tbody>
							<tr>
								<td>麦琪礼物</td>
								<td>正式用户</td>
								<td>奚文杰</td>
								<td>2014-2-1 9:00:00</td>
								<td>系统问题</td>
								<td>61.172.242.243</td>
								<td>客户的网页不能正常访问</td>	
								<td class="center">物理机服务挂掉</td>
								<td class="center">重启物理机的服务</td>
								<td class="center">2014-2-1 9:50:00</td>
								<td class="center">
									<span class="label label-success">完成</span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
										查看                                            
									</a>
									<a class="btn btn-info" href="#">
										<i class="icon-edit icon-white"></i>  
										编辑                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white"></i> 
										删除
									</a>
								</td>
							</tr>
							
							<tr>
								<td>麦琪礼物</td>
								<td>正式用户</td>
								<td>奚文杰</td>
								<td>2014-2-1 9:00:00</td>
								<td>系统问题</td>
								<td>61.172.242.243</td>
								<td>客户的网页不能正常访问</td>	
								<td class="center">物理机服务挂掉</td>
								<td class="center">重启物理机的服务</td>
								<td class="center">2014-2-1 9:50:00</td>
								<td class="center">
									<span class="label label-success">完成</span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
										查看                                            
									</a>
									<a class="btn btn-info" href="#">
										<i class="icon-edit icon-white"></i>  
										编辑                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white"></i> 
										删除
									</a>
								</td>
							</tr>
							
							
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
<?php include('footer.php'); ?>
