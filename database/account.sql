# --------------------------------------------------------
# Host:                         localhost
# Server version:               5.5.8
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2014-09-18 22:55:56
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping structure for table account_ple.bill
DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `billId` int(10) NOT NULL AUTO_INCREMENT,
  `vol` int(5) NOT NULL,
  `no` int(5) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `dateCreate` date NOT NULL,
  `billNumber` varchar(4) NOT NULL,
  PRIMARY KEY (`billId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

# Dumping data for table account_ple.bill: ~1 rows (approximately)
DELETE FROM `bill`;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
INSERT INTO `bill` (`billId`, `vol`, `no`, `companyName`, `dateCreate`, `billNumber`) VALUES
	(1, 1, 1, 'chainsoft', '2014-08-26', '0001');
/*!40000 ALTER TABLE `bill` ENABLE KEYS */;


# Dumping structure for table account_ple.billdetail
DROP TABLE IF EXISTS `billdetail`;
CREATE TABLE IF NOT EXISTS `billdetail` (
  `billDetailId` int(10) NOT NULL AUTO_INCREMENT,
  `no` int(11) NOT NULL,
  `date` date NOT NULL,
  `baht` int(11) NOT NULL,
  `satang` int(11) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `billId` int(10) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  PRIMARY KEY (`billDetailId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

# Dumping data for table account_ple.billdetail: ~3 rows (approximately)
DELETE FROM `billdetail`;
/*!40000 ALTER TABLE `billdetail` DISABLE KEYS */;
INSERT INTO `billdetail` (`billDetailId`, `no`, `date`, `baht`, `satang`, `remark`, `billId`, `price`) VALUES
	(1, 16043, '2014-08-26', 120, 50, 'test', 1, 100.00),
	(3, 1, '2014-08-28', 1, 1, '1', 1, 0.00),
	(4, 12131, '2014-09-07', 0, 0, 'บิลพิเศษใช้ในการตรวจสอบรายรับ', 1, 100000.00);
/*!40000 ALTER TABLE `billdetail` ENABLE KEYS */;


# Dumping structure for table account_ple.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customerId` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `vatId` varchar(50) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = inactive, 1 = active',
  PRIMARY KEY (`customerId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table account_ple.customer: 2 rows
DELETE FROM `customer`;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`customerId`, `name`, `address`, `vatId`, `active`) VALUES
	(1, 'test (สำนักงานใหญ่)', '600/78 ถ.สาธุประดิษฐุ์', '34231413414', 1),
	(2, 'test', 'บ้าน22', '24525141342', 1);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;


# Dumping structure for table account_ple.invoice
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoiceId` int(10) NOT NULL AUTO_INCREMENT,
  `customerId` int(10) NOT NULL,
  `dateCreate` date DEFAULT NULL,
  `invoiceNumber` varchar(4) NOT NULL DEFAULT '0000',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`invoiceId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

# Dumping data for table account_ple.invoice: 4 rows
DELETE FROM `invoice`;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` (`invoiceId`, `customerId`, `dateCreate`, `invoiceNumber`, `active`) VALUES
	(1, 1, '2014-08-06', '0001', 1),
	(2, 2, '2014-08-17', '0002', 1),
	(3, 2, '2014-08-30', '0003', 1),
	(4, 2, '2014-09-18', '0004', 1);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;


# Dumping structure for table account_ple.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `productId` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int(6) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table account_ple.product: 2 rows
DELETE FROM `product`;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`productId`, `name`, `price`, `active`) VALUES
	(1, 'ปก', 1801, 1),
	(2, 'แขน', 1400, 1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;


# Dumping structure for table account_ple.relate_invoice_tax
DROP TABLE IF EXISTS `relate_invoice_tax`;
CREATE TABLE IF NOT EXISTS `relate_invoice_tax` (
  `relate_invoice_taxId` int(10) NOT NULL AUTO_INCREMENT,
  `taxId` int(10) NOT NULL,
  `invoiceId` int(10) NOT NULL,
  PRIMARY KEY (`relate_invoice_taxId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

# Dumping data for table account_ple.relate_invoice_tax: 4 rows
DELETE FROM `relate_invoice_tax`;
/*!40000 ALTER TABLE `relate_invoice_tax` DISABLE KEYS */;
INSERT INTO `relate_invoice_tax` (`relate_invoice_taxId`, `taxId`, `invoiceId`) VALUES
	(1, 2, 3),
	(3, 3, 3),
	(4, 1, 3),
	(5, 2, 4);
/*!40000 ALTER TABLE `relate_invoice_tax` ENABLE KEYS */;


# Dumping structure for table account_ple.relate_tax_product
DROP TABLE IF EXISTS `relate_tax_product`;
CREATE TABLE IF NOT EXISTS `relate_tax_product` (
  `relate_tax_productId` int(10) NOT NULL AUTO_INCREMENT,
  `amount` int(10) NOT NULL DEFAULT '0',
  `pricePerAmount` int(10) NOT NULL DEFAULT '0',
  `taxId` int(10) NOT NULL,
  `productId` int(10) NOT NULL,
  PRIMARY KEY (`relate_tax_productId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table account_ple.relate_tax_product: 2 rows
DELETE FROM `relate_tax_product`;
/*!40000 ALTER TABLE `relate_tax_product` DISABLE KEYS */;
INSERT INTO `relate_tax_product` (`relate_tax_productId`, `amount`, `pricePerAmount`, `taxId`, `productId`) VALUES
	(1, 15, 77, 3, 1),
	(2, 5, 50, 3, 2);
/*!40000 ALTER TABLE `relate_tax_product` ENABLE KEYS */;


# Dumping structure for table account_ple.setting
DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `settingName` varchar(50) NOT NULL,
  `value` varchar(4) DEFAULT '0000',
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`settingName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dumping data for table account_ple.setting: 2 rows
DELETE FROM `setting`;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`settingName`, `value`, `description`) VALUES
	('taxId', '0002', 'เลขที่ใบกำกับภาษี'),
	('invoiceId', '0004', 'เลขที่ใบเสร็จรับเงิน');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;


# Dumping structure for table account_ple.tax
DROP TABLE IF EXISTS `tax`;
CREATE TABLE IF NOT EXISTS `tax` (
  `taxId` int(10) NOT NULL AUTO_INCREMENT,
  `taxNumber` varchar(4) NOT NULL DEFAULT '0000',
  `customerId` int(10) NOT NULL,
  `dateCreate` date DEFAULT NULL,
  `totalPrice` int(10) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`taxId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

# Dumping data for table account_ple.tax: 3 rows
DELETE FROM `tax`;
/*!40000 ALTER TABLE `tax` DISABLE KEYS */;
INSERT INTO `tax` (`taxId`, `taxNumber`, `customerId`, `dateCreate`, `totalPrice`, `active`) VALUES
	(1, '0000', 2, '2014-08-07', 1000, 1),
	(2, '0001', 1, '2014-08-01', 2000, 1),
	(3, '0002', 2, '2014-08-02', 10000, 1);
/*!40000 ALTER TABLE `tax` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
