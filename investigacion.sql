/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : investigacion

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2016-12-03 00:40:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for correos
-- ----------------------------
DROP TABLE IF EXISTS `correos`;
CREATE TABLE `correos` (
  `id_correo` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_dest_usuario` int(11) NOT NULL,
  `asunto_correo` varchar(20) NOT NULL,
  `mensaje_correo` varchar(160) NOT NULL,
  `status_correo` varchar(9) NOT NULL DEFAULT 'NO LEIDO',
  `fecha_correo` datetime NOT NULL,
  PRIMARY KEY (`id_correo`),
  KEY `fk_id2_usuario` (`id_usuario`),
  KEY `fk_id_dest_usuario` (`id_dest_usuario`),
  CONSTRAINT `fk_id2_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `fk_id_dest_usuario` FOREIGN KEY (`id_dest_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for historial_sesiones
-- ----------------------------
DROP TABLE IF EXISTS `historial_sesiones`;
CREATE TABLE `historial_sesiones` (
  `id_historial` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `latitud` varchar(30) NOT NULL,
  `longitud` varchar(30) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  PRIMARY KEY (`id_historial`),
  KEY `fk_id_usuario` (`id_usuario`),
  CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for investigaciones
-- ----------------------------
DROP TABLE IF EXISTS `investigaciones`;
CREATE TABLE `investigaciones` (
  `id_investigacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo` int(11) NOT NULL,
  `titulo_investigacion` varchar(300) NOT NULL,
  `fecha_investigacion` datetime NOT NULL,
  `status_investigacion` varchar(11) NOT NULL DEFAULT 'EN PROGRESO',
  `folio_investigacion` varchar(50) NOT NULL,
  PRIMARY KEY (`id_investigacion`),
  UNIQUE KEY `folio_investigacion` (`folio_investigacion`),
  KEY `fk_id_tipo` (`id_tipo`),
  CONSTRAINT `fk_id_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for perfiles
-- ----------------------------
DROP TABLE IF EXISTS `perfiles`;
CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nombre_perfil` varchar(30) NOT NULL,
  `ap_perfil` varchar(30) NOT NULL,
  `am_perfil` varchar(30) DEFAULT NULL,
  `foto_perfil` varchar(50) DEFAULT NULL,
  `calle_perfil` varchar(30) NOT NULL,
  `num_perfil` varchar(10) NOT NULL,
  `col_perfil` varchar(20) NOT NULL,
  `cp_perfil` varchar(15) DEFAULT 'S/CP',
  `cd_perfil` varchar(20) NOT NULL,
  `estado_perfil` varchar(20) NOT NULL,
  `nacionalidad_perfil` varchar(10) NOT NULL,
  `tel_perfil` varchar(20) DEFAULT 'S/Tel',
  `correo_perfil` varchar(30) NOT NULL,
  `rfc_perfil` varchar(30) DEFAULT 'S/Tel',
  `num_control` varchar(30) DEFAULT 'S/NC',
  PRIMARY KEY (`id_perfil`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `fk_id1_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tiene
-- ----------------------------
DROP TABLE IF EXISTS `tiene`;
CREATE TABLE `tiene` (
  `id_usuario` int(11) NOT NULL,
  `id_investigacion` int(11) NOT NULL,
  `asesor_1` int(11) DEFAULT NULL,
  `asesor_2` int(11) DEFAULT NULL,
  `revisor_1` int(11) DEFAULT NULL,
  `revisor_2` int(11) DEFAULT NULL,
  `fecha_aceptacion` datetime DEFAULT NULL,
  KEY `fk_idd_usuario` (`id_usuario`),
  KEY `fk_idd_investigaciones` (`id_investigacion`),
  CONSTRAINT `fk_idd_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `fk_idd_investigaciones` FOREIGN KEY (`id_investigacion`) REFERENCES `investigaciones` (`id_investigacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tipos
-- ----------------------------
DROP TABLE IF EXISTS `tipos`;
CREATE TABLE `tipos` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_investigacion` varchar(50) NOT NULL,
  `tipo_descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nom_usuario` varchar(25) NOT NULL,
  `pass_usuario` varchar(25) NOT NULL,
  `tipo_usuario` varchar(25) NOT NULL,
  `status_usuario` varchar(25) NOT NULL,
  `fecha_creacion_usuario` datetime NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
SET FOREIGN_KEY_CHECKS=1;
