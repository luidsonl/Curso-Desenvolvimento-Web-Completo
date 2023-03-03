DROP DATABASE IF EXISTS dashboard;

create database dashboard collate utf8_unicode_ci;

use dashboard;

create table tb_vendas(
	id int not null primary key auto_increment,
	data_venda datetime default current_timestamp,
	total float(10,2) not null
);

create table tb_clientes(
	id int not null primary key auto_increment,
	cliente_ativo boolean default true
);

create table tb_contatos(
	id int not null primary key auto_increment,
	data_contato datetime default current_timestamp,
	tipo_contato int not null
);

create table tb_despesas(
	id int not null primary key auto_increment,
	data_despesa datetime default current_timestamp,
	total float(10,2) not null
);

-- Popula a tabela de vendas
INSERT INTO `tb_vendas` VALUES (1,'2015-02-07 19:29:38',1033.23),(2,'2020-10-14 04:27:24',1510.21),(3,'2021-03-28 23:07:16',1896.42),(4,'2020-02-01 01:44:12',2291.72),(5,'2020-04-06 00:53:49',926.39),(6,'2018-03-16 05:28:09',756.10),(7,'2013-11-30 12:13:47',816.07),(8,'2017-08-05 11:35:26',1212.75),(9,'2018-07-21 17:27:03',858.92),(10,'2019-12-18 04:21:26',1421.88),(11,'2014-09-07 02:55:30',458.81),(12,'2022-05-12 06:02:51',1064.00),(13,'2014-03-18 12:55:56',182.00),(14,'2019-09-29 17:12:20',1964.41),(15,'2014-05-23 06:56:46',1499.44),(16,'2017-08-05 06:27:21',2363.98),(17,'2019-06-07 21:36:08',2116.00),(18,'2015-09-28 22:11:40',2449.92),(19,'2020-04-03 21:33:58',1422.00),(20,'2016-11-26 03:57:31',1245.10),(21,'2022-04-06 02:49:57',67.14),(22,'2020-04-04 14:06:40',1887.12),(23,'2015-07-03 11:46:09',2251.68),(24,'2016-03-21 22:43:58',166.11),(25,'2017-04-21 13:44:38',2451.10),(26,'2016-08-09 14:38:51',482.99),(27,'2017-01-21 12:38:17',1002.00),(28,'2020-11-24 20:06:42',2187.38),(29,'2018-08-30 02:33:41',1884.00),(30,'2014-01-17 14:53:02',1418.00),(31,'2016-05-08 15:51:28',1836.83),(32,'2016-07-01 16:23:51',957.00),(33,'2020-05-19 11:57:48',552.13),(34,'2017-01-05 14:25:55',1129.37),(35,'2014-12-29 14:24:15',1669.41),(36,'2015-05-13 18:16:51',299.20),(37,'2020-11-18 18:26:08',2289.38),(38,'2016-03-05 16:56:38',261.57),(39,'2020-08-20 01:02:11',2313.50),(40,'2016-02-09 22:10:42',215.15),(41,'2023-02-03 19:26:41',1064.00),(42,'2017-01-24 09:12:50',1950.13),(43,'2013-08-04 21:27:23',294.61),(44,'2018-12-07 14:17:00',359.40),(45,'2015-09-27 06:14:11',1720.23),(46,'2020-07-24 23:08:35',1367.80),(47,'2017-07-25 10:15:03',2036.79),(48,'2022-04-06 21:15:43',1029.04),(49,'2022-11-28 07:28:50',1917.21),(50,'2016-11-12 19:17:42',863.32),(51,'2017-07-24 03:42:22',1865.40),(52,'2015-12-02 00:07:46',1137.69),(53,'2021-03-25 21:51:25',683.17),(54,'2013-08-04 14:23:48',2041.00),(55,'2013-08-02 04:24:02',1609.00),(56,'2014-07-25 21:37:51',382.64),(57,'2017-09-27 05:38:17',521.06),(58,'2014-10-23 08:13:09',274.07),(59,'2015-11-04 14:42:31',134.24),(60,'2017-08-22 02:12:11',36.98),(61,'2016-04-22 20:38:51',311.79),(62,'2022-07-04 00:44:35',855.26),(63,'2021-11-20 09:40:14',900.60),(64,'2015-02-18 18:29:36',1210.28),(65,'2017-04-18 12:35:47',1170.60),(66,'2016-05-21 12:56:01',481.11),(67,'2013-05-12 08:32:37',1750.00),(68,'2018-05-30 23:48:23',2397.09),(69,'2013-09-11 15:40:21',2072.99),(70,'2016-04-01 13:19:42',1117.59),(71,'2021-02-03 18:12:46',2348.72),(72,'2019-06-14 12:00:42',1544.12),(73,'2019-09-23 13:03:56',1173.12),(74,'2018-11-01 13:47:40',1497.60),(75,'2017-03-31 05:01:57',1682.00),(76,'2020-01-06 14:14:57',1926.20),(77,'2017-07-27 16:39:03',1788.00),(78,'2013-05-14 15:36:19',409.00),(79,'2018-06-19 19:07:56',2100.00),(80,'2013-07-28 13:07:18',1785.97),(81,'2021-05-26 16:31:20',629.67),(82,'2019-04-30 16:28:56',1718.71),(83,'2019-08-06 16:53:30',1364.61),(84,'2013-07-20 07:01:10',2068.59),(85,'2016-10-21 00:43:53',1536.75),(86,'2019-03-26 03:36:42',48.55),(87,'2016-10-20 19:59:29',427.90),(88,'2014-07-19 02:25:52',924.98),(89,'2019-10-29 08:40:50',477.66),(90,'2022-08-09 17:57:54',759.58),(91,'2020-02-12 03:52:53',2270.88),(92,'2016-08-17 10:41:29',2251.51),(93,'2017-09-28 13:17:53',1065.67),(94,'2017-05-17 01:55:11',1199.25),(95,'2019-09-21 13:59:58',610.91),(96,'2017-01-23 03:08:04',582.55),(97,'2022-03-01 11:21:38',2141.84),(98,'2019-06-13 22:26:48',1786.84),(99,'2015-03-29 00:52:42',1837.19),(100,'2021-05-17 13:58:27',294.40),(101,'2013-09-20 07:19:26',92.40),(102,'2013-09-20 05:03:30',1358.62),(103,'2014-07-24 02:43:12',685.06),(104,'2020-01-26 11:15:19',1104.00),(105,'2013-12-30 18:22:49',1380.56),(106,'2020-05-17 12:29:16',2425.37),(107,'2015-04-23 14:35:51',1302.60),(108,'2018-07-12 22:49:52',2014.74),(109,'2019-09-10 19:36:04',1592.74),(110,'2015-11-11 22:21:56',1493.00),(111,'2014-03-27 00:53:53',970.76),(112,'2019-02-22 10:12:02',461.22),(113,'2017-02-11 07:27:06',343.29),(114,'2014-11-18 02:08:56',58.30),(115,'2014-07-05 14:36:17',254.32),(116,'2015-08-01 06:43:49',2372.26),(117,'2017-01-09 22:25:45',1134.63),(118,'2020-11-07 13:21:09',158.98),(119,'2018-03-22 12:24:39',362.40),(120,'2022-09-06 23:22:25',285.25),(121,'2015-03-06 12:46:44',398.70),(122,'2021-10-15 11:54:53',639.11),(123,'2014-10-11 22:17:53',1964.87),(124,'2018-01-16 16:48:00',1718.66),(125,'2018-12-27 04:44:08',194.40),(126,'2020-10-17 18:10:56',452.40),(127,'2014-11-06 10:39:07',702.40),(128,'2020-04-13 10:14:07',97.00),(129,'2014-03-28 18:06:41',1593.16),(130,'2022-11-04 14:50:55',1114.09),(131,'2021-12-15 12:53:49',1177.41),(132,'2014-09-14 15:14:31',1177.04),(133,'2020-03-14 07:07:23',340.29),(134,'2017-09-22 02:44:13',881.90),(135,'2019-08-07 05:41:17',1353.13),(136,'2019-07-28 00:02:31',1196.28),(137,'2016-11-17 06:21:01',187.78),(138,'2022-09-20 17:51:16',450.57),(139,'2021-01-15 23:59:55',1651.43),(140,'2018-05-04 14:18:19',1029.57),(141,'2021-03-14 08:09:32',804.66),(142,'2013-12-25 08:34:56',1146.64),(143,'2017-10-27 12:32:14',2100.21),(144,'2021-01-11 10:43:40',1169.33),(145,'2016-07-05 09:04:29',872.44),(146,'2014-12-04 05:09:17',2292.92),(147,'2015-05-26 10:02:18',256.89),(148,'2022-04-15 05:05:15',1056.00),(149,'2018-11-18 09:12:59',318.92),(150,'2015-10-18 07:11:54',1013.56),(151,'2019-07-25 01:20:01',1869.58),(152,'2019-08-18 05:42:38',1740.57),(153,'2022-01-23 00:13:09',199.84),(154,'2017-12-03 02:19:28',197.91),(155,'2022-05-27 14:00:04',783.00),(156,'2016-05-30 12:38:09',706.16),(157,'2014-07-10 22:39:11',633.68),(158,'2014-06-16 23:05:58',1750.20),(159,'2022-01-13 20:03:19',352.31),(160,'2018-12-03 05:36:15',392.00),(161,'2021-11-29 12:22:53',1737.50),(162,'2020-04-04 00:34:56',88.00),(163,'2014-12-27 20:42:51',564.85),(164,'2015-10-25 13:12:34',865.59),(165,'2017-06-17 10:03:22',2374.43),(166,'2017-05-21 23:03:55',644.97),(167,'2020-01-22 14:36:38',577.08),(168,'2016-04-20 23:52:28',1005.88),(169,'2017-12-22 02:34:39',1193.06),(170,'2022-01-28 13:16:40',2190.09),(171,'2017-10-22 18:05:56',860.83),(172,'2022-06-10 01:11:17',1825.00),(173,'2023-02-10 22:05:53',489.87),(174,'2017-11-11 23:33:24',812.00),(175,'2016-04-27 21:24:37',1306.10),(176,'2016-08-14 01:43:38',1893.40),(177,'2017-09-11 11:34:10',2111.24),(178,'2021-11-17 01:05:08',584.59),(179,'2017-02-02 02:21:42',973.11),(180,'2021-07-02 19:18:24',418.67),(181,'2018-08-24 02:32:01',713.00),(182,'2013-09-26 19:34:30',2021.44),(183,'2018-01-03 15:19:17',854.28),(184,'2017-10-15 14:55:57',1376.97),(185,'2016-11-26 20:44:37',240.71),(186,'2013-07-29 15:00:43',978.00),(187,'2019-10-31 18:21:07',327.44),(188,'2015-01-29 20:58:04',2318.72),(189,'2015-12-05 12:17:42',1606.71),(190,'2021-05-17 12:51:42',411.52),(191,'2016-06-08 07:38:08',2485.26),(192,'2020-10-22 12:17:00',1679.00),(193,'2021-02-16 11:50:47',2049.77),(194,'2017-12-01 16:45:35',2474.75),(195,'2022-08-13 02:24:47',1489.67),(196,'2014-01-04 06:25:10',560.05),(197,'2022-04-19 12:27:12',1608.11),(198,'2018-03-08 08:56:45',2133.00),(199,'2017-09-24 04:49:30',1750.23),(200,'2020-07-25 13:13:18',2357.68),(201,'2015-07-28 09:34:43',1082.74),(202,'2020-10-30 00:28:25',1478.00),(203,'2017-01-05 10:35:16',1464.71),(204,'2014-03-30 07:02:08',1708.34),(205,'2022-07-30 12:44:08',1041.21),(206,'2019-05-04 07:31:28',361.36),(207,'2014-12-25 07:01:20',696.71),(208,'2016-07-04 21:55:42',768.50),(209,'2019-07-01 16:16:07',2179.14),(210,'2020-08-27 18:44:53',1979.09),(211,'2020-12-12 12:13:07',176.40),(212,'2015-01-07 12:00:36',227.00),(213,'2013-06-04 06:00:35',1765.19),(214,'2017-09-13 17:46:57',1453.75),(215,'2017-02-18 17:55:16',1028.00),(216,'2020-09-30 04:47:49',2264.56),(217,'2015-03-16 19:50:03',1885.17),(218,'2022-09-30 22:11:34',797.00),(219,'2016-11-26 00:18:23',1537.82),(220,'2017-07-15 16:19:08',1708.30),(221,'2016-04-22 09:03:15',625.88),(222,'2018-08-15 12:53:20',1387.01),(223,'2022-04-20 02:12:01',164.16),(224,'2014-11-16 21:25:08',2144.84),(225,'2018-09-23 10:50:35',2433.00),(226,'2023-01-06 15:41:08',1952.79),(227,'2014-09-22 13:14:09',185.91),(228,'2016-11-19 14:51:29',543.07),(229,'2014-06-29 03:13:06',461.20),(230,'2021-11-21 15:03:15',1017.30),(231,'2022-06-04 04:19:55',1493.96),(232,'2021-01-10 06:40:32',1094.10),(233,'2014-04-03 02:02:33',2012.70),(234,'2020-09-24 22:00:45',2440.19),(235,'2014-04-26 23:09:55',823.85),(236,'2015-02-05 00:05:58',1261.30),(237,'2015-05-26 11:03:03',1760.80),(238,'2015-10-27 23:54:27',1142.68),(239,'2018-03-10 23:20:20',1794.76),(240,'2015-12-12 01:20:38',2062.03),(241,'2018-12-11 06:33:46',2165.96),(242,'2016-08-26 17:47:56',197.48),(243,'2013-04-28 04:23:42',150.24),(244,'2020-08-03 02:12:11',1367.59),(245,'2017-11-24 09:01:26',2298.50),(246,'2014-08-02 19:03:20',2318.64),(247,'2015-03-16 05:55:03',188.61),(248,'2014-09-01 06:52:30',1758.34),(249,'2016-04-03 04:44:51',1318.27),(250,'2021-08-22 05:45:40',2350.09),(251,'2015-12-03 19:35:22',1167.14),(252,'2018-02-27 12:53:02',525.50),(253,'2022-07-28 10:40:51',1813.24),(254,'2013-12-04 00:16:19',1216.88),(255,'2022-06-06 15:49:09',1426.55),(256,'2022-10-12 10:16:28',1713.19),(257,'2014-07-11 20:43:54',1770.87),(258,'2016-08-30 02:49:31',205.78),(259,'2014-04-29 02:14:46',1801.35),(260,'2013-05-04 12:58:22',1180.00),(261,'2015-07-12 18:29:51',95.90),(262,'2020-08-11 21:12:29',2334.69),(263,'2016-09-12 01:36:56',688.40),(264,'2014-11-01 05:12:43',2442.07),(265,'2022-12-18 07:13:29',591.81),(266,'2022-04-20 17:33:10',1965.38),(267,'2019-02-10 02:46:19',2485.00),(268,'2014-07-29 02:46:51',821.57),(269,'2022-12-15 07:43:28',535.69),(270,'2014-10-17 12:35:16',561.26),(271,'2013-12-29 18:06:01',438.70),(272,'2015-10-24 00:25:32',607.96),(273,'2016-08-15 02:09:02',2410.77),(274,'2017-02-28 05:47:48',220.71),(275,'2021-02-18 22:42:09',1306.00),(276,'2021-07-26 09:50:35',2206.86),(277,'2015-04-07 14:43:01',857.65),(278,'2020-02-01 03:56:06',2481.00),(279,'2018-03-20 20:59:05',519.00),(280,'2018-01-21 04:09:42',1294.54),(281,'2017-07-19 10:55:29',2405.36),(282,'2020-06-20 18:09:07',559.50),(283,'2022-08-01 05:49:51',1319.00),(284,'2013-12-16 02:47:41',993.62),(285,'2014-09-20 02:57:30',571.40),(286,'2019-07-06 19:18:53',2408.18),(287,'2015-02-10 12:31:44',2015.00),(288,'2018-06-05 07:20:49',630.12),(289,'2017-03-08 16:34:11',1657.03),(290,'2022-01-11 21:10:35',1311.00),(291,'2015-12-07 06:19:40',2480.60),(292,'2015-07-26 16:21:31',1227.11),(293,'2020-01-16 01:57:52',1859.62),(294,'2018-09-17 20:46:23',564.76),(295,'2013-12-19 21:47:10',2024.83),(296,'2014-09-15 04:11:14',2001.04),(297,'2019-02-18 19:07:15',2249.97),(298,'2022-03-08 14:41:34',296.12),(299,'2023-01-26 05:59:53',1184.26),(300,'2017-05-11 03:18:05',2435.52);

-- Popula tb_clientes
-- true/1 = ativo | false/0 = inativo
INSERT INTO `tb_clientes` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,0),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,0),(37,1),(38,1),(39,1),(40,0);

-- Popula tb_contatos
-- 1 = crítica | 2 = sugestão | 3 = elogio
INSERT INTO `tb_contatos` VALUES (1,'2016-01-16 19:38:26',1),(2,'2020-07-07 03:06:20',2),(3,'2016-03-22 08:24:36',3),(4,'2018-12-13 07:46:49',1),(5,'2017-10-09 08:58:26',3),(6,'2022-05-01 19:19:50',2),(7,'2017-02-22 21:48:16',3),(8,'2022-12-26 08:33:49',3),(9,'2019-01-29 04:08:24',2),(10,'2019-10-22 02:34:46',2),(11,'2020-03-04 13:20:33',2),(12,'2017-03-31 12:31:02',2),(13,'2013-04-06 03:25:53',2),(14,'2015-03-19 08:32:14',1),(15,'2018-12-04 03:38:09',1),(16,'2016-08-31 21:50:54',2),(17,'2016-05-23 18:27:37',3),(18,'2015-04-22 05:10:12',3),(19,'2015-11-10 20:20:26',1),(20,'2019-06-01 16:35:56',1),(21,'2017-12-16 02:51:55',2),(22,'2020-08-28 20:04:18',1),(23,'2021-12-22 01:04:26',3),(24,'2018-09-12 21:14:18',3),(25,'2018-11-25 00:12:58',1),(26,'2021-07-14 11:37:10',2),(27,'2015-12-15 20:16:33',3),(28,'2016-02-04 17:18:23',1),(29,'2015-09-23 17:26:36',3),(30,'2017-07-13 21:36:58',1),(31,'2019-09-07 08:41:30',2),(32,'2014-05-22 20:54:02',3),(33,'2020-04-25 18:48:13',3),(34,'2018-01-08 21:44:29',2),(35,'2015-10-22 13:54:23',1),(36,'2013-11-30 13:43:22',2),(37,'2018-02-20 03:27:39',3),(38,'2013-03-05 17:50:38',1),(39,'2021-11-17 10:25:57',3),(40,'2017-02-27 18:46:06',3);

-- Popula tb_despesas
INSERT INTO `tb_despesas` VALUES (1,'2014-02-27 17:36:52',1058.28),(2,'2014-11-05 15:54:36',1817.08),(3,'2015-04-12 15:24:06',2132.62),(4,'2016-02-02 07:24:47',2118.95),(5,'2020-12-21 04:24:58',45.80),(6,'2017-10-24 09:28:31',1753.50),(7,'2020-01-12 05:12:35',2110.20),(8,'2014-06-03 22:19:44',852.62),(9,'2020-09-23 00:15:30',1875.91),(10,'2017-08-27 00:10:01',20.92),(11,'2021-01-09 11:51:09',1704.39),(12,'2019-12-15 13:28:36',1732.76),(13,'2016-10-15 18:55:12',1212.82),(14,'2019-01-02 18:08:18',989.20),(15,'2021-01-12 06:50:30',636.30),(16,'2018-03-21 12:57:02',1546.62),(17,'2013-03-20 03:45:57',2283.42),(18,'2016-08-24 02:44:37',1505.98),(19,'2020-05-22 16:18:11',1993.00),(20,'2018-06-17 10:04:31',1527.00),(21,'2019-09-15 03:47:31',592.04),(22,'2017-11-08 02:39:23',2121.43),(23,'2017-05-10 23:03:22',1279.74),(24,'2021-11-27 10:20:11',1838.00),(25,'2022-02-15 12:15:32',1555.15),(26,'2022-07-15 15:35:18',1170.35),(27,'2018-03-23 18:31:57',746.50),(28,'2013-03-04 05:09:36',529.00),(29,'2018-09-28 13:16:10',1854.27),(30,'2016-08-02 02:32:27',970.75);