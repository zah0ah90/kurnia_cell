-- -- query stok;
-- -- create view  view_barang_sumary as 
SELECT 
barang_id,
sum(case when jenis = 'masuk' then qty else 0 end) AS `item_masuk`,
sum(case when jenis = 'keluar' then qty else 0 end) AS `item_keluar`,
sum(case when jenis = 'jual' then qty else 0 end) AS `item_jual`

FROM barang_keluar_masuk
GROUP BY barang_id
;
-- 


SELECT 
item_masuk - item_jual - item_keluar as stok
FROM view_barang_sumary

SELECT *, (SELECT item_masuk - item_jual - item_keluar as stok FROM view_barang_sumary) as stok FROM barang



DROP TABLE IF EXISTS `view_report_pos_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u6033880`@`localhost` SQL SECURITY DEFINER VIEW `view_report_pos_summary`  AS 
SELECT `tbl_trx_penjualan`.`tanggal` AS `tanggal`, 
count(`tbl_trx_penjualan`.`penjualan_id`) AS `jml_struk`, 
sum(`tbl_trx_penjualan`.`total_harga_pokok`) AS `total_harga_pokok`, 
sum(`tbl_trx_penjualan`.`total`) AS `total_harga_jual`, 
sum(`tbl_trx_penjualan`.`total` - `tbl_trx_penjualan`.`total_harga_pokok`) AS `margin`, 
sum(`tbl_trx_penjualan`.`diskon_rupiah`) AS `total_diskon`, 
sum(`tbl_trx_penjualan`.`total_diskon`) AS `net`, min(`tbl_trx_penjualan`.`adddate`) AS `jam_awal`, 
max(`tbl_trx_penjualan`.`adddate`) AS `jam_akhir` 
FROM `tbl_trx_penjualan` 
WHERE `tbl_trx_penjualan`.`status` = '1' 
AND `tbl_trx_penjualan`.`soft_delete` = 0 
GROUP BY `tbl_trx_penjualan`.`tanggal` ;