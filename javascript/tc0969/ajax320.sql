-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 12, 2007 at 07:05 AM
-- Server version: 5.0.16
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `ajax320`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `products`
-- 

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `category_id` int(11) NOT NULL,
  `price` float unsigned default NULL,
  `qty` int(10) unsigned default NULL,
  `image_url` varchar(75) default NULL,
  `description` varchar(150) default 'No description available',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

-- 
-- Dumping data for table `products`
-- 

INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `qty`, `image_url`, `description`) VALUES 
(1, 'Hydrogen', 0, 23.59, 13, 'img1.jpg', 'Vivamus ut nisi eget libero fringilla rutrum.'),
(2, 'Helium', 1, 57.65, 17, 'img2.jpg', 'Vivamus molestie mollis felis.'),
(3, 'Lithium', 3, 45.22, 20, 'img3.jpg', 'Nam pulvinar tristique ligula.'),
(4, 'Beryllium', 3, 98.52, 9, 'img4.jpg', 'Maecenas adipiscing purus ut tellus.'),
(5, 'Boron', 0, 23.59, 14, 'img5.jpg', 'Mauris lobortis sapien in quam.'),
(6, 'Carbon', 2, 57.65, 2, 'img6.jpg', 'Sed tincidunt varius risus.'),
(7, 'Nitrogen', 1, 45.22, 3, 'img7.jpg', 'Aenean bibendum est in ipsum.'),
(8, 'Oxygen', 3, 98.52, 9, 'img8.jpg', 'Phasellus dictum aliquam elit.'),
(9, 'Fluorine', 2, 23.59, 4, 'img9.jpg', 'Nulla aliquam tellus vel eros.'),
(10, 'Neon', 0, 57.65, 14, 'img10.jpg', 'Proin vel leo non augue lobortis ultricies.'),
(11, 'Sodium', 0, 45.22, 20, 'img11.jpg', 'Sed vehicula nisi vitae dui.'),
(12, 'Magnesium', 3, 98.52, 10, 'img12.jpg', 'Maecenas quis arcu sed orci vestibulum interdum.'),
(13, 'Aluminum', 2, 23.59, 10, 'img13.jpg', 'Vestibulum lobortis imperdiet pede.'),
(14, 'Silicon', 1, 57.65, 19, 'img14.jpg', 'Integer ultrices tincidunt libero.'),
(15, 'Phosphorus', 2, 45.22, 10, 'img15.jpg', 'Aliquam tempor neque ac leo scelerisque pharetra.'),
(16, 'Sulfur', 1, 98.52, 9, 'img16.jpg', 'Curabitur elementum neque quis tellus.'),
(17, 'Chlorine', 3, 23.59, 9, 'img17.jpg', 'Fusce nonummy lorem eget lectus.'),
(18, 'Argon', 0, 57.65, 15, 'img18.jpg', 'Vivamus eleifend felis et felis.'),
(19, 'Potassium', 0, 45.22, 14, 'img19.jpg', 'Praesent feugiat suscipit tellus.'),
(20, 'Calcium', 3, 98.52, 7, 'img20.jpg', 'Sed ultricies neque vitae lectus.'),
(21, 'Scandium', 2, 23.59, 13, 'img21.jpg', 'Donec gravida justo sit amet neque.'),
(22, 'Titanium', 2, 57.65, 12, 'img22.jpg', 'Vestibulum tempor est in mauris.'),
(23, 'Vanadium', 2, 45.22, 4, 'img23.jpg', 'Nunc ultrices nulla vitae purus.'),
(24, 'Chromium', 1, 98.52, 9, 'img24.jpg', 'Morbi pretium odio in orci.'),
(25, 'Manganese', 2, 23.59, 2, 'img25.jpg', 'Ut et nibh eu nisi tincidunt tempus.'),
(26, 'Iron', 0, 57.65, 11, 'img26.jpg', 'Vestibulum dictum nonummy nisl.'),
(27, 'Cobalt', 0, 45.22, 5, 'img27.jpg', 'Nulla nonummy tellus ac metus.'),
(28, 'Nickel', 0, 98.52, 12, 'img28.jpg', 'Pellentesque tincidunt nonummy urna.'),
(29, 'Copper', 1, 23.59, 17, 'img29.jpg', 'Aliquam non est vel quam porta pharetra.'),
(30, 'Zinc', 1, 57.65, 7, 'img30.jpg', 'Ut sollicitudin condimentum mauris.'),
(31, 'Gallium', 0, 45.22, 8, 'img31.jpg', 'Nam in velit sit amet augue ultricies sollicitudin.'),
(32, 'Germanium', 3, 98.52, 14, 'img32.jpg', 'Fusce mollis dapibus lectus.'),
(33, 'Arsenic', 0, 23.59, 1, 'img33.jpg', 'Duis porta urna sit amet purus.'),
(34, 'Selenium', 0, 57.65, 13, 'img34.jpg', 'Nulla fermentum imperdiet tellus.'),
(35, 'Bromine', 1, 45.22, 12, 'img35.jpg', 'Fusce interdum eros et tortor.'),
(36, 'Krypton', 2, 98.52, 12, 'img36.jpg', 'Cras lobortis libero sit amet quam.'),
(37, 'Rubidium', 0, 23.59, 5, 'img37.jpg', 'Maecenas ultrices turpis et purus faucibus consequat.'),
(38, 'Strontium', 2, 57.65, 10, 'img38.jpg', 'Maecenas nec libero sit amet mauris porttitor vehicula.'),
(39, 'Yttrium', 3, 45.22, 12, 'img39.jpg', 'Vestibulum vitae mi vel felis porta vulputate.'),
(40, 'Zirconium', 2, 98.52, 15, 'img40.jpg', 'Sed vitae dui eu orci tristique volutpat.'),
(41, 'Niobium', 1, 23.59, 4, 'img41.jpg', 'Quisque blandit cursus orci.'),
(42, 'Molybdenum', 1, 57.65, 20, 'img42.jpg', 'Proin auctor lectus ut libero.'),
(43, 'Technetium', 3, 45.22, 10, 'img43.jpg', 'Phasellus condimentum erat ut nunc.'),
(44, 'Ruthenium', 0, 98.52, 20, 'img44.jpg', 'Sed eleifend volutpat pede.'),
(45, 'Rhodium', 2, 23.59, 17, 'img45.jpg', 'Quisque id orci vitae mi laoreet pretium.'),
(46, 'Palladium', 2, 57.65, 17, 'img46.jpg', 'Donec venenatis pede at tellus faucibus congue.'),
(47, 'Silver', 0, 45.22, 17, 'img47.jpg', 'Etiam tristique augue id mauris.'),
(48, 'Cadmium', 1, 98.52, 9, 'img48.jpg', 'Etiam quis massa at eros imperdiet sollicitudin.'),
(49, 'Indium', 0, 23.59, 10, 'img49.jpg', 'Aenean ultrices tortor eget tellus.'),
(50, 'Tin', 2, 57.65, 11, 'img50.jpg', 'Nulla eu orci vitae ante imperdiet venenatis.'),
(51, 'Antimony', 0, 45.22, 19, 'img51.jpg', 'Vivamus nec arcu a nibh dictum rhoncus.'),
(52, 'Tellurium', 1, 98.52, 18, 'img52.jpg', 'Aenean iaculis nisi nec arcu.'),
(53, 'Iodine', 3, 23.59, 9, 'img53.jpg', 'Aenean placerat velit non justo.'),
(54, 'Xenon', 1, 57.65, 4, 'img54.jpg', 'Phasellus vel enim nec est porta dictum.'),
(55, 'Cesium', 1, 45.22, 8, 'img55.jpg', 'Sed mattis ante ac mauris sagittis suscipit.'),
(56, 'Barium', 3, 98.52, 19, 'img56.jpg', 'Sed elementum porttitor elit.'),
(57, 'Lanthanum', 1, 23.59, 9, 'img57.jpg', 'Vestibulum convallis tempus odio.'),
(58, 'Cerium', 1, 57.65, 2, 'img58.jpg', 'Vestibulum dapibus fringilla tellus.'),
(59, 'Praseodymium', 0, 45.22, 11, 'img59.jpg', 'Sed vehicula venenatis lacus.'),
(60, 'Neodymium', 3, 98.52, 19, 'img60.jpg', 'Morbi ullamcorper nibh a metus.'),
(61, 'Promethium', 3, 23.59, 19, 'img61.jpg', 'Nullam eleifend mauris in odio rutrum iaculis.'),
(62, 'Samarium', 1, 57.65, 19, 'img62.jpg', 'Nulla et enim in odio auctor pellentesque.'),
(63, 'Europium', 0, 45.22, 4, 'img63.jpg', 'Quisque vehicula egestas dolor.'),
(64, 'Gadolinium', 1, 98.52, 18, 'img64.jpg', 'Curabitur ultrices nulla id ipsum.');
