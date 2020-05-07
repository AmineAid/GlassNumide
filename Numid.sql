

CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `dimension1` decimal(15,2) NOT NULL,
  `dimension2` decimal(15,2) NOT NULL,
  `q` decimal(15,2) NOT NULL,
  `vitre1` int(11) NOT NULL,
  `baguette` int(11) NOT NULL,
  `vitre2` int(11) NOT NULL,
  `sens` text NOT NULL,
  `price` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;


INSERT INTO articles VALUES
("1","1","100.00","100.00","1.00","3","14","1","EXT","4000.00"),
("8","2","102.00","93.00","3.00","5","15","2","INT","5250.00"),
("9","2","36.00","120.00","2.00","5","15","2","INT","5250.00"),
("10","2","93.20","45.00","1.00","5","15","2","INT","5250.00");




CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `contact` text NOT NULL,
  `com` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


INSERT INTO contacts VALUES
("1","Amine","0123456789",""),
("6","amine aid","cotnact","Azazga"),
("7","Contact 4","12345678","Azazga"),
("8","Toufik","011223344","Azazga"),
("9","SAMIR","66666","AZAZGA");




CREATE TABLE `defaults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO defaults VALUES
("1","location","Tizi-Ouzou"),
("2","destinationxls","ext");




CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_contact` int(11) NOT NULL,
  `client` text NOT NULL,
  `time` int(11) NOT NULL,
  `last_modified` int(11) NOT NULL,
  `argon` text NOT NULL,
  `poncage` text NOT NULL,
  `cuisson` text NOT NULL,
  `versements` float(11,2) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO orders VALUES
("1","1","Amine","1501634040","1501634040","Non","Non","Non","2000.00","1"),
("2","9","SAMIR","1501638900","1501682992","Oui","Oui","Oui","20000.00","1");




CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `reference` text NOT NULL,
  `designation` text NOT NULL,
  `price` float NOT NULL,
  `listing` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;


INSERT INTO products VALUES
("1","1","CL 04","Clair 4mm","1100","2"),
("2","1","CL 05","Clair 5mm","1200","1"),
("3","1","BL 04","Bleu 4mm","2300","3"),
("4","1","BL 05","Bleu 5mm","2400","4"),
("5","1","VRT 05","Vert 5mm","2400","5"),
("6","1","BRZ 05","Bronz 5mm","2400","6"),
("7","1","MRG 04","MRG 4mm","2300","1000"),
("8","1","ISLM 04","ISLM 4mm","1400","1000"),
("9","1","TISSE 04","Tisse 4mm","1400","1000"),
("10","1","FMR 05","FMR 5mm","2500","1000"),
("11","1","FMR 04","FMR 4mm","2400","1000"),
("12","1","FBL 05","FBL 5mm","2500","1000"),
("13","1","FBL 04","FBL 4mm","2400","1000"),
("14","2","10","10mm","100","1000"),
("15","2","6","6 mm","100","1000"),
("16","2","8","8 mm","100","1000"),
("17","2","12","12 mm","200","1000");




CREATE TABLE `tempdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `q` int(11) NOT NULL,
  `d` float(18,2) NOT NULL,
  `productref` text NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1697 DEFAULT CHARSET=latin1;


INSERT INTO tempdata VALUES
("1680","1","1","1.00","CL 04","1"),
("1681","2","6","1.80","CL 05","1"),
("1682","3","1","1.00","BL 04","1"),
("1683","4","0","0.00","BL 05","1"),
("1684","5","6","1.80","VRT 05","1"),
("1685","6","0","0.00","BRZ 05","1"),
("1686","7","0","0.00","MRG 04","1"),
("1687","8","0","0.00","ISLM 04","1"),
("1688","9","0","0.00","TISSE 04","1"),
("1689","10","0","0.00","FMR 05","1"),
("1690","11","0","0.00","FMR 04","1"),
("1691","12","0","0.00","FBL 05","1"),
("1692","13","0","0.00","FBL 04","1"),
("1693","14","1","1.00","10","2"),
("1694","15","6","1.80","6","2"),
("1695","16","0","0.00","8","2"),
("1696","17","0","0.00","12","2");




CREATE TABLE `tempdata2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contactid` int(11) NOT NULL,
  `name` text NOT NULL,
  `region` text NOT NULL,
  `contact` text NOT NULL,
  `orders` int(11) NOT NULL,
  `ordersvalue` decimal(10,0) NOT NULL,
  `q` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=841 DEFAULT CHARSET=latin1;


INSERT INTO tempdata2 VALUES
("836","1","Amine","","0123456789","1","4000","1","1"),
("837","6","amine aid","Azazga","cotnact","0","0","0","0"),
("838","7","Contact 4","Azazga","12345678","0","0","0","0"),
("839","8","Toufik","Azazga","011223344","0","0","0","0"),
("840","9","SAMIR","AZAZGA","66666","1","21678","6","2");




CREATE TABLE `versements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_contact` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `valeur` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




