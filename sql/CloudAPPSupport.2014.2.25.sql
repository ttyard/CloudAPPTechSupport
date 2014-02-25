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
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cloudapptechsupport` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cloudapptechsupport`;

/*Table structure for table `cloudhostinfo` */

DROP TABLE IF EXISTS `cloudhostinfo`;

CREATE TABLE `cloudhostinfo` (
  `hid` varchar(10) NOT NULL,
  `cid` int(8) DEFAULT NULL,
  `IP` varchar(20) DEFAULT NULL,
  `CPU` varchar(45) DEFAULT NULL,
  `RAM` int(5) DEFAULT NULL,
  `HDD` int(5) DEFAULT NULL,
  `BW` int(5) DEFAULT NULL,
  `DB` varchar(20) DEFAULT NULL,
  `FTP` varchar(20) DEFAULT NULL,
  `uid` int(8) DEFAULT NULL,
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
  `EX1` varchar(20) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `customerbaseinfor` */

LOCK TABLES `customerbaseinfor` WRITE;

insert  into `customerbaseinfor`(`cid`,`Name`,`BD`,`TechName`,`Contact`,`TelePhone`,`CompanyAddress`,`CompanyTelephone`,`QQ`,`Email`,`ParentCompanyID`,`CompanyLevel`,`Memo`,`EX1`,`EX2`,`EX3`,`EX4`,`EX5`,`EX6`,`EX7`,`EX8`,`EX9`,`EX10`) values (1,'智龙','陈蓉','奚文杰','王先生','010-85145252','中国北京市中关村软件园','010-85145252','61112525','wang@comp.com',NULL,'A',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

UNLOCK TABLES;

/*Table structure for table `customerequestrecord` */

DROP TABLE IF EXISTS `customerequestrecord`;

CREATE TABLE `customerequestrecord` (
  `wpid` varchar(10) NOT NULL,
  `requestime` datetime DEFAULT NULL,
  `uid` int(8) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `reason` varchar(45) DEFAULT NULL,
  `qid` int(8) DEFAULT NULL,
  `pid` int(8) DEFAULT NULL,
  `completetime` datetime DEFAULT NULL,
  PRIMARY KEY (`wpid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `customerequestrecord` */

LOCK TABLES `customerequestrecord` WRITE;

UNLOCK TABLES;

/*Table structure for table `customerlevel` */

DROP TABLE IF EXISTS `customerlevel`;

CREATE TABLE `customerlevel` (
  `clid` int(8) NOT NULL AUTO_INCREMENT,
  `Level` varchar(2) DEFAULT NULL,
  `Description` varchar(10) DEFAULT NULL,
  `CustomerLevelcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`clid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `customerlevel` */

LOCK TABLES `customerlevel` WRITE;

insert  into `customerlevel`(`clid`,`Level`,`Description`,`CustomerLevelcol`) values (1,'A','正式客户',NULL),(2,'B','VIP客户',NULL),(3,'C','测试客户',NULL);

UNLOCK TABLES;

/*Table structure for table `questioncategory` */

DROP TABLE IF EXISTS `questioncategory`;

CREATE TABLE `questioncategory` (
  `qid` int(8) NOT NULL,
  `Description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `questioncategory` */

LOCK TABLES `questioncategory` WRITE;

UNLOCK TABLES;

/*Table structure for table `requestprocess` */

DROP TABLE IF EXISTS `requestprocess`;

CREATE TABLE `requestprocess` (
  `rpid` int(8) DEFAULT NULL,
  `wpid` int(8) NOT NULL,
  `uid` int(8) DEFAULT NULL,
  `AcceptTime` datetime NOT NULL,
  `DeliverUID` int(8) DEFAULT NULL,
  `DeliverTime` datetime DEFAULT NULL,
  `QuestionDescription` varchar(255) DEFAULT NULL,
  `ProcessingMethod` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`wpid`,`AcceptTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `requestprocess` */

LOCK TABLES `requestprocess` WRITE;

UNLOCK TABLES;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `uid` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
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

insert  into `user`(`uid`,`username`,`password`,`Name`,`Telephone`,`Mobilephone`,`Address`,`Type`,`EX1`,`EX2`,`EX3`,`EX4`,`EX5`,`EX6`,`EX7`,`EX8`,`EX9`,`EX10`) values (1,'xwj','','奚文杰','0510-66613111','15061508667','无锡市滨湖区慧泽西路科教软件园B区6号华云数据大厦','技术',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'wlj','','王立杰','0510-66613111','15370242350','无锡市滨湖区慧泽西路科教软件园B区6号华云数据大厦','技术',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'zl','','朱丽','0510-66613111','13800001111','无锡市滨湖区慧泽西路科教软件园B区6号华云数据大厦','技术',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'cr','','陈蓉','0510-66613111','13800002222','无锡市滨湖区慧泽西路科教软件园B区6号华云数据大厦','BD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
