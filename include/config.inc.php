<?php

//数据库相关 (mysql 连接时, 并且没有设置 DBLINK 时, 需要配置以下变量)
define('DBHOST', '127.0.0.1');			//  数据库主机
define('DBUSER', 'root');				//  数据库用户名
define('DBPW', '123456a!');					    //  数据库密码
define('DBNAME', 'cloudapptechsupport');	//  数据库名称
define('DBCHARSET', 'utf8');			//  数据库字符集
define('DBPORT', '3306');			//  数据库字符集
//define('DBTABLEPRE', 'ucenter.');		//  数据库表前缀


//IDC 机房
$IDCNameA=array("上海张江数据中心S","上海陈家弄机房","武汉南垸数据中心","北京南苑数据中心S","北京木樨园数据中心","香港DC数据中心","香港DC数据中心2","香港DC数据中心S","中国电信美洲数据中心","中国电信美洲数据中心S");

//云主机类型
$HostTypeA=array("A","B","C","D","E","F","G","H","I","J","K","L");

//云主机操作系统
$HostOSA=array("WIN2003 CN 32Bit","WIN2003 CN 64Bit","WIN2003 EN 32Bit","WIN2008R2 CN 64Bit","WIN2008R2 EN 64Bit","CentoS5.9 32Bit","CentoS5.9 64Bit","CentoS6.4 32Bit","CentoS6.4 64Bit","SUSE11 64Bit");

//报修工单状态
$RequestRecordState=array("新建","处理中","完成");