/*
Navicat MySQL Data Transfer

Source Server         : mydemo
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : excel

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-10-07 09:08:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dc
-- ----------------------------
DROP TABLE IF EXISTS `dc`;
CREATE TABLE `dc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '姓名',
  `money` decimal(15,2) NOT NULL COMMENT '金额',
  `time` int(50) unsigned NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dc
-- ----------------------------
INSERT INTO `dc` VALUES ('1', 'yufan956932910', '5000000.88', '1477369348');
INSERT INTO `dc` VALUES ('2', 'qq956932910', '10000000.88', '1477369348');
INSERT INTO `dc` VALUES ('3', 'qq956932910', '10000000.88', '1477369350');
INSERT INTO `dc` VALUES ('4', 'yufan956932910', '5000000.88', '1477369348');
INSERT INTO `dc` VALUES ('5', 'qq956932910', '10000000.88', '1477369348');
INSERT INTO `dc` VALUES ('6', 'qq956932910', '10000000.88', '1477369350');
INSERT INTO `dc` VALUES ('7', '赵鹏', '5000000.88', '1477369348');
INSERT INTO `dc` VALUES ('8', 'qq956932910', '10000000.88', '1477369348');
INSERT INTO `dc` VALUES ('9', 'yufan956932910', '5000000.88', '1540441348');
INSERT INTO `dc` VALUES ('10', 'qq956932910', '10000000.88', '1508905348');
INSERT INTO `dc` VALUES ('11', 'qq956932910', '10000000.88', '1445746950');
INSERT INTO `dc` VALUES ('12', 'yufan956932910', '5000000.88', '1480047748');
INSERT INTO `dc` VALUES ('13', 'qq956932910', '10000000.88', '1477023748');
INSERT INTO `dc` VALUES ('14', 'qq956932910', '10000000.88', '1477369350');
INSERT INTO `dc` VALUES ('15', '赵鹏', '5000000.88', '1477369348');
INSERT INTO `dc` VALUES ('16', 'qq956932910', '10000000.88', '1477369348');
INSERT INTO `dc` VALUES ('17', 'qq956932910', '10000000.88', '1477369350');
