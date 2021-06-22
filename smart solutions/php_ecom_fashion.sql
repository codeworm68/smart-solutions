/*
SQLyog Community Edition- MySQL GUI v5.22a
Host - 5.0.19-nt : Database - php_ecom_electronics
*********************************************************************
Server version : 5.0.19-nt
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `php_ecom_electronics`;

USE `php_ecom_electronics`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `a_category` */

DROP TABLE IF EXISTS `a_category`;

CREATE TABLE `a_category` (
  `cat_id` bigint(20) NOT NULL auto_increment,
  `cat_name` varchar(255) NOT NULL,
  `img_path` varchar(200) default NULL,
  `isIcon` smallint(6) NOT NULL default '1',
  `is_deleted` smallint(6) NOT NULL default '0',
  `deleted_by` varchar(100) default NULL,
  PRIMARY KEY  (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `a_category` */

insert  into `a_category`(`cat_id`,`cat_name`,`img_path`,`isIcon`,`is_deleted`,`deleted_by`) values (1,'Business and Corporate','uploads/f2017075302.jpg',1,0,'1'),(2,'Beauty and Fashion','uploads/bigimage/260117045514.JPG',1,0,NULL),(3,'Health and Fitness','uploads/bigimage/260117045737.JPG',1,0,NULL),(4,'Education and Learning','uploads/bigimage/260117050552.jpg',1,0,'admin'),(5,'Shopping and Retail','uploads/bigimage/260117050805.jpg',1,0,NULL),(6,'Business and Corporate','uploads/bigimage/260117050855.jpg',1,0,NULL);

/*Table structure for table `a_category_products` */

DROP TABLE IF EXISTS `a_category_products`;

CREATE TABLE `a_category_products` (
  `cat_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`cat_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `a_category_products` */

insert  into `a_category_products`(`cat_id`,`product_id`) values (1,1),(1,8),(2,1),(2,2),(2,3),(2,4),(2,5),(2,7),(3,6),(3,9),(4,4),(4,10),(5,5),(5,10),(6,10);

/*Table structure for table `b_product` */

DROP TABLE IF EXISTS `b_product`;

CREATE TABLE `b_product` (
  `pro_id` bigint(20) NOT NULL auto_increment,
  `pro_name` varchar(255) NOT NULL,
  `add_date` datetime default NULL,
  `price` float default '0',
  `discount` float(20,2) default '0.00',
  `warranty` varchar(800) default NULL,
  `description` text,
  `img_path` varchar(255) default NULL,
  `status` smallint(6) NOT NULL default '1',
  `is_deleted` smallint(6) NOT NULL default '0',
  `deleted_by` varchar(100) default NULL,
  PRIMARY KEY  (`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `b_product` */

insert  into `b_product`(`pro_id`,`pro_name`,`add_date`,`price`,`discount`,`warranty`,`description`,`img_path`,`status`,`is_deleted`,`deleted_by`) values (1,'Zebra Wallpapeer','2017-01-26 21:17:53',200,5.00,'Wallpaper Images','Zebra Wallpaper Images details','uploads/bigimage/260117044753.jpg',1,0,NULL),(3,'Bollywood Wallpaper','2017-01-26 21:25:14',855,5.00,'Dimentions 1000 X 400','image details','uploads/bigimage/260117045514.JPG',1,0,NULL),(4,'Banner Images','2017-01-26 21:27:37',1500,10.00,'1200 X 200','Banner Images','uploads/bigimage/260117045737.JPG',1,0,NULL),(5,'Ganesha Wallpaper','2017-01-26 21:35:52',1500,5.00,'1200 X 2000','Ganesha wallpaper','uploads/bigimage/260117050552.jpg',1,0,NULL),(7,'Nature Wallpaper','2017-01-26 21:38:55',855,10.00,'1200 X 1200','Nature Wallpaper','uploads/bigimage/260117050855.jpg',1,0,NULL),(8,'Sunshne Wallpaper','2017-01-26 21:39:46',700,5.00,'1500 X 1200','Sunshine Wallpaper','uploads/bigimage/260117050946.jpg',1,0,NULL),(9,'3D Wallpaper','2017-01-26 21:40:32',700,10.00,'2000 X 1500','3D Wallpaper','uploads/bigimage/260117051031.jpg',1,0,NULL),(10,'ghfgh','2017-02-04 12:50:09',34,1.00,'hfghdgf','ghfhfhgh','uploads/bigimage/040217082009.jpg',1,0,NULL);

/*Table structure for table `enquiry` */

DROP TABLE IF EXISTS `enquiry`;

CREATE TABLE `enquiry` (
  `enq_id` bigint(10) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `mobile_no` varchar(20) default NULL,
  `email_id` varchar(100) default NULL,
  `enquiry` varchar(800) default NULL,
  `enq_date` date default NULL,
  PRIMARY KEY  (`enq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `enquiry` */

insert  into `enquiry`(`enq_id`,`name`,`mobile_no`,`email_id`,`enquiry`,`enq_date`) values (3,'kamal kant Prasad','9555821757','kant975@gmail.com','I want to know you product power circulation machine','2012-02-12'),(5,'Pawan ','79879797','pawan@gmail.com','jdoajof','2012-03-08');

/*Table structure for table `i_order` */

DROP TABLE IF EXISTS `i_order`;

CREATE TABLE `i_order` (
  `od_id` int(10) unsigned NOT NULL auto_increment,
  `od_invoice` varchar(100) NOT NULL,
  `od_billing_amount` float(10,2) default '0.00',
  `od_date` datetime default NULL,
  `od_last_update` datetime default NULL,
  `od_status` enum('Uncomplete','Paid','Completed','Cancelled') NOT NULL default 'Completed',
  `od_billing_name` varchar(50) NOT NULL,
  `od_billing_address` varchar(100) NOT NULL,
  `od_billing_city` varchar(100) NOT NULL,
  `od_billing_state` varchar(100) default NULL,
  `od_billing_postal_code` varchar(10) NOT NULL,
  `od_billing_email` varchar(255) NOT NULL,
  `od_billing_phone` varchar(16) NOT NULL,
  `od_shipping_name` varchar(50) NOT NULL,
  `od_shipping_address` varchar(100) NOT NULL,
  `od_shipping_city` varchar(100) NOT NULL,
  `od_shipping_state` varchar(100) default NULL,
  `od_shipping_postal_code` varchar(10) NOT NULL,
  `od_shipping_phone` varchar(16) NOT NULL,
  `od_shipping_cost` decimal(10,2) default '0.00',
  `payment_type` varchar(50) default NULL,
  `card_no` varchar(20) default NULL,
  `expiry` varchar(10) default NULL,
  `cvv` int(10) default NULL,
  `name_on_card` varchar(200) default NULL,
  `user_id` bigint(20) default NULL,
  `is_delete` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`od_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `i_order` */

insert  into `i_order`(`od_id`,`od_invoice`,`od_billing_amount`,`od_date`,`od_last_update`,`od_status`,`od_billing_name`,`od_billing_address`,`od_billing_city`,`od_billing_state`,`od_billing_postal_code`,`od_billing_email`,`od_billing_phone`,`od_shipping_name`,`od_shipping_address`,`od_shipping_city`,`od_shipping_state`,`od_shipping_postal_code`,`od_shipping_phone`,`od_shipping_cost`,`payment_type`,`card_no`,`expiry`,`cvv`,`name_on_card`,`user_id`,`is_delete`) values (2,'100002',200.00,'2017-02-02 00:46:31','2017-02-02 00:46:31','Completed','Kamal Kant','Central Market Bodella, C Block Vikashpuri','New Delhi','Delhi','110018','admin@gmail.com','8588025044','','Central Market Bodella, C Block Vikashpuri','New Delhi','Delhi','110018','8588025044','0.00','Online','1234567898989898','10/2019',123,'Testing India',1,0),(3,'100003',2355.00,'2017-02-04 12:39:23','2017-02-04 12:39:23','Completed','abhilash','tydgdhjyg','gsfdg','Himachal Pradesh','2222','agarwal.abhilash4@gmail.com','8130968793','','tydgdhjyg','gsfdg','Himachal Pradesh','2222','8130968793','0.00','Online','5425367181','2/29',555,'abhilash',15,0),(4,'100004',34.00,'2017-02-04 13:00:25','2017-02-04 13:00:25','Completed','abhilash','lkdfklkl','nnnn','Kerala','110019','agarwal.abhilash4@gmail.com','8130968793','','lkdfklkl','nnnn','Kerala','110019','8130968793','0.00','Online','6789','678',2147483647,'Testing India',15,0);

/*Table structure for table `i_order_item` */

DROP TABLE IF EXISTS `i_order_item`;

CREATE TABLE `i_order_item` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `product_image` varchar(255) default NULL,
  `product_name` varchar(255) default NULL,
  `product_price` decimal(10,2) default NULL,
  `quantity` int(10) unsigned NOT NULL,
  `created` datetime default NULL,
  `ostatus` int(10) default '1' COMMENT '1=>Activate,2=>Inactive',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `i_order_item` */

insert  into `i_order_item`(`id`,`order_id`,`product_id`,`product_image`,`product_name`,`product_price`,`quantity`,`created`,`ostatus`) values (4,2,1,'uploads/bigimage/260117044753.jpg','Zebra Wallpapeer','200.00',1,'2017-02-01 20:16:31',1),(5,3,5,'uploads/bigimage/260117050552.jpg','Ganesha Wallpaper','1500.00',1,'2017-02-04 08:09:23',1),(6,3,3,'uploads/bigimage/260117045514.JPG','Bollywood Wallpaper','855.00',1,'2017-02-04 08:09:23',1),(7,4,10,'uploads/bigimage/040217082009.jpg','ghfgh','34.00',1,'2017-02-04 08:30:25',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `gender` varchar(50) default NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` varchar(500) default NULL,
  `city` varchar(100) default NULL,
  `state` varchar(100) default NULL,
  `pincode` varchar(100) default NULL,
  `news_letter` varchar(50) default 'yes',
  `password` varchar(25) NOT NULL,
  `utype` varchar(50) default NULL,
  `ustatus` char(1) default '1' COMMENT '1=>Active, 0=> Inactive',
  `created` datetime default NULL,
  `updated` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email_id` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`gender`,`email`,`mobile`,`address`,`city`,`state`,`pincode`,`news_letter`,`password`,`utype`,`ustatus`,`created`,`updated`) values (1,'Kamal Kant',NULL,'admin','8588025044','Central Market Bodella, C Block Vikashpuri','New Delhi','Delhi','110018','yes','admin','admin','1','2016-11-19 21:58:52','2016-11-19 21:58:52'),(2,'Kamal Kant',NULL,'kamal@gmail.com','9898989898',NULL,NULL,NULL,NULL,'yes','testing','user','1','2016-11-19 23:41:06',NULL),(8,'Ksma',NULL,'info@kkretail.com','80980',NULL,NULL,NULL,NULL,'yes','kj;lk','user','1','2016-11-19 23:45:09',NULL),(10,'Ghanshyam Kumar','Female','ghanshyam@gmail.com','9898989898','Testing india','New Delhi','Delhi','110018','','admin','user','1','2016-11-19 23:47:11','2016-12-04 10:51:59'),(11,'Hemant Kumar',NULL,'hemant@gmail.com','9898989898',NULL,NULL,NULL,NULL,'yes','hemant','user','1','2016-11-19 23:48:23',NULL),(13,'Ghanshyam',NULL,'ghanshyam.it.kr@gmail.com','9818637154',NULL,NULL,NULL,NULL,'yes','','user','1','2016-11-30 23:02:56',NULL),(14,'Ghanshyam',NULL,'gkgupta975@gmail.com','9818637154',NULL,NULL,NULL,NULL,'yes','zxcvb','user','1','2016-11-30 23:05:51',NULL),(15,'abhilash','Male','agarwal.abhilash4@gmail.com','8130968793','','','na','','yes','1234','user','1','2017-02-04 12:37:18','2017-02-04 12:38:03'),(16,'Testing',NULL,'india@gmail.com','2222222222',NULL,NULL,NULL,NULL,'yes','12345','user','1','2017-02-04 12:46:03',NULL),(17,'Kamal Kant',NULL,'kamal@yopmail.com','9898989898',NULL,NULL,NULL,NULL,'yes','admin','user','1','2019-03-10 17:21:33',NULL);

/*Table structure for table `z_state` */

DROP TABLE IF EXISTS `z_state`;

CREATE TABLE `z_state` (
  `StateID` bigint(20) NOT NULL auto_increment,
  `State` varchar(100) NOT NULL default '',
  `country_id` int(20) default '1',
  `is_deleted` smallint(6) NOT NULL default '0',
  `deleted_by` varchar(100) default NULL,
  PRIMARY KEY  (`StateID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `z_state` */

insert  into `z_state`(`StateID`,`State`,`country_id`,`is_deleted`,`deleted_by`) values (1,'Andhra Pradesh',1,0,NULL),(2,'Assam',1,0,NULL),(3,'Bihar',1,0,NULL),(4,'Chattisgarh',1,0,NULL),(5,'Chandigarh',1,0,NULL),(6,'Delhi',1,0,NULL),(7,'Goa',1,0,''),(8,'Gujarat',1,0,NULL),(9,'Himachal Pradesh',1,0,NULL),(10,'Haryana',1,0,NULL),(11,'Jharkhand',1,0,NULL),(12,'Jammu &amp; Kashmir',1,0,NULL),(13,'Karnataka',1,0,NULL),(14,'Kerala',1,0,NULL),(15,'Maharastra',1,0,NULL),(16,'Madhya Pradesh',1,0,NULL),(17,'Orissa',1,0,NULL),(18,'Punjab',1,0,NULL),(19,'Pondicherry',1,0,NULL),(20,'Rajasthan',1,0,NULL),(21,'Tamilnadu',1,0,NULL),(22,'Uttarakand',1,0,NULL),(23,'Uttar Pradesh',1,0,'admin'),(24,'West Bengal',1,0,'admin'),(25,'testing',1,0,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
