# Host: localhost  (Version: 5.5.53)
# Date: 2017-03-24 18:08:38
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "ymz_auth_group_access"
#

DROP TABLE IF EXISTS `ymz_auth_group_access`;
CREATE TABLE `ymz_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

#
# Data for table "ymz_auth_group_access"
#

/*!40000 ALTER TABLE `ymz_auth_group_access` DISABLE KEYS */;
INSERT INTO `ymz_auth_group_access` VALUES (1,1),(1,2);
/*!40000 ALTER TABLE `ymz_auth_group_access` ENABLE KEYS */;

#
# Structure for table "ymz_user"
#

DROP TABLE IF EXISTS `ymz_user`;
CREATE TABLE `ymz_user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "ymz_user"
#

INSERT INTO `ymz_user` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3');

#
# Structure for table "yzm_admin_menu"
#

DROP TABLE IF EXISTS `yzm_admin_menu`;
CREATE TABLE `yzm_admin_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父菜单id',
  `path` char(20) NOT NULL DEFAULT '' COMMENT '路径',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '菜单名',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '类别',
  `module` char(30) NOT NULL DEFAULT '' COMMENT '模块',
  `controller` char(30) NOT NULL DEFAULT '' COMMENT '控制器',
  `method` char(30) NOT NULL DEFAULT '' COMMENT '方法',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

#
# Data for table "yzm_admin_menu"
#

/*!40000 ALTER TABLE `yzm_admin_menu` DISABLE KEYS */;
INSERT INTO `yzm_admin_menu` VALUES (103,0,'0,','分类管理',1,'admin','type','index',0,1),(104,0,'0,','内容管理',1,'admin','content','index',0,1),(109,0,'0,','管理账号',1,'admin','admin','x',0,1),(110,109,'109,',' 用户组规则',1,'admin','rule','index',0,1),(111,109,'109,','用户组',1,'admin','group','index',0,1),(112,109,'109,','用户管理',1,'admin','user','index',0,1);
/*!40000 ALTER TABLE `yzm_admin_menu` ENABLE KEYS */;

#
# Structure for table "yzm_auth_group"
#

DROP TABLE IF EXISTS `yzm_auth_group`;
CREATE TABLE `yzm_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '' COMMENT '组名',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户组表';

#
# Data for table "yzm_auth_group"
#

/*!40000 ALTER TABLE `yzm_auth_group` DISABLE KEYS */;
INSERT INTO `yzm_auth_group` VALUES (1,'管理组',1,'1,2');
/*!40000 ALTER TABLE `yzm_auth_group` ENABLE KEYS */;

#
# Structure for table "yzm_auth_rule"
#

DROP TABLE IF EXISTS `yzm_auth_rule`;
CREATE TABLE `yzm_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `type` char(80) NOT NULL DEFAULT '' COMMENT '模块名',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='规则表';

#
# Data for table "yzm_auth_rule"
#

/*!40000 ALTER TABLE `yzm_auth_rule` DISABLE KEYS */;
INSERT INTO `yzm_auth_rule` VALUES (1,'Home/index','列表222',1,'Home',''),(2,'Home/add','添加',1,'Home',''),(3,'Home/edit','编辑',1,'Home',''),(5,'home/ddd','ddd',1,'ddd',''),(6,'fds','gsfg',1,'dfgsdf','gsg'),(7,'fgdsg','sgfsdfg',1,'sgsgsgsg',''),(8,'dgfd','gsgs',1,'gsgs',''),(9,'gsfdgsg','sgsgs',1,'gsgsfg',''),(10,'fsdhsfhs','gsfdgsgfsf',1,'gdfgsfgs',''),(11,'sfgsgsfg','sgfsgs',1,'gfsgsg',''),(12,'fsdgsfg','shgh',1,'sdhs',''),(13,'sfgds','fsfgds',1,'dsdsdsdsdsdsdsdsdsdsdsdsdsdsdsdsds',''),(14,'sfdgsds','gsfdsffffffgsdfgsfgs',1,'fgsgsdg','');
/*!40000 ALTER TABLE `yzm_auth_rule` ENABLE KEYS */;

#
# Structure for table "yzm_content"
#

DROP TABLE IF EXISTS `yzm_content`;
CREATE TABLE `yzm_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '分类',
  `title` char(66) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='基础内容';

#
# Data for table "yzm_content"
#

/*!40000 ALTER TABLE `yzm_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `yzm_content` ENABLE KEYS */;

#
# Structure for table "yzm_type"
#

DROP TABLE IF EXISTS `yzm_type`;
CREATE TABLE `yzm_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `path` char(30) NOT NULL DEFAULT '' COMMENT '路径',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '分类名',
  `describe` char(30) NOT NULL DEFAULT '' COMMENT '描述',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态',
  `info` char(30) NOT NULL DEFAULT '' COMMENT '附表后缀',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='分类';

#
# Data for table "yzm_type"
#

/*!40000 ALTER TABLE `yzm_type` DISABLE KEYS */;
INSERT INTO `yzm_type` VALUES (1,0,'0,','系统','相关',1,'x'),(2,0,'0,','内容','内容相关',1,'x'),(4,2,'0,2,','基础文档','基础文档',1,'x'),(5,2,'0,2,','网站公告','网站公告',1,'x'),(6,1,'0,1,','gsgs','sgsf',1,'x');
/*!40000 ALTER TABLE `yzm_type` ENABLE KEYS */;

#
# Structure for table "yzm_user"
#

DROP TABLE IF EXISTS `yzm_user`;
CREATE TABLE `yzm_user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "yzm_user"
#

