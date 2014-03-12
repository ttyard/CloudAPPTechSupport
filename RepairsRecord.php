<?php  

include('include/header.php');
include 'include/db_mysql.class.php';
include 'include/config.inc.php';

$DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error.'<br/>'.$DBLINK->connect_errno);
}


$RepairsRecordListSQL="SELECT `crr`.`crid`,`cbi`.`customer_name`,`chi`.`OpenFlag`,`chi`.`HostType`,`crr`.`hid`,`u`.`Name`,`crr`.`requestime`,`crr`.`IP`,`crr`.`description`,`crr`.`completetime`,`crr`.`state` 
						FROM `customerequestrecord` AS `crr`,`user` AS `u`,`customerbaseinformation` AS `cbi`,`questioncategory` AS `q` ,`cloudhost_information` AS `chi`
						WHERE `crr`.`cid`=`cbi`.`cid` AND `crr`.`uid` = `u`.`uid` AND `crr`.`qid`=`q`.`qid` AND `crr`.`hid`=`chi`.`hid` ORDER BY `crr`.`crid` DESC";
 $RRListResult = $DBLINK->query($RepairsRecordListSQL);


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
					<div class="INSERT" style="float:left;margin-right:100px;" >
					      <a class="btn btn-small btn-primary" href="RepairsRecordAdd.php">生成报修工单</a>
					</div>  
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
							  	  <th>序号</th>
								  <th>客户名称</th>
								  <th>主机类型</th>
								  <th>受理人</th>
								  <th>受理日期</th>
								  <th>主机IP</th>
								  <th>故障描述</th>
								  <th>完成日期</th>
								  <th>状态</th>
								  <th>操作</th>
							  </tr>
						  </thead>   
						  <tbody>
						   <?php 
						  	  
						   
						   
							  while ($RRLROW=$RRListResult->fetch_array(MYSQL_ASSOC)) {
								
  								if ($RRLROW['OpenFlag'] == '1') {
									$NOpenflag='正式';
									$OpenflagStyle="label label-success";
									
	
  								}	else if ($RRLROW['OpenFlag']== '0') {
									$NOpenflag='测试';
									$OpenflagStyle="label label-warning";
	
  								} else {
                                    $NOpenflag='其他';
                                    $OpenflagStyle="label label-important";
								}								
								
								switch ($RRLROW['state']) {
									case '新建':
										$StateStyle="label label-important";
									break;
									
									case '处理中':
										$StateStyle="label label-info";
											
										break;
									case '完成':
										$StateStyle="label label-success";
										break;							
											
									default:
										$StateStyle="label label-warning";
									break;
								}
								
								
								$requestime=substr($RRLROW['requestime'],0,16);
								$completetime=substr($RRLROW['completetime'],0,16);
								
								printf("<tr>
											<td>%d</td>
											<td>%s</td>
											<td>华云%s型&nbsp;&nbsp;<span class=\"%s\">%s</span></td>
											<td>%s</td>
											<td>%s</td>
											<td><a href=\"HostDetail.php?hid=%d\">%s</a></td>
											<td>%s</td>
											<td>%s</td>
											<td><span class=\"%s\">%s</span></td>
											<td class=\"center\">
		                                        <a class=\"btn btn-success\" href=\"RepairsRecordDetail.php?crid=%d\">
												    <i class=\"icon-zoom-in icon-white\"></i> 查看</a>
												<a class=\"btn btn-info\" href=\"RepairsRecordUpdate.php?crid=%d\">
												    <i class=\"icon-edit icon-white\"></i> 更新</a>
											</td></tr>",$RRLROW['crid'],$RRLROW['customer_name'],$RRLROW['HostType'],$OpenflagStyle,$NOpenflag,$RRLROW['Name'],$requestime,$RRLROW['hid'],$RRLROW['IP'],
														$RRLROW['description'],$completetime,$StateStyle,$RRLROW['state'],$RRLROW['crid'],$RRLROW['crid']);
							  }
							 
						  ?>
						  
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->

			</div><!--/row-->
<?php include('footer.php'); ?>
