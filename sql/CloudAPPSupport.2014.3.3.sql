/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.24-log : Database - cloudapptechsupport
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cloudapptechsupport` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cloudapptechsupport`;

/*Table structure for table `cloudhostinfo` */

DROP TABLE IF EXISTS `cloudhostinfo`;

CREATE TABLE `cloudhostinfo` (
  `hid` varchar(10) NOT NULL,
  `cid` int(10) unsigned DEFAULT NULL,
  `Name` varchar(50) NOT NULL,
  `IP` varchar(20) DEFAULT NULL,
  `OS` varchar(60) NOT NULL,
  `CPU` varchar(45) DEFAULT NULL,
  `RAM` int(5) DEFAULT NULL,
  `HDD` int(5) DEFAULT NULL,
  `BW` int(5) DEFAULT NULL,
  `DB` varchar(20) DEFAULT NULL,
  `FTP` varchar(20) DEFAULT NULL,
  `ApplyUser` int(8) DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  `SubjectionAccount` varchar(45) DEFAULT NULL,
  `OpenFlag` tinyint(1) DEFAULT NULL,
  `HostType` varchar(45) DEFAULT NULL,
  `IDC` varchar(45) DEFAULT NULL,
  `EX1` varchar(45) DEFAULT NULL,
  `EX2` varchar(45) DEFAULT NULL,
  `EX3` varchar(45) DEFAULT NULL,
  `EX4` varchar(45) DEFAULT NULL,
  `EX5` varchar(45) DEFAULT NULL,
  `EX6` varchar(45) DEFAULT NULL,
  `EX7` varchar(45) DEFAULT NULL,
  `EX8` varchar(45) DEFAULT NULL,
  `EX9` varchar(45) DEFAULT NULL,
  `EX10` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`hid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cloudhostinfo` */

LOCK TABLES `cloudhostinfo` WRITE;

insert  into `cloudhostinfo`(`hid`,`cid`,`Name`,`IP`,`OS`,`CPU`,`RAM`,`HDD`,`BW`,`DB`,`FTP`,`ApplyUser`,`StartTime`,`EndTime`,`SubjectionAccount`,`OpenFlag`,`HostType`,`IDC`,`EX1`,`EX2`,`EX3`,`EX4`,`EX5`,`EX6`,`EX7`,`EX8`,`EX9`,`EX10`) values ('CABU-0001',6,'今点Win2008R2','61.172.238.193\r\n','win2008','2',4,300,NULL,NULL,NULL,0,'2013-11-08 00:00:00','2014-11-08 00:00:00',NULL,0,'华云D型','上海张江数据中心S',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0002',7,'晋财正式服务器','119.147.0.82\r\n','win2003','4',8,80,NULL,NULL,NULL,0,'2013-09-02 00:00:00','2014-10-02 00:00:00',NULL,0,'华云K型','深圳电信数据中心',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0003',8,'朗和服务器A','221.123.151.135\r\n','win2003','2',4,300,NULL,NULL,NULL,0,'2013-07-01 00:00:00','2014-07-01 00:00:00',NULL,0,'华云D型','北京南苑数据中心S',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0004',2,'Linkage_Test','61.172.243.132\r\n','win2008','4',6,600,NULL,NULL,NULL,0,'2013-10-16 00:00:00','2015-01-18 00:00:00',NULL,0,'华云F型','上海张江数据中心S',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0005',3,'麦琪礼物正式','61.172.242.243\r\n','win2003','2',2,200,NULL,NULL,NULL,0,'2013-11-18 00:00:00','2014-12-18 00:00:00',NULL,0,'华云B型','上海张江数据中心S',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0006',9,'saas1312260958_vmnAV','59.175.142.37\r\n','win2003','4',8,80,NULL,NULL,NULL,0,'2013-12-26 00:00:00','2014-02-26 00:00:00',NULL,0,'华云K型','武汉南垸数据中心',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0007',10,'数飞正式购买服务器','59.175.142.55\r\n','win2003','2',2,80,NULL,NULL,NULL,0,'2013-09-03 00:00:00','2015-09-03 00:00:00',NULL,0,'华云I型','武汉南垸数据中心',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0008',10,'云应用BD-深圳数飞软件','59.175.142.60\r\n','win2003','2',2,80,NULL,NULL,NULL,0,'2013-05-03 00:00:00','2015-05-12 00:00:00',NULL,0,'华云I型','武汉南垸数据中心',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0009',10,'12','61.172.242.230\r\n','win2003','2',2,200,NULL,NULL,NULL,0,'2013-10-24 00:00:00','2014-12-24 00:00:00',NULL,0,'华云B型','上海张江数据中心S',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0010',11,'天思Win2003_32_CN','61.172.238.196\r\n','win2003','2',4,300,NULL,NULL,NULL,0,'2013-10-31 00:00:00','2014-10-31 00:00:00',NULL,0,'华云D型','上海张江数据中心S',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0011',12,'信睿低配','221.123.151.37\r\n','win2003','2',4,300,NULL,NULL,NULL,0,'2013-07-22 00:00:00','2014-07-22 00:00:00',NULL,0,'华云D型','北京南苑数据中心S',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0012',12,'信睿科技高配','221.123.151.245\r\n','win2003','4',8,500,NULL,NULL,NULL,0,'2013-07-22 00:00:00','2014-07-22 00:00:00',NULL,0,'华云E型','北京南苑数据中心S',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0013',1,'智龙正式-1','61.172.238.151\r\n','win2003','8',12,1000,NULL,NULL,NULL,0,'2013-12-17 00:00:00','2014-11-27 00:00:00',NULL,0,'华云H型','上海陈家弄机房',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('CABU-0014',1,'智龙正式-2','61.172.238.158\r\n','win2003','8',12,1000,NULL,NULL,NULL,0,'2013-12-17 00:00:00','2014-11-27 00:00:00',NULL,0,'华云H型','上海陈家弄机房',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `customerbaseinfor` */

DROP TABLE IF EXISTS `customerbaseinfor`;

CREATE TABLE `customerbaseinfor` (
  `cid` int(8) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `BD` varchar(45) NOT NULL,
  `TechName` varchar(45) DEFAULT NULL,
  `Contact` varchar(45) DEFAULT NULL,
  `TelePhone` varchar(45) DEFAULT NULL,
  `CompanyAddress` varchar(150) DEFAULT NULL,
  `CompanyTelephone` varchar(45) DEFAULT NULL,
  `QQ` varchar(20) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `ParentCompanyID` int(8) DEFAULT NULL,
  `CompanyLevel` varchar(2) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `ChinacID` varchar(20) DEFAULT NULL,
  `EX2` varchar(45) DEFAULT NULL,
  `EX3` varchar(45) DEFAULT NULL,
  `EX4` varchar(45) DEFAULT NULL,
  `EX5` varchar(45) DEFAULT NULL,
  `EX6` varchar(45) DEFAULT NULL,
  `EX7` varchar(45) DEFAULT NULL,
  `EX8` varchar(45) DEFAULT NULL,
  `EX9` varchar(45) DEFAULT NULL,
  `EX10` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `customerbaseinfor` */

LOCK TABLES `customerbaseinfor` WRITE;

insert  into `customerbaseinfor`(`cid`,`Name`,`BD`,`TechName`,`Contact`,`TelePhone`,`CompanyAddress`,`CompanyTelephone`,`QQ`,`Email`,`ParentCompanyID`,`CompanyLevel`,`Memo`,`ChinacID`,`EX2`,`EX3`,`EX4`,`EX5`,`EX6`,`EX7`,`EX8`,`EX9`,`EX10`) values (1,'智龙','陈蓉','奚文杰','未知','010-85145252','中国北京市中关村软件园','010-85145252','61112525','wang@comp.com',NULL,'A',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'领客积','陈蓉','奚文杰','未知',NULL,'未知',NULL,NULL,NULL,NULL,'A',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'麦琪礼物','陈蓉','奚文杰','未知',NULL,'未知',NULL,NULL,NULL,NULL,'A',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'金蝶','陈蓉','奚文杰','未知',NULL,'未知',NULL,NULL,NULL,NULL,'B',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'微企','陈蓉','奚文杰','未知',NULL,'未知',NULL,NULL,NULL,NULL,'C',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'今点','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'晋财','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'朗和','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'梦工厂','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'数飞','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,'天思','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'信睿\r\n','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `customerequestrecord` */

DROP TABLE IF EXISTS `customerequestrecord`;

CREATE TABLE `customerequestrecord` (
  `crid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `requestime` datetime DEFAULT NULL,
  `uid` int(8) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `reason` varchar(45) DEFAULT NULL,
  `hid` int(10) unsigned NOT NULL,
  `qid` int(8) DEFAULT NULL,
  `rpid` int(8) DEFAULT NULL,
  `completetime` datetime DEFAULT NULL,
  PRIMARY KEY (`crid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `customerequestrecord` */

LOCK TABLES `customerequestrecord` WRITE;

insert  into `customerequestrecord`(`crid`,`requestime`,`uid`,`description`,`state`,`reason`,`hid`,`qid`,`rpid`,`completetime`) values (1,'2014-01-10 13:34:00',0,'用户在使用主机时，突然断线','y','系统有被入侵的痕迹,杀毒软件也未能启动,怀疑中了病毒或木马',0,6,1,'2014-01-10 20:07:00'),(2,'2014-01-09 14:50:00',0,'系统不能远程','y','物理服务器网络断开',0,4,2,'2014-01-09 15:20:00'),(3,'2014-01-09 15:17:00',0,'administrator密码错误','y','物理服务器网络断开',0,1,3,'2014-01-09 15:53:00'),(4,'2014-01-16 16:00:00',0,'系统无响应','y','机器上有非法登录的记录,可能被人入侵了',0,1,4,'2014-01-16 16:50:00'),(5,'2014-01-09 14:50:00',0,'系统突然断线','y','物理服务器电源故障',0,4,5,'2014-01-09 15:20:00'),(6,'2014-02-01 09:00:00',0,'客户的网页不能正常访问','y','物理服务器电源故障',0,1,6,'2014-02-01 09:50:00'),(7,'2014-02-01 09:50:00',0,'服务器后台不能登录，也不能远程','y','Xen主机根目录磁盘满(当时没有找到原因)',0,1,7,'2014-02-01 20:50:00'),(8,'2014-02-01 22:36:00',0,'系统很卡，不能正常操作','y','怀疑是双网卡冲突了(不是很确定)',0,1,8,'2014-02-03 13:55:00'),(9,'2014-02-26 12:30:00',0,'服务器远程桌面无法访问','y','CPU利用率100%,资源耗尽',0,3,9,'2014-02-26 13:30:00'),(10,'2014-01-10 13:34:00',0,'用户在使用主机时，突然断线','y','物理机服务挂掉',0,6,10,'2014-01-10 20:07:00'),(11,'2014-01-06 13:12:00',0,'系统不能远程,数据库端口无法使用','y','物理机系统问题',0,1,11,'2014-01-06 16:15:00'),(12,'2014-01-13 22:10:00',0,'系统突然断线,其他几台机器也断线了','y','客户机器被人入侵',0,4,12,'2014-01-14 09:10:00'),(13,'2014-01-16 11:25:00',0,'系统不能远程','y','物理服务器死机',0,1,13,'2014-01-16 11:39:00'),(14,'2014-02-03 20:30:00',0,'系统服务中断','y','主机被人攻击，导致远程连接服务暂时中断',0,1,14,'2014-02-03 22:00:00'),(15,'2014-02-19 10:00:00',0,'远程连接时断时好','y','主机被人攻击，导致多个服务系统自动断开',0,1,15,'2014-02-19 15:00:00'),(16,'2014-02-22 12:00:00',0,'服务器服务中断，不能远程','y','人为原因修改IIS Web服务端口与“远程桌面”服务端口冲突导致',0,1,16,'2014-02-20 13:00:00');

UNLOCK TABLES;

/*Table structure for table `customerlevel` */

DROP TABLE IF EXISTS `customerlevel`;

CREATE TABLE `customerlevel` (
  `clid` int(8) NOT NULL AUTO_INCREMENT,
  `Level` varchar(2) DEFAULT NULL,
  `Description` varchar(10) DEFAULT NULL,
  `EX1` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`clid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `customerlevel` */

LOCK TABLES `customerlevel` WRITE;

insert  into `customerlevel`(`clid`,`Level`,`Description`,`EX1`) values (1,'A','正式客户',NULL),(2,'B','VIP客户',NULL),(3,'C','测试客户',NULL);

UNLOCK TABLES;

/*Table structure for table `questioncategory` */

DROP TABLE IF EXISTS `questioncategory`;

CREATE TABLE `questioncategory` (
  `qid` int(8) NOT NULL AUTO_INCREMENT,
  `Description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `questioncategory` */

LOCK TABLES `questioncategory` WRITE;

insert  into `questioncategory`(`qid`,`Description`) values (1,'系统问题'),(2,'软件问题'),(3,'人为操作问题'),(4,'网络问题'),(5,'数据库问题'),(6,'硬件问题'),(7,'其他');

UNLOCK TABLES;

/*Table structure for table `requestprocess` */

DROP TABLE IF EXISTS `requestprocess`;

CREATE TABLE `requestprocess` (
  `rpid` int(8) DEFAULT NULL,
  `crid` int(8) NOT NULL,
  `uid` int(8) DEFAULT NULL,
  `AcceptTime` datetime NOT NULL,
  `DeliverUID` int(8) DEFAULT NULL,
  `DeliverTime` datetime DEFAULT NULL,
  `QuestionDescription` varchar(255) DEFAULT NULL,
  `ProcessingMethod` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `requestprocess` */

LOCK TABLES `requestprocess` WRITE;

insert  into `requestprocess`(`rpid`,`crid`,`uid`,`AcceptTime`,`DeliverUID`,`DeliverTime`,`QuestionDescription`,`ProcessingMethod`) values (1,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(2,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(3,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(4,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(5,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(6,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(7,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(8,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(9,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(10,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(11,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(12,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(13,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(14,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(15,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL),(16,0,NULL,'0000-00-00 00:00:00',NULL,NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `uid` int(8) NOT NULL AUTO_INCREMENT,
  `Name` varchar(20) DEFAULT NULL,
  `Telephone` varchar(45) DEFAULT NULL,
  `Mobilephone` varchar(45) DEFAULT NULL,
  `Address` varchar(45) DEFAULT NULL,
  `Type` varchar(45) DEFAULT NULL,
  `EX1` varchar(45) DEFAULT NULL,
  `EX2` varchar(45) DEFAULT NULL,
  `EX3` varchar(45) DEFAULT NULL,
  `EX4` varchar(45) DEFAULT NULL,
  `EX5` varchar(45) DEFAULT NULL,
  `EX6` varchar(45) DEFAULT NULL,
  `EX7` varchar(45) DEFAULT NULL,
  `EX8` varchar(45) DEFAULT NULL,
  `EX9` varchar(45) DEFAULT NULL,
  `EX10` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

LOCK TABLES `user` WRITE;

insert  into `user`(`uid`,`Name`,`Telephone`,`Mobilephone`,`Address`,`Type`,`EX1`,`EX2`,`EX3`,`EX4`,`EX5`,`EX6`,`EX7`,`EX8`,`EX9`,`EX10`) values (1,'奚文杰','0510-66613111','15061508667','无锡市滨湖区慧泽西路科教软件园B区6号华云数据大厦','技术',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'王立杰2','0510-66613111','15370242350','无锡市滨湖区慧泽西路科教软件园B区6号华云数据大厦','技术人员',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'朱丽','0510-66613111','13800001111','无锡市滨湖区慧泽西路科教软件园B区6号华云数据大厦','技术',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'陈蓉','0510-66613111','13800002222','无锡市滨湖区慧泽西路科教软件园B区6号华云数据大厦','BD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
