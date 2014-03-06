<?php
include('include/header.php');
include 'include/db_mysql.class.php';
include 'include/config.inc.php';

$DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error());
}

$HostSQL = sprintf('SELECT `chi`.`HostName`,`cbi`.`customer_name`,`chi`.`IP`,`chi`.`OS`,`chi`.`CPU`,`chi`.`RAM`,`chi`.`HDD`,`chi`.`BW`,`u`.`Name`,`chi`.`StartTime`,`chi`.`EndTime`,`chi`.`OpenFlag`,`chi`.`HostType`,`chi`.`IDC` FROM `cloudhost_information` AS `chi`,`customerbaseinformation` AS `cbi`,`user` AS `u` WHERE (`chi`.`customerID`= `cbi`.`cid`) AND (`chi`.`ApplyUser`=`u`.`uid`)');
$HostResult = $DBLINK->query($HostSQL);

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
					<div class="INSERT" style="float:left;margin-right:100px;" >
					      <a class="btn btn-small btn-primary" href="HostAdd.php">新增主机</a>
					</div>   
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>主机名称</th>
								  <th>所属客户</th>
								  <th>主机IP</th>
								  <th>配置信息</th>
								  <td>申请人</td>
								  <td>开通日期</td>
								  <td>终止日期</td>
								  <td>云主机类型</td>
								  <td>所属机房</td>
								  <td>操作</td>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php 
						  
							  while ($HROW=$HostResult->fetch_array(MYSQL_ASSOC)) {
								
  								if ($HROW['OpenFlag'] == '1') {
									$NOpenflag='正式';
	
  								}	else if ($HROW['OpenFlag']== '0') {
									$NOpenflag='测试';
	
  								} else {
                                    $NOpenflag='其他';
								}
								$StartTime=substr($HROW['StartTime'],0,10);
								$EndTime=substr($HROW['EndTime'],0,10);

								printf("<tr>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>CPU:%s核,RAM:%sGB,硬盘:%sGB,带宽:%sMpbs</td>
											<td>%s</td>
											<td>%s</td>
											<td>%s</td>
											<td>华云%s型,%s</td>
											<td>%s</td>
											<td class=\"center\">
		                                        <a class=\"btn btn-success\" href=\"HostManagerProcess.php?action=viewdetail&uid=%s\">
												    <i class=\"icon-zoom-in icon-white\"></i> 查看</a>
												<a class=\"btn btn-info\" href=\"HostManagerProcess.php?action=edit&uid=%s\">
												    <i class=\"icon-edit icon-white\"></i> 编辑</a>
												<a class=\"btn btn-danger\" href=\"HostManagerProcess?action=delete&uid=%s\">
													<i class=\"icon-trash icon-white\"></i>删除</a>
											</td></tr>",$HROW['HostName'],$HROW['customer_name'],$HROW['IP'],$HROW['CPU'],$HROW['RAM'],$HROW['HDD'],$HROW['BW'],$HROW['Name'],$StartTime,$EndTime,$HROW['HostType'],$NOpenflag,$HROW['IDC'],$HROW['hid'],$HROW['hid'],$HROW['hid']);							  	
						  	
								//释放MYSQL连接
								

								
							  }
						  
						  ?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
			
<?php 
$HostResult->free();
include('footer.php'); 
?>