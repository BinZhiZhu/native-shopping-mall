/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 80015
 Source Host           : localhost:3306
 Source Schema         : shopping_db

 Target Server Type    : MySQL
 Target Server Version : 80015
 File Encoding         : 65001

 Date: 08/12/2019 02:35:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_cart
-- ----------------------------
DROP TABLE IF EXISTS `t_cart`;
CREATE TABLE `t_cart`
(
    `Id`        int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
    `userid`    int(11)      DEFAULT NULL COMMENT '关联的用户ID，外键',
    `goodsid`   int(11)      DEFAULT NULL COMMENT '商品ID，外键',
    `goodsname` varchar(255) DEFAULT NULL COMMENT '商品名',
    `price`     double       DEFAULT NULL COMMENT '销售单价',
    `shuliang`  int(11)      DEFAULT NULL COMMENT '购买数量',
    `sumprice`  double       DEFAULT NULL COMMENT '价格小计',
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 5
  DEFAULT CHARSET = utf8;

-- ----------------------------
-- Table structure for t_fenlei
-- ----------------------------
DROP TABLE IF EXISTS `t_fenlei`;
CREATE TABLE `t_fenlei`
(
    `Id`    int(11) NOT NULL AUTO_INCREMENT COMMENT '数据库主键',
    `fname` varchar(255) DEFAULT NULL COMMENT '商品分类名',
    `mid`   int(11)      DEFAULT '0' COMMENT '商户ID',
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 13
  DEFAULT CHARSET = utf8;

-- ----------------------------
-- Records of t_fenlei
-- ----------------------------
BEGIN;
INSERT INTO `t_fenlei`
VALUES (11, '水仙花', 5);
INSERT INTO `t_fenlei`
VALUES (12, 'merch1分类', 6);
COMMIT;

-- ----------------------------
-- Table structure for t_goods
-- ----------------------------
DROP TABLE IF EXISTS `t_goods`;
CREATE TABLE `t_goods`
(
    `Id`        int(11) NOT NULL AUTO_INCREMENT COMMENT '数据库主键',
    `fenleiid`  int(11)       DEFAULT NULL COMMENT '关联的分类Id,外键',
    `fname`     varchar(255)  DEFAULT NULL COMMENT '商品分类名称',
    `pname`     varchar(255)  DEFAULT NULL COMMENT '商品名',
    `pic`       varchar(255)  DEFAULT NULL COMMENT '商品图片',
    `price`     double        DEFAULT NULL COMMENT '销售价格',
    `xiangqing` varchar(3000) DEFAULT NULL COMMENT '商品详情',
    `tuijian`   varchar(255)  DEFAULT NULL COMMENT '是否推荐',
    `buys`      int(11)       DEFAULT NULL COMMENT '销量',
    `vist`      int(11)       DEFAULT NULL COMMENT '点击数',
    `ctime`     varchar(255)  DEFAULT NULL COMMENT '添加时间',
    `mid`       int(11)       DEFAULT '0' COMMENT '商户ID',
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARSET = utf8;

-- ----------------------------
-- Records of t_goods
-- ----------------------------
BEGIN;
INSERT INTO `t_goods`
VALUES (1, 11, '水仙花', '鲜花', '5debb1b487d776256.jpg', 1200, 'xxx', '未推荐', 6, 9, '2019-12-07', 5);
INSERT INTO `t_goods`
VALUES (2, 12, 'merch1分类', 'mech1', '5debe850b95297369.jpg', 111, '1111', '未推荐', 0, 0, '2019-12-08', 6);
COMMIT;

-- ----------------------------
-- Table structure for t_orders
-- ----------------------------
DROP TABLE IF EXISTS `t_orders`;
CREATE TABLE `t_orders`
(
    `Id`         int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
    `ordersid`   varchar(255) DEFAULT NULL COMMENT '订单号',
    `userid`     int(11)      DEFAULT NULL COMMENT '所属的用户，外键',
    `username`   varchar(255) DEFAULT NULL COMMENT '订单所属的用户名',
    `address`    varchar(255) DEFAULT NULL COMMENT '收货地址',
    `tel`        varchar(255) DEFAULT NULL COMMENT '手机号码',
    `remark`     varchar(255) DEFAULT NULL COMMENT '备注',
    `ctime`      varchar(255) DEFAULT NULL COMMENT '生成时间',
    `totalprice` varchar(255) DEFAULT NULL COMMENT '价格总计',
    `status`     varchar(255) DEFAULT NULL COMMENT '订单状态',
    `name`       varchar(255) DEFAULT NULL COMMENT '收货人姓名',
    `goodsinfo`  varchar(255) DEFAULT NULL COMMENT '商品购买详情',
    `payway`     varchar(255) DEFAULT NULL COMMENT '支付方式',
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 6
  DEFAULT CHARSET = utf8;

-- ----------------------------
-- Records of t_orders
-- ----------------------------
BEGIN;
INSERT INTO `t_orders`
VALUES (1, '20191207182149', 2, '123456', '华', '13794723811', '', '2019-12-07 18:21:49', '2400', '已收货', '红色可乐',
        '商品名:鲜花,销售单价:1200,购买数量:2,价格小计:2400<br/>', '银联支付');
INSERT INTO `t_orders`
VALUES (2, '20191208014352', 2, '123456', 'one', '13242301527', 'kkk', '2019-12-08 01:43:52', '1200', '未发货', 'admin',
        '商品名:鲜花,销售单价:1200,购买数量:1,价格小计:1200<br/>', '银联支付');
INSERT INTO `t_orders`
VALUES (3, '20191208014517', 2, '123456', 'one', '13242301527', '', '2019-12-08 01:45:17', '1200', '未发货', '测试',
        '商品名:鲜花,销售单价:1200,购买数量:1,价格小计:1200<br/>', '银联支付');
INSERT INTO `t_orders`
VALUES (4, '20191208014631', 2, '123456', 'one', '13242301527', '', '2019-12-08 01:46:31', NULL, '未发货', '测试', NULL,
        '银联支付');
INSERT INTO `t_orders`
VALUES (5, '20191208014658', 2, '123456', 'one', '13242301527', '', '2019-12-08 01:46:58', '1200', '已收货', 'admin',
        '商品名:鲜花,销售单价:1200,购买数量:1,价格小计:1200<br/>', '银联支付');
COMMIT;

-- ----------------------------
-- Table structure for t_pingjia
-- ----------------------------
DROP TABLE IF EXISTS `t_pingjia`;
CREATE TABLE `t_pingjia`
(
    `Id`        int(11) NOT NULL AUTO_INCREMENT COMMENT '数据库主键',
    `ordersid`  int(11)       DEFAULT NULL COMMENT '关联的订单ID，外键',
    `goodsid`   int(11)       DEFAULT NULL COMMENT '关联的商品ID，外键',
    `goodsname` varchar(255)  DEFAULT NULL COMMENT '商品名',
    `shuliang`  int(11)       DEFAULT NULL COMMENT '商品购买数量',
    `price`     double        DEFAULT NULL COMMENT '销售单价',
    `pcontent`  varchar(3000) DEFAULT NULL COMMENT '评价内容',
    `pleixing`  varchar(255)  DEFAULT NULL COMMENT '评价类型,好评/中评/差评',
    `ctime`     varchar(255)  DEFAULT NULL COMMENT '评价时间',
    `userid`    varchar(255)  DEFAULT NULL COMMENT '评价用户ID',
    `username`  varchar(255)  DEFAULT NULL COMMENT '评价用户的用户名',
    `name`      varchar(255)  DEFAULT NULL COMMENT '评价用户姓名',
    `status`    varchar(255)  DEFAULT NULL COMMENT '评价状态 未评价/已评价',
    `mid`       int(11)       DEFAULT '0' COMMENT '商户ID',
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 5
  DEFAULT CHARSET = utf8;

-- ----------------------------
-- Records of t_pingjia
-- ----------------------------
BEGIN;
INSERT INTO `t_pingjia`
VALUES (1, 1, 1, '鲜花', 2, 1200, 'hjsdas', '好评', '2019-12-08 01:48:13', '2', '123456', '123456', '已评价', 0);
INSERT INTO `t_pingjia`
VALUES (2, 2, 1, '鲜花', 1, 1200, NULL, NULL, NULL, '2', '123456', '测试姓名', '未评价', 0);
INSERT INTO `t_pingjia`
VALUES (3, 3, 1, '鲜花', 1, 1200, NULL, NULL, NULL, '2', '123456', '测试姓名', '未评价', 0);
INSERT INTO `t_pingjia`
VALUES (4, 5, 1, '鲜花', 1, 1200, 'asdas', '好评', '2019-12-08 01:49:08', '2', '123456', '测试姓名', '已评价', 5);
COMMIT;

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user`
(
    `Id`       int(11) NOT NULL AUTO_INCREMENT COMMENT '数据库主键',
    `username` varchar(255) DEFAULT NULL COMMENT '用户名',
    `password` varchar(255) DEFAULT NULL COMMENT '密码',
    `role`     int(11)      DEFAULT NULL COMMENT '用户角色，1表示系统管理员，2表示用户',
    `name`     varchar(255) DEFAULT NULL COMMENT '姓名',
    `tel`      varchar(255) DEFAULT NULL COMMENT '手机号码',
    `address`  varchar(255) DEFAULT NULL COMMENT '收货地址',
    `ctime`    varchar(255) DEFAULT NULL COMMENT '注册时间',
    `avatar`   varchar(255) DEFAULT '' COMMENT '头像',
    PRIMARY KEY (`Id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 7
  DEFAULT CHARSET = utf8;

-- ----------------------------
-- Records of t_user
-- ----------------------------
BEGIN;
INSERT INTO `t_user`
VALUES (1, 'admin', '111111', 1, '系统管理员', NULL, NULL, NULL, '');
INSERT INTO `t_user`
VALUES (2, '123456', '123456', 2, '测试姓名', '13794723811', '测试地址咯', '2019-12-07', '');
INSERT INTO `t_user`
VALUES (5, 'merch', '1234qwqw', 3, '商家啦111', '13242301527', '', '2019-12-08', '5debeebe894857780.jpeg');
INSERT INTO `t_user`
VALUES (6, 'merch1', '1234qwqw', 3, '商家11', '13242301527', '', '2019-12-08', '5debefe44b69d2952.jpeg');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
