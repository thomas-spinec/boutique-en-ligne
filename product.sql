-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 12 avr. 2023 à 11:42
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `image_2` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `Best Sellers` tinyint(1) NOT NULL DEFAULT '0',
  `New Collection` tinyint(1) NOT NULL DEFAULT '0',
  `Promotion` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id_product`, `title`, `description`, `image`, `image_1`, `image_2`, `price`, `Best Sellers`, `New Collection`, `Promotion`) VALUES
(1, 'Black suit', 'Black suit', 'suit_03.jpg', 'suit_03a.jpg', 'suit_03b.jpg', 110, 1, 0, 0),
(2, 'Pants with pleats', 'Wide pants with pleats, navy blue\r\n2 front pockets and 2 fake back pockets', 'pant_01.jpeg', 'pant_01a.jpeg', 'pant_01b.jpeg', 45, 0, 0, 0),
(3, 'Powdery pink dress', 'Powdery pink dress.\r\nSoft and light for summer time\r\nv-neck, fitted waist, Silk fabric', 'dress_03.jpg', '', '', 90, 1, 1, 0),
(4, 'Ivory sweater', 'Ivory cashmere sweater', 'sweater_03.jpeg', 'sweater_03a.jpeg', 'sweater_03b.jpeg', 86, 0, 0, 0),
(5, 'Intense Red suit', 'Red suit, double-breasted, jacket slim pants', 'suit_01.jpg', 'suit_01a.jpg', '', 150, 0, 0, 0),
(6, 'Pink spring suit', 'Light pink suit', 'suit_06.jpg', 'suit_06a.jpg', '', 150, 0, 1, 0),
(7, 'Satin suit', 'Brown satin summer suit', 'suit_07.jpg', '', '', 80, 0, 1, 0),
(8, 'White dress', 'White spring dress', 'dress_06.jpg', 'dress_06a.jpg', '', 110, 0, 1, 0),
(9, 'White slim pants', 'White slim & strech pants', 'pants_04.jpg', 'pants_04a.jpg', 'pants_04b.jpg', 45, 0, 0, 0),
(10, 'Suit Coffee', 'Suit Coffee', 'suit_07.jpg', '', '', 120, 0, 1, 0),
(11, 'Cocktail dress', 'Green cocktail dress', 'dress_08.jpg', 'dress_08a.jpg', 'dress_08b.jpg', 75, 0, 0, 0),
(12, 'Sun glasses', 'Sun glasses', 'glasses_01.jpg', '', '', 80, 0, 1, 0),
(13, 'Irene kredenets Bag', 'Leather bag Irene Kredenets 30x42, made of crossed straps, chain handle\r\n', 'bag_01.jpg', '', '', 210, 0, 0, 0),
(14, 'Sweater oversize', 'White oversize hooded sweater', 'sweater_02.jpg', 'sweater_02a.jpg', '', 75, 1, 0, 0),
(15, 'Mustard dress mini', 'Mustard corded dress mini, 3 buttons front', 'dress_05.jpg', '', '', 60, 0, 1, 0),
(16, 'Pink backpack ', 'faux leather pink backpack', 'bag_02.jpg', '', '', 162, 0, 0, 0),
(17, 'White wool coat', 'White wool coat, 2 side pockets, trench cut with belt', 'coat_01.jpg', 'coat_01a.jpg', '', 120, 0, 0, 0),
(18, 'Red straight dress', 'Red thin ribbed below knee length bodycon dress', 'dress_02.jpg', '', '', 66, 1, 0, 0),
(19, 'Mini dress', 'Mini dress, light cotton triangle bustier', 'dress_01.jpg', '', '', 45, 1, 1, 0),
(20, 'Satin dress', 'Satin dress, printed with small yellow flowers, bow bustier and side slit', 'dress_04.jpg', 'dress_04a.jpg', '', 112, 0, 1, 0),
(21, 'Green relaxation set', 'strapless loungewear and cropped pants', 'loungewear_01.jpg', 'loungewear_01a.jpg', '', 60, 0, 1, 0),
(22, 'satin sleepwear set', 'Pink satin sleepwear set. Top and short', 'loungewear_02.jpg', 'loungewear_02a.jpg', '', 55, 0, 1, 0),
(23, 'Sportswear set Nike', 'Pink sportswear set Nike', 'sportswear_03.jpg', 'sportswear_03a.jpg', '', 90, 0, 0, 0),
(24, 'Yellow suit ', 'Yellow suit', 'suit_02.jpg', 'suit_02a.jpg', 'suit_02b.jpg', 120, 0, 0, 0),
(25, 'Sky blue suit', 'Sky blue suit without collar, 2 side pockets, a hook closure ', 'suit_05.jpg', 'suit_05a.jpg', 'suit_05b.jpg', 135, 0, 1, 0),
(26, 'Grey loose suit', 'Grey loose boyfriend suit', 'suit_08.jpg', 'suit_08a.jpg', 'suit_08b.jpg', 135, 0, 0, 0),
(27, 'Red shorts suit', 'Red shorts suit, smocking cut', 'suit_09.jpg', 'suit_09a.jpg', 'suit_09b.jpg', 135, 0, 0, 0),
(28, 'Cashmere sweater', 'Blue cashmere turtleneck sweater', 'sweater_01.jpg', 'sweater_01a.jpg', '', 55, 0, 0, 0),
(29, 'Glossy brown top', 'glossy brown top. Backless', 'top_01.jpg', 'top_01a.jpg', 'top_01b.jpg', 75, 0, 1, 0),
(30, 'Pink cotton t-shirt & shorts', 'Oversized shirt and shorts set', 'shirt_01.jpg', '', '', 59, 0, 0, 0),
(31, 'Black cotton t-shirt', 'Black cotton t-shirt', 'tshirt_02.jpg', 'tshirt_02a.jpg', 'tshirt_02b.jpg', 29, 0, 0, 0),
(32, 'M&M watch white strap', 'M&M watch white strap and gold metal', 'watch_01.jpg', '', '', 226, 0, 0, 0),
(33, 'Safari jacket', 'Belted safari jacket', 'coat_03.jpg', 'coat_03a.jpg', '', 83, 1, 1, 0),
(34, 'Short speckled jacket', 'Short pink/black/grey speckled jacket, 3 buttons', 'jacket_02.jpg', 'jacket_02a.jpg', '', 69, 0, 0, 0),
(35, 'Purse Sarel', 'Imitation crocodile red handbag from Sarel', 'puse_02', '', '', 85, 1, 0, 0),
(36, 'Leather purse', 'Leather and gold metal purse', 'purse_01.jpg', '', '', 119, 0, 0, 0),
(37, 'Orange tracksuit', 'Orange tracksuit. cropped hoodie', 'sportswear_05.jpg', '', '', 89, 0, 0, 0),
(38, 'Crossed ties top', 'White knit top, crossed ties in front', 'top_02.jpg', 'top_02a.jpg', 'top_02b.jpg', 159, 0, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
