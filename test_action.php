<?php 

include 'include/config.inc.php';


@ $DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error);
}



echo $RepairsRecordListSQL=sprintf("SELECT `crr`.`crid`,`cbi`.`customer_name`,`chi`.`OpenFlag`,`chi`.`HostType`,`crr`.`hid`,`u`.`Name`,`crr`.`requestime`,`crr`.`IP`,`crr`.`reason`,`p`.`ProcessingMethod`,`crr`.`completetime`,`crr`.`state`
									FROM `customerequestrecord` AS `crr`,`user` AS `u`,`customerbaseinformation` AS `cbi`,`questioncategory` AS `q` ,`cloudhost_information` AS `chi`,`requestprocess` AS `p`
									WHERE `crr`.`cid`=`cbi`.`cid` AND `crr`.`uid` = `u`.`uid`  AND `crr`.`qid`=`q`.`qid` AND `crr`.`hid`=`chi`.`hid` AND `crr`.`rpid`=`p`.`rpid`");
echo '<br/>$RRListResult=';
echo $RRListResult=$DBLINK->query($RepairsRecordListSQL);
print_r($RRListResult);


?>
