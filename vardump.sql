-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.4.12-MariaDB-log - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.5958
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица test_task_01.category
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы test_task_01.category: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`category_id`, `name`) VALUES
	(1, 'Футболки'),
	(2, 'Майки'),
	(3, 'Шорты'),
	(4, 'Ботинки'),
	(5, 'Куртки');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Дамп структуры для таблица test_task_01.product
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `FK_product_category` (`category_id`),
  CONSTRAINT `FK_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы test_task_01.product: ~11 rows (приблизительно)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`product_id`, `category_id`, `name`, `price`, `date`) VALUES
	(1, 4, 'Туфли', 10.00, '2021-07-01 10:23:43'),
	(2, 4, 'Сандали', 15.00, '2021-07-05 00:23:56'),
	(3, 5, 'Тёплая куртка', 20.00, '2021-07-04 00:24:03'),
	(4, 5, 'Летняя куртка', 23.00, '2021-07-03 00:24:07'),
	(5, 2, 'Красная майка', 18.00, '2021-07-02 00:24:12'),
	(6, 2, 'Желтая майка', 19.00, '2021-07-15 00:24:15'),
	(7, 2, 'Синяя майка', 35.00, '2021-07-16 00:24:21'),
	(8, 2, 'Серая майка', 33.00, '2021-07-14 00:24:25'),
	(9, 2, 'Белая майка', 13.00, '2021-07-13 00:24:29'),
	(10, 1, 'Синяя футболка', 14.00, '2021-07-12 00:24:32'),
	(11, 3, 'Синие шорты', 22.00, '2021-07-11 00:24:35'),
	(12, 3, 'Зелёные шорты', 55.00, '2021-07-10 00:24:38'),
	(13, 3, 'Фиолетовые шорты', 33.00, '2021-07-22 00:24:40');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
