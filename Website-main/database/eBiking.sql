/* Create the database */
CREATE DATABASE dbProducts;
use dbProducts;

/* Create the table Products */
CREATE TABLE `Products` (
 `id` int unsigned NOT NULL AUTO_INCREMENT,
 `name` varchar(150) NOT NULL UNIQUE,
 `images` varchar(400) NOT NULL,
 `price` float unsigned NOT NULL,
 `shortDescription` longtext NOT NULL,
 `stock` int unsigned DEFAULT NULL,
 `advantages` longtext NOT NULL,
 `technicalInfos` longtext NOT NULL,
 `productComposition` longtext NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci