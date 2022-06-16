

/*
21232f297a57a5a743894a0e4a801fc3
 Navicat Premium Data Transfer

 Source Server         : localhost1
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : barang_penjualan

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 16/06/2022 09:22:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `jenis_barang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tipe_barang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_supplier` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `harga_jual` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `harga_modal` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `add_date` datetime NOT NULL,
  `upd_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for barang_keluar_masuk
-- ----------------------------
DROP TABLE IF EXISTS `barang_keluar_masuk`;
CREATE TABLE `barang_keluar_masuk`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) NOT NULL,
  `jenis` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `add_date` datetime NULL DEFAULT NULL,
  `upd_date` datetime NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_harga_jual` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `total_harga_modal` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `add_date` datetime NULL DEFAULT NULL,
  `upd_date` datetime NULL DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for transaksi_detail
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_detail`;
CREATE TABLE `transaksi_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) NOT NULL,
  `harga_jual_satuan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `harga_modal_satuan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `transaksi_id` int(11) NULL DEFAULT NULL,
  `harga_modal_total` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `add_date` datetime NULL DEFAULT NULL,
  `upd_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `add_date` datetime NULL DEFAULT NULL,
  `upd_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- View structure for view_barang_sumary
-- ----------------------------
DROP VIEW IF EXISTS `view_barang_sumary`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_barang_sumary` AS SELECT 
barang_id,
sum(case when jenis = 'masuk' then qty else 0 end) AS `item_masuk`,
sum(case when jenis = 'keluar' then qty else 0 end) AS `item_keluar`,
sum(case when jenis = 'jual' then qty else 0 end) AS `item_jual`

FROM barang_keluar_masuk
GROUP BY barang_id ;

-- ----------------------------
-- View structure for view_stok
-- ----------------------------
DROP VIEW IF EXISTS `view_stok`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_stok` AS SELECT barang_id, item_masuk - item_jual - item_keluar as stok FROM view_barang_sumary ;

SET FOREIGN_KEY_CHECKS = 1;
