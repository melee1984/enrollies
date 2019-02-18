/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : test2019

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-02-17 17:56:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_examinee`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_examinee`;
CREATE TABLE `tbl_examinee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_examinee
-- ----------------------------
INSERT INTO `tbl_examinee` VALUES ('1', '2019-02-17 16:49:21', null, '2', '0');

-- ----------------------------
-- Table structure for `tbl_school`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_school`;
CREATE TABLE `tbl_school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_school
-- ----------------------------
INSERT INTO `tbl_school` VALUES ('1', 'STI');

-- ----------------------------
-- Table structure for `tbl_status`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_status`;
CREATE TABLE `tbl_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_status
-- ----------------------------
INSERT INTO `tbl_status` VALUES ('1', 'Examinee');
INSERT INTO `tbl_status` VALUES ('2', 'Board Passer');

-- ----------------------------
-- Table structure for `tbl_student`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_student`;
CREATE TABLE `tbl_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `fname` varchar(75) DEFAULT NULL,
  `lname` varchar(75) DEFAULT NULL,
  `mname` varchar(75) DEFAULT NULL,
  `campus_eligibility` varchar(50) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `division` varchar(25) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_student
-- ----------------------------
INSERT INTO `tbl_student` VALUES ('1', null, null, 'Leslie', 'Parba', 'Candelaria', 'Demo - Testing ', '1', 'Not sure', '1');
INSERT INTO `tbl_student` VALUES ('2', null, null, 'Examinee', 'Lastname', 'Capus', 'Another - Testing', '1', 'Not Demo', '1');
