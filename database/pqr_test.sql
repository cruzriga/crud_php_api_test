/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80017
 Source Host           : localhost:3306
 Source Schema         : pqr_test

 Target Server Type    : MySQL
 Target Server Version : 80017
 File Encoding         : 65001

 Date: 04/07/2020 08:54:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for estados_pqr
-- ----------------------------
DROP TABLE IF EXISTS `estados_pqr`;
CREATE TABLE `estados_pqr`  (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_estado`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of estados_pqr
-- ----------------------------
INSERT INTO `estados_pqr` VALUES (1, 'NUEVO');
INSERT INTO `estados_pqr` VALUES (2, 'EN EJECUCIÓN');
INSERT INTO `estados_pqr` VALUES (3, 'CERRADO');

-- ----------------------------
-- Table structure for pqrs
-- ----------------------------
DROP TABLE IF EXISTS `pqrs`;
CREATE TABLE `pqrs`  (
  `pqr_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_id` int(11) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `estado` int(1) NULL DEFAULT NULL,
  `asunto` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `creado` datetime(0) NULL DEFAULT NULL,
  `vence` date NULL DEFAULT NULL,
  PRIMARY KEY (`pqr_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pqrs
-- ----------------------------
INSERT INTO `pqrs` VALUES (1, 1, 2, 1, 'una petición ', '2020-07-04 04:58:18', '2020-07-14');
INSERT INTO `pqrs` VALUES (2, 1, 2, 1, 'hola mundo', '2020-07-04 15:26:20', '2020-07-11');
INSERT INTO `pqrs` VALUES (3, 2, 2, 1, 'prueba de pqr', '2020-07-04 15:29:27', '2020-07-07');
INSERT INTO `pqrs` VALUES (4, 3, 2, 1, 'prueba de pqr', '2020-07-04 15:30:37', '2020-07-06');

-- ----------------------------
-- Table structure for tipo_pqr
-- ----------------------------
DROP TABLE IF EXISTS `tipo_pqr`;
CREATE TABLE `tipo_pqr`  (
  `tipo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `dias` int(3) NULL DEFAULT NULL,
  PRIMARY KEY (`tipo_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_pqr
-- ----------------------------
INSERT INTO `tipo_pqr` VALUES (1, 'Peticion', 7);
INSERT INTO `tipo_pqr` VALUES (2, 'Queja', 3);
INSERT INTO `tipo_pqr` VALUES (3, 'Reclamo', 2);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'cliente',
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 2, 'admin', 'Administrador', 'e10adc3949ba59abbe56e057f20f883e', 'prv_e10adc3949ba59abbe56e057f20f883e', 'administrador');
INSERT INTO `usuarios` VALUES (2, 1, 'Mrivera', 'Mario rivera ', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'cliente');

SET FOREIGN_KEY_CHECKS = 1;
