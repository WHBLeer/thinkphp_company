-- MySQL dump 10.14  Distrib 5.5.60-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: db_hatch
-- ------------------------------------------------------
-- Server version	5.5.60-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `hatch_about`
--

DROP TABLE IF EXISTS `hatch_about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_about` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '标题',
  `introduction` text NOT NULL COMMENT '简介',
  `content` text NOT NULL COMMENT '栏目内容',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `browse` int(11) unsigned zerofill NOT NULL COMMENT '浏览次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_about`
--
--
-- Table structure for table `hatch_admin`
--

DROP TABLE IF EXISTS `hatch_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_admin` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `name` varchar(30) NOT NULL COMMENT '管理员名称',
  `password` char(32) NOT NULL COMMENT '管理员密码',
  `nickname` varchar(20) NOT NULL COMMENT '昵称',
  `avatar` varchar(160) NOT NULL COMMENT '管理员头像',
  `email` char(50) NOT NULL COMMENT '管理员邮箱',
  `telephone` char(30) NOT NULL COMMENT '管理员电话',
  `address` varchar(200) NOT NULL COMMENT '管理员地址',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_admin`
--

LOCK TABLES `hatch_admin` WRITE;
/*!40000 ALTER TABLE `hatch_admin` DISABLE KEYS */;
INSERT INTO `hatch_admin` VALUES (1,'admin','5f4dcc3b5aa765d61d8327deb882cf99','创文时代','20181028/6748638f03c8a5ba35a2af1d137687ad.jpg','','','','2019-01-14 13:04:45','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `hatch_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hatch_banner`
--

DROP TABLE IF EXISTS `hatch_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_banner` (
  `id` mediumint(1) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `type` int(11) unsigned zerofill NOT NULL COMMENT '类别',
  `tltle` char(100) NOT NULL DEFAULT '' COMMENT '名称',
  `subtitle` char(100) NOT NULL DEFAULT '' COMMENT '副标题',
  `banner` char(100) NOT NULL DEFAULT '' COMMENT 'banner文件',
  `link` char(100) NOT NULL DEFAULT '' COMMENT 'banner链接',
  `content` text NOT NULL COMMENT 'banner介绍',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_banner`
--

LOCK TABLES `hatch_banner` WRITE;
/*!40000 ALTER TABLE `hatch_banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `hatch_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hatch_cate`
--

DROP TABLE IF EXISTS `hatch_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_cate` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '栏目id',
  `catename` varchar(30) NOT NULL COMMENT '栏目名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '栏目类型：1:文章列表栏目 2:单页栏目3：图片列表',
  `keywords` varchar(255) NOT NULL COMMENT '栏目关键词',
  `desc` varchar(255) NOT NULL COMMENT '栏目描述',
  `content` text NOT NULL COMMENT '栏目内容',
  `rec_index` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:不推荐 1：推荐',
  `rec_bottom` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:不推荐 1：推荐',
  `pid` mediumint(9) NOT NULL DEFAULT '0' COMMENT '上级栏目id',
  `sort` mediumint(9) NOT NULL DEFAULT '50' COMMENT '排序',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_cate`
--

LOCK TABLES `hatch_cate` WRITE;
/*!40000 ALTER TABLE `hatch_cate` DISABLE KEYS */;
INSERT INTO `hatch_cate` VALUES (1,'关于我们',2,'关于我们关于我们','关于我们','<p>关于我们</p>',0,1,3,1,'2018-10-27 08:19:06','0000-00-00 00:00:00',NULL),(2,'行业新闻',1,'公司简介','公司简介公司简介公司简介公司简介公司简介','<p>公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介</p>',1,1,0,1,'2019-02-21 09:17:51','0000-00-00 00:00:00',NULL),(3,'企业动态',2,'企业动态','企业动态','<p>新闻动态新闻动态新闻动态新闻动态新闻动态</p>',1,1,0,2,'2018-10-28 10:16:01','0000-00-00 00:00:00',NULL),(4,'通知公告',1,'通知，公告，动态','通知公告通知公告通知公告','',1,0,3,2,'2018-10-27 08:23:24','0000-00-00 00:00:00',NULL),(5,'明星企业',2,'测试明星，企业','明星企业','',1,1,0,3,'2018-10-28 10:16:01','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `hatch_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hatch_conf`
--

DROP TABLE IF EXISTS `hatch_conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_conf` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '配置项id',
  `cnname` varchar(50) NOT NULL COMMENT '配置中文名称',
  `enname` varchar(50) NOT NULL COMMENT '英文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '配置类型 1：单行文本框 2：多行文本 3：单选按钮 4：复选按钮 5：下拉菜单 6：文件选择',
  `value` varchar(255) NOT NULL COMMENT '配置值',
  `values` varchar(255) NOT NULL COMMENT '配置可选值',
  `links` varchar(255) DEFAULT NULL COMMENT 'banner链接',
  `sort` smallint(6) NOT NULL DEFAULT '50' COMMENT '配置项排序',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_conf`
--

LOCK TABLES `hatch_conf` WRITE;
/*!40000 ALTER TABLE `hatch_conf` DISABLE KEYS */;
INSERT INTO `hatch_conf` VALUES (1,'网站标题','webtitle',1,'创文时代孵化器官方网站','',NULL,1,'2019-01-18 13:14:13','0000-00-00 00:00:00',0),
(2,'网站关键字','webkeyword',1,'创文时代孵化器官方网站','',NULL,1,'2019-01-18 13:14:13','0000-00-00 00:00:00',0),
(3,'网站介绍','webdesc',2,'创文时代孵化器官方网站','',NULL,1,'2019-01-18 13:14:13','0000-00-00 00:00:00',0),
(4,'网站作者','webauthor',1,'创文时代孵化器','',NULL,1,'2019-01-18 13:14:13','0000-00-00 00:00:00',0),
(5,'ICP备案号','webicp',1,'京ICP备16038199号-2','',NULL,1,'2019-01-14 01:17:23','0000-00-00 00:00:00',0),
(6,'第三方统计代码','statistics',2,'','',NULL,1,'2018-12-28 09:46:25','0000-00-00 00:00:00',0),
(7,'公安网备案号','webgicp',1,'','',NULL,1,'2019-01-18 13:13:21','0000-00-00 00:00:00',0),
(8,'网站域名','weburl',1,'http://www.wi-win.cn','',NULL,1,'2019-01-14 01:17:23','0000-00-00 00:00:00',0),
(9,'首页banner','index_banner',7,'20190118/e2d745262f6a0e01f1768fe755d80549.jpeg,20190114/6431fe0897941c4a559fd32a5d48660d.jpg,20190114/e19888b5f9ba3c15057bd0ee5262724e.jpg','',NULL,2,'2019-01-18 12:21:22','0000-00-00 00:00:00',NULL),
(10,'内页banner','inner_banner',6,'20190114/1cf4772707c8a5e61e4513b768bbb557.png','',NULL,2,'2019-01-14 01:18:09','0000-00-00 00:00:00',NULL),
(11,'地址栏图标','favicon',6,'20190117/5bc22085bacde43ce6f1b0ab4fc41b7f.png','',NULL,2,'2019-01-17 13:31:00','0000-00-00 00:00:00',NULL),
(12,'SMTP服务器地址','smtphost',1,'smtp.ym.163.com','',NULL,3,'2019-01-14 01:17:35','0000-00-00 00:00:00',NULL),
(13,'邮箱用户名','smtpname',1,'server@domin.com','',NULL,3,'2019-01-14 01:17:35','0000-00-00 00:00:00',NULL),
(14,'邮箱授权密码','smtppwd',1,'xxxxxxx','',NULL,3,'2019-01-14 07:20:06','0000-00-00 00:00:00',NULL),
(15,'邮箱端口号','smtpport',1,'994','',NULL,3,'2019-01-14 01:17:35','0000-00-00 00:00:00',NULL),
(16,'首页-办公空间','office',1,'办公空间|24小时保安、保洁服务、免费网络、公共服务间','',NULL,4,'2019-01-14 01:14:06','0000-00-00 00:00:00',NULL),
(17,'首页-我们的服务','service',1,'我们的服务|24小时保安、保洁服务、免费网络、公共服务间','',NULL,4,'2019-01-14 01:14:06','0000-00-00 00:00:00',NULL),
(18,'邮件发送者','mailname',1,'XX官方网站','',NULL,3,'2019-01-14 07:20:06','0000-00-00 00:00:00',NULL),
(19,'底部信息','footermsg',2,'','',NULL,50,'2019-01-14 07:39:18','0000-00-00 00:00:00',NULL),
(20,'底部图标','footericon',6,'20190120/033e970b5f18f29062510eb2eb96a09a.png','',NULL,2,'2019-01-20 04:17:44','0000-00-00 00:00:00',NULL),
(21,'底部二维码','footerewm',6,'20190120/a0ea0228b8a58c966b179e8e60182f01.jpg','',NULL,2,'2019-01-20 03:50:47','0000-00-00 00:00:00',NULL),
(22,'管理员邮箱','webemail',1,'12345678@qq.com','',NULL,1,'2019-01-18 13:13:05','0000-00-00 00:00:00',NULL),
(23,'联系电话','telephone',1,'010-12345678','',NULL,1,'2019-01-18 13:13:05','0000-00-00 00:00:00',NULL),
(24,'联系地址','address',1,'北京市海淀区上地信息路甲28号科实大厦D座1101室','',NULL,1,'2019-01-14 07:51:03','0000-00-00 00:00:00',NULL);
/*!40000 ALTER TABLE `hatch_conf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hatch_dictitem`
--

DROP TABLE IF EXISTS `hatch_dictitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_dictitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `type` int(11) NOT NULL COMMENT '类别',
  `cnname` varchar(255) NOT NULL COMMENT '名称',
  `enname` varchar(255) NOT NULL COMMENT '名称',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) NOT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_dictitem`
--

LOCK TABLES `hatch_dictitem` WRITE;
/*!40000 ALTER TABLE `hatch_dictitem` DISABLE KEYS */;
INSERT INTO `hatch_dictitem` VALUES (1,1,'电子信息技术','','2019-01-17 03:08:09','0000-00-00 00:00:00',0),
(2,1,'电子信息技术','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(3,1,'文化教育产业','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(4,1,'航空航天技术','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(5,1,'生物与新医药技术','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(6,1,'新材料技术','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(7,1,'资源与环境技术','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(8,1,'高新技术改造传统产业','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(9,1,'金融业','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(10,1,'其他','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(11,2,'大数据','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(12,2,'移动互联网和下一代互联网','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(13,2,'云计算','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(14,2,'集成电路设计','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(15,2,'导航与位置服务','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(16,2,'生物工程与新医药','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(17,2,'新型材料新能源和节能环保','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(18,2,'文化创新产业','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(19,2,'科技服务企业','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(20,2,'其他','','2019-01-17 03:21:29','0000-00-00 00:00:00',0),
(21,3,'国家级','','2019-01-17 07:25:58','0000-00-00 00:00:00',0),
(22,3,'北京市','','2019-01-17 07:26:09','0000-00-00 00:00:00',0),
(23,3,'中关村','','2019-01-17 07:26:21','0000-00-00 00:00:00',0),
(24,3,'海淀区','','2019-01-17 15:25:17','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `hatch_dictitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hatch_entering`
--

DROP TABLE IF EXISTS `hatch_entering`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_entering` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `type` int(11) unsigned zerofill NOT NULL COMMENT '类别',
  `pic` char(100) NOT NULL DEFAULT '' COMMENT '图片',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '入孵指南',
  `content` text NOT NULL COMMENT '栏目内容',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `browse` int(11) unsigned zerofill NOT NULL COMMENT '浏览次数',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_entering`
--

--
-- Table structure for table `hatch_guide`
--

DROP TABLE IF EXISTS `hatch_guide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_guide` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `companyname` varchar(30) NOT NULL COMMENT '企业名称',
  `creditcode` char(32) NOT NULL COMMENT '统一社会信用代码',
  `legalperson` char(32) NOT NULL COMMENT '法人姓名',
  `legalphone` char(32) NOT NULL COMMENT '法人联系电话',
  `officeaddress` varchar(255) NOT NULL COMMENT '实际办公地址',
  `registaddress` varchar(255) NOT NULL COMMENT '注册地址',
  `registmoney` int(11) NOT NULL DEFAULT '0' COMMENT '注册资金',
  `belongfield` varchar(255) NOT NULL COMMENT '所属领域',
  `techefield` varchar(255) NOT NULL COMMENT '技术领域',
  `companytotal` int(11) NOT NULL DEFAULT '0' COMMENT '企业人数',
  `zf` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否获得政府奖励',
  `lx` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为留学归国创业',
  `sb` tinyint(1) NOT NULL DEFAULT '0' COMMENT '社保登记',
  `gs` tinyint(1) NOT NULL DEFAULT '0' COMMENT '工商登记',
  `gx` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为高新技术企业',
  `entertime` int(11) NOT NULL DEFAULT '0' COMMENT '入驻中心时间',
  `contact1` char(32) NOT NULL COMMENT '财务联系人',
  `contacttel1` char(32) NOT NULL COMMENT '财务联系电话',
  `contact2` char(32) NOT NULL COMMENT '其他联系人',
  `contacttel2` char(32) NOT NULL COMMENT '其他联系电话',
  `introduction` text NOT NULL COMMENT '公司或业务，产品简介',
  `rz` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否获得投，融资',
  `times` int(11) NOT NULL DEFAULT '0' COMMENT '融资轮次',
  `financingmoney` int(11) NOT NULL DEFAULT '0' COMMENT '融资金额（万元）',
  `financingplan` text NOT NULL COMMENT '未来融资计划',
  `bg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否被并购',
  `sh` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否上市',
  `property` int(11) NOT NULL DEFAULT '0' COMMENT '知识产权总数',
  `patent` int(11) NOT NULL DEFAULT '0' COMMENT '发明专利数量',
  `software` int(11) NOT NULL DEFAULT '0' COMMENT '软件著作权数量',
  `trademark` int(11) NOT NULL DEFAULT '0' COMMENT '注册商标数量',
  `scale` varchar(255) NOT NULL COMMENT '企业规模类型',
  `nb` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否完成年报工作',
  `abnormal` text NOT NULL COMMENT '异常原因',
  `total1` int(11) NOT NULL DEFAULT '0' COMMENT '年收入（万元）',
  `total2` int(11) NOT NULL DEFAULT '0' COMMENT '年利润（万元）',
  `total3` int(11) NOT NULL DEFAULT '0' COMMENT '年纳税（万元）',
  `total4` int(11) NOT NULL DEFAULT '0' COMMENT '年研发投入（万元）',
  `indorsation` text NOT NULL COMMENT '希望获得哪方面的服务和支持',
  `reservationid` mediumint(9) NOT NULL COMMENT '预约id',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_guide`
--

--
-- Table structure for table `hatch_news`
--

DROP TABLE IF EXISTS `hatch_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_news` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(60) NOT NULL COMMENT '文章标题',
  `keywords` varchar(100) NOT NULL COMMENT '关键词',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `author` varchar(30) NOT NULL COMMENT '作者',
  `thumb` varchar(160) NOT NULL COMMENT '缩略图',
  `content` text NOT NULL COMMENT '内容',
  `click` mediumint(9) NOT NULL DEFAULT '0' COMMENT '点击数',
  `zan` mediumint(9) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `rec` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:不推荐 1：推荐',
  `cateid` mediumint(9) NOT NULL COMMENT '所属栏目',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_news`
--

--
-- Table structure for table `hatch_office`
--

DROP TABLE IF EXISTS `hatch_office`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_office` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sort` smallint(6) NOT NULL COMMENT '排序',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '办公空间',
  `album` varchar(160) NOT NULL COMMENT '办公空间照片',
  `content` text NOT NULL COMMENT '办公空间详情',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_office`
--

--
-- Table structure for table `hatch_partner`
--

DROP TABLE IF EXISTS `hatch_partner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_partner` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '链接id',
  `title` varchar(60) NOT NULL COMMENT '名称',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `pic` varchar(255) NOT NULL COMMENT 'logo',
  `url` varchar(160) NOT NULL COMMENT '地址',
  `sort` mediumint(9) NOT NULL DEFAULT '50' COMMENT '排序',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_partner`
--

--
-- Table structure for table `hatch_regulation`
--

DROP TABLE IF EXISTS `hatch_regulation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_regulation` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `click` int(11) NOT NULL,
  `type` int(11) unsigned zerofill NOT NULL COMMENT '类别',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '政策法规库',
  `content` text NOT NULL COMMENT '栏目内容',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `browse` int(11) unsigned zerofill NOT NULL COMMENT '浏览次数',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_regulation`
--

--
-- Table structure for table `hatch_reservation`
--

DROP TABLE IF EXISTS `hatch_reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_reservation` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `companyname` varchar(30) NOT NULL COMMENT '企业名称',
  `legalperson` char(32) NOT NULL COMMENT '企业负责人名称',
  `legalphone` char(32) NOT NULL COMMENT '企业负责人联系电话',
  `service` int(11) NOT NULL DEFAULT '0' COMMENT '预约的服务',
  `indorsation` text NOT NULL COMMENT '希望获得哪方面的服务和支持',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_reservation`
--

--
-- Table structure for table `hatch_service`
--

DROP TABLE IF EXISTS `hatch_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_service` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `type` int(1) NOT NULL COMMENT '显示位置',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '我们的服务',
  `icon` char(100) NOT NULL DEFAULT '' COMMENT '图标',
  `desc` text NOT NULL COMMENT '内容',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_service`
--

--
-- Table structure for table `hatch_style`
--

DROP TABLE IF EXISTS `hatch_style`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hatch_style` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `sort` smallint(6) NOT NULL COMMENT '排序',
  `name` char(100) NOT NULL DEFAULT '' COMMENT '员工姓名',
  `photo` varchar(160) NOT NULL COMMENT '员工照片',
  `content` text NOT NULL COMMENT '员工风采',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '新增时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hatch_style`
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-03  0:10:01
