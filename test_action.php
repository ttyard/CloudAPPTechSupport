<?php 

include 'include/config.inc.php';


@ $DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error);
}



//生成故障处理表 编号`customerequestrecord` crid
$cridSQL="SELECT `crid` FROM `customerequestrecord` ORDER BY `crid` DESC LIMIT 1";
$cridResult=$DBLINK->query($cridSQL);
$ridOld=$cridResult->fetch_array(MYSQL_ASSOC);
print_r
$crid=$cridOld['crid'];



?>
