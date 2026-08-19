-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 03, 2026 at 02:08 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecosprout`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_articles`
--

DROP TABLE IF EXISTS `blog_articles`;
CREATE TABLE IF NOT EXISTS `blog_articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'assets/images/blog-1.jpg',
  `published_at` date NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_articles`
--

INSERT INTO `blog_articles` (`id`, `title`, `category`, `content`, `image_url`, `published_at`, `is_active`, `created_at`) VALUES
(1, 'How to Revive a Dying Plant', 'Plant Care', 'Step-by-step tips to rescue struggling houseplants.', 'assets/images/plantdead.jpg', '2026-06-01', 1, '2026-06-01 23:21:36'),
(2, 'Summer Garden Maintenance Guide', 'Seasonal Tips', 'Keep your garden thriving during hot months.', 'assets/images/blog-2.jpg', '2026-05-28', 1, '2026-06-01 23:21:36'),
(3, 'Best Indoor Plants for Beginners', 'Plant Care', 'Easy plants that thrive with minimal care.', 'assets/images/blog-3.jpg', '2026-05-20', 1, '2026-06-01 23:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `booking_number` varchar(20) NOT NULL,
  `booking_type` varchar(20) NOT NULL,
  `reference_id` int NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'upcoming',
  `notes` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_number` (`booking_number`),
  KEY `idx_bookings_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `booking_number`, `booking_type`, `reference_id`, `booking_date`, `booking_time`, `status`, `notes`, `created_at`) VALUES
(1, 3, 'BK-001', 'service', 1, '2026-07-10', '10:00:00', 'upcoming', NULL, '2026-06-01 23:21:36'),
(2, 3, 'BK-002', 'workshop', 2, '2026-07-22', '14:00:00', 'upcoming', NULL, '2026-06-01 23:21:36'),
(3, 3, 'BK-20260602-3-1', 'service', 6, '2026-06-02', '10:00:00', 'upcoming', 'Created from order ORD-20260602-3330', '2026-06-02 05:34:17'),
(4, 5, 'BK26060309453317', 'workshop', 1, '2026-07-15', '10:00:00', 'upcoming', 'Created from order ORD-20260603-2868', '2026-06-03 09:45:33'),
(5, 5, 'BK26060309511969', 'workshop', 1, '2026-07-15', '10:00:00', 'upcoming', 'Created from order ORD-20260603-2857', '2026-06-03 09:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `customer_queries`
--

DROP TABLE IF EXISTS `customer_queries`;
CREATE TABLE IF NOT EXISTS `customer_queries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(191) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'new',
  `staff_reply` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_queries_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_queries`
--

INSERT INTO `customer_queries` (`id`, `user_id`, `full_name`, `email`, `subject`, `message`, `status`, `staff_reply`, `created_at`) VALUES
(1, 3, 'Sarah Brown', 'sarah@example.com', 'Watering Monstera', 'I just got a Monstera and need help with watering schedule.', 'new', NULL, '2026-06-01 23:21:36'),
(2, NULL, 'Tom Wilson', 'tom@example.com', 'July workshops', 'Are there workshops scheduled for next month?', 'resolved', 'Yes, workshops are scheduled', '2026-06-01 23:21:36'),
(3, NULL, 'Lisa Green', 'lisa@example.com', 'Bulk order', 'Can I place a bulk order for office plants?', 'resolved', '', '2026-06-01 23:21:36'),
(4, NULL, 'Henry Cavil', 'cavil12@gmail.com', 'consulting', 'Can consultations take place in any day of the week?', 'resolved', NULL, '2026-06-03 10:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

DROP TABLE IF EXISTS `newsletter_subscribers`;
CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

DROP TABLE IF EXISTS `plants`;
CREATE TABLE IF NOT EXISTS `plants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'assets/images/plant-1.jpg',
  `image_url_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `name`, `category`, `description`, `price`, `stock`, `image_url`, `image_url_2`, `image_url_3`, `is_active`, `created_at`) VALUES
(1, 'Monstera Deliciosa', 'Indoor', 'Tropical plant with distinctive split leaves.', '29.99', 15, 'assets/images/MonsteraDeliciosa.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(2, 'Snake Plant', 'Indoor', 'Hardy air-purifying plant for low light.', '19.99', 23, 'assets/images/ssss.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(3, 'Aloe Vera', 'Medicinal', 'Medicinal succulent with gel-filled leaves.', '12.99', 12, 'assets/images/aloev.avif', NULL, NULL, 1, '2026-06-01 23:21:36'),
(4, 'Golden Pothos', 'Indoor', 'Trailing vine with golden foliage.', '22.99', 8, 'assets/images/GoldenPothos.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(5, 'Lavender Plant', 'Outdoor', 'Fragrant outdoor flowering plant.', '12.99', 10, 'assets/images/lavenderplant.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(6, 'Phalaenopsis Orchid', 'Flowering', 'Elegant flowering plant with long-lasting blooms.', '45.99', 6, 'assets/images/orchidd.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(9, 'Cactus', 'Indoor', 'Symbol of sustainability and minimal maintenance. They thrive in arid conditions and require minimal watering, making them perfect for sustainable gardening enthusiasts', '1699.00', 5, 'assets/images/cactuswhite.jpg', '', '', 1, '2026-06-02 07:13:23'),
(10, 'Peace Lily', 'Indoor', 'Elegant flowering plant known for its air-purifying qualities and low maintenance care.', '24.99', 25, 'assets/images/peacelily.avif', NULL, NULL, 1, '2026-06-02 19:13:33'),
(11, 'Areca Palm', 'Indoor', 'Popular tropical palm that adds a lush, vibrant look to living rooms and offices.', '34.99', 18, 'assets/images/arecapalm.avif', NULL, NULL, 1, '2026-06-02 19:13:33'),
(12, 'Bird of Paradise', 'Outdoor', 'Striking ornamental plant with large leaves and exotic flowers resembling tropical birds.', '49.99', 12, 'assets/images/birdparadise.avif', NULL, NULL, 1, '2026-06-02 19:13:33'),
(13, 'Jade Plant', 'Succulent', 'Hardy succulent with thick glossy leaves, believed to bring prosperity and good luck.', '19.99', 30, 'assets/images/jadeplant.avif', NULL, NULL, 1, '2026-06-02 19:13:33'),
(14, 'Hibiscus', 'Outdoor', 'Beautiful flowering shrub producing large colorful blooms throughout the growing season.', '27.99', 20, 'assets/images/Hibiscus.jpg', NULL, NULL, 1, '2026-06-02 19:13:33'),
(15, 'Majesty Palm', 'Indoor', 'Scientifically known as Ravenea rivularis, is a tropical marvel that brings a touch of the exotic to any space.  ', '45.99', 10, 'assets/images/palm.jpg', NULL, NULL, 1, '2026-06-03 10:59:52'),
(16, 'Olive tree', 'Indoor', 'Bring a timeless Mediterranean charm and natural elegance to both indoor and outdoor spaces, blending rustic, minimalist, and modern aesthetics.', '79.99', 20, 'assets/images/olive.jpg', NULL, NULL, 1, '2026-06-03 11:10:08');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `price_note` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_emoji` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'assets/images/service-1.jpg',
  `image_url_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `price_note`, `icon_emoji`, `image_url`, `image_url_2`, `image_url_3`, `is_active`, `created_at`) VALUES
(2, 'Garden Design', 'Custom garden design for your space and climate.', '299.99', NULL, '🎨', 'assets/images/design.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(3, 'Installation & Setup', 'Installation of planters and irrigation systems.', '159.99', NULL, '🔧', 'assets/images/gardener-installing.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(4, 'Regular Maintenance', 'Monthly plant care and maintenance service.', '99.99', 'per month', '💚', 'assets/images/professional-gardener.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(5, 'Pest Management', 'Eco-friendly pest control for your plants.', '79.99', NULL, '🐛', 'assets/images/pest.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(6, 'Expert Consultation', 'One-hour session with a senior horticulturist.', '89.99', NULL, '🎓', 'assets/images/consultation.jpeg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(7, 'Irrigation System', '', '0.00', '', '🌿', 'assets/images/garden-irrigation.jpeg', NULL, NULL, 1, '2026-06-02 06:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `shop_orders`
--

DROP TABLE IF EXISTS `shop_orders`;
CREATE TABLE IF NOT EXISTS `shop_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `shipping_address` text,
  `payment_method` varchar(50) DEFAULT 'card',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_number` (`order_number`),
  KEY `idx_shop_orders_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shop_orders`
--

INSERT INTO `shop_orders` (`id`, `user_id`, `order_number`, `order_date`, `total_amount`, `status`, `shipping_address`, `payment_method`, `created_at`) VALUES
(1, 3, 'ORD-10001', '2026-06-02 04:51:36', '64.78', 'pending', '123 Green Lane, Eco City, EC 12345', 'card', '2026-06-01 23:21:36'),
(2, 3, 'ORD-10002', '2026-06-02 04:51:36', '49.97', 'shipped', '123 Green Lane, Eco City, EC 12345', 'card', '2026-06-01 23:21:36'),
(4, 3, 'ORD-20260602-3330', '2026-06-02 11:04:17', '179.98', 'ready_to_ship', 'John Customer | customer@ecosprout.com | No.138/D, 2nd Street, Jaela', 'demo', '2026-06-02 05:34:17'),
(11, 4, 'ORD-20260602-7220', '2026-06-02 13:38:08', '3398.00', 'pending', 'Steven | steven@gmail.com | No.138/D, Gem Mawatha, Jaela', 'demo', '2026-06-02 08:08:08'),
(12, 5, 'ORD-20260603-2868', '2026-06-03 15:15:33', '19.99', 'pending', 'Stacy Wong | stacy13@gmail.com | No.12, 1st Street, Colombo', 'demo', '2026-06-03 09:45:33'),
(13, 5, 'ORD-20260603-2857', '2026-06-03 15:21:19', '19.99', 'pending', 'Stacy Wong | stacy13@gmail.com | No. 56, 2nd Street, Colombo 02', 'demo', '2026-06-03 09:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_items`
--

DROP TABLE IF EXISTS `shop_order_items`;
CREATE TABLE IF NOT EXISTS `shop_order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_type` varchar(20) NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `unit_price` decimal(10,2) NOT NULL,
  `line_total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_shop_order_items_order` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shop_order_items`
--

INSERT INTO `shop_order_items` (`id`, `order_id`, `product_type`, `product_id`, `product_name`, `quantity`, `unit_price`, `line_total`) VALUES
(1, 1, 'plant', 1, 'Monstera Deliciosa', 1, '29.99', '29.99'),
(2, 1, 'plant', 2, 'Snake Plant', 1, '19.99', '19.99'),
(3, 1, 'tool', 2, 'Watering Can (2L)', 1, '18.99', '18.99'),
(4, 2, 'plant', 3, 'Aloe Vera', 2, '12.99', '25.98'),
(5, 2, 'tool', 3, 'Soil Moisture Meter', 1, '14.99', '14.99'),
(6, 2, 'tool', 4, 'Gardening Gloves Set', 1, '12.99', '12.99'),
(8, 4, 'service', 6, 'Expert Consultation', 2, '89.99', '179.98'),
(15, 11, 'plant', 9, 'Cactus', 2, '1699.00', '3398.00'),
(16, 12, 'workshop', 1, 'Indoor Plant Care Basics', 1, '19.99', '19.99'),
(17, 13, 'workshop', 1, 'Indoor Plant Care Basics', 1, '19.99', '19.99');

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

DROP TABLE IF EXISTS `tools`;
CREATE TABLE IF NOT EXISTS `tools` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'assets/images/tool-1.jpg',
  `image_url_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`id`, `name`, `description`, `price`, `stock`, `image_url`, `image_url_2`, `image_url_3`, `is_active`, `created_at`) VALUES
(2, 'Watering Can (2L)', 'Elegant metal watering can with rose attachment.', '18.99', 25, 'assets/images/wateringcan.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(3, 'Soil Moisture Meter', 'Digital moisture meter for accurate soil checks.', '14.99', 40, 'assets/images/meter1.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(4, 'Gardening Gloves Set', 'Durable leather gloves. Set of 2 pairs.', '12.99', 50, 'assets/images/glove.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(5, 'Ceramic Planter Set (3-Pack)', 'Ceramic pots with drainage holes.', '34.99', 20, 'assets/images/3set.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(6, 'Garden Shovel', 'Heavy-duty steel shovel for planting.', '18.99', 22, 'assets/images/shovel1.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(7, 'Pruning Shears', 'These professional 8-inch heavy-duty anvil garden scissors are the perfect blend of strength and comfort', '799.00', 8, 'assets/images/shear.jpg', NULL, NULL, 1, '2026-06-02 05:59:28'),
(8, 'Dibber and Bulb Planter', 'Tools for making holes for seeds or bulbs, ensuring proper depth and spacing.', '169.99', 10, 'assets/images/dribber.jpg', NULL, NULL, 1, '2026-06-03 11:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint NOT NULL DEFAULT '0',
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `full_name`, `phone`, `role`, `is_active`, `created_at`) VALUES
(1, 'admin@ecosprout.com', 'Admin123', 'Admin User', NULL, 2, 1, '2026-06-01 23:21:35'),
(2, 'staff@ecosprout.com', 'Staff123', 'Staff Member', NULL, 1, 1, '2026-06-01 23:21:35'),
(3, 'customer@ecosprout.com', 'Customer123', 'John Stein', '555-0100', 0, 1, '2026-06-01 23:21:35'),
(4, 'steven@gmail.com', 'Steve123', 'Steven', '0714763290', 0, 1, '2026-06-02 07:47:50'),
(5, 'stacy13@gmail.com', 'Stacy@12wong', 'Stacy Wong', '07139588247', 0, 1, '2026-06-03 08:48:22'),
(6, 'tom23@gmial.com', 'tom@123hardy', 'Tom Hardy', '0772966301', 0, 1, '2026-06-03 11:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

DROP TABLE IF EXISTS `workshops`;
CREATE TABLE IF NOT EXISTS `workshops` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `duration_hours` decimal(4,1) DEFAULT '2.0',
  `difficulty` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'Beginner',
  `capacity` int NOT NULL DEFAULT '20',
  `spots_available` int NOT NULL DEFAULT '20',
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'assets/images/workshop-1.jpg',
  `image_url_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`id`, `title`, `description`, `event_date`, `event_time`, `duration_hours`, `difficulty`, `capacity`, `spots_available`, `price`, `image_url`, `image_url_2`, `image_url_3`, `is_active`, `created_at`) VALUES
(1, 'Indoor Plant Care Basics', 'Fundamentals of caring for indoor plants.', '2026-07-15', '10:00:00', '2.0', 'Beginner', 20, 16, '19.99', 'assets/images/workshop-1.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(2, 'Propagation Techniques', 'Plant propagation through', '2026-07-22', '14:00:00', '3.0', 'Intermediate', 15, 12, '29.99', 'assets/images/workshop-1.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(3, 'Outdoor Garden Planning', 'Design your outdoor garden with expert guidance.', '2026-07-29', '09:00:00', '4.0', 'Intermediate', 25, 20, '34.99', 'assets/images/workshop-1.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(4, 'Succulent & Cactus Care', 'Grow and maintain succulents and cacti.', '2026-08-06', '13:00:00', '2.5', 'Beginner', 20, 20, '24.99', 'assets/images/workshop-1.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(5, 'Urban Gardening Techniques', 'Gardening in small urban spaces.', '2026-08-13', '11:00:00', '2.0', 'Beginner', 18, 15, '22.99', 'assets/images/workshop-1.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(6, 'Organic Composting 101', 'Create nutrient-rich compost at home.', '2026-08-20', '10:00:00', '2.0', 'Beginner', 22, 22, '18.99', 'assets/images/workshop-1.jpg', NULL, NULL, 1, '2026-06-01 23:21:36'),
(7, 'Irrigation Maintainenance', 'Learn all the basic practices to follow daily to have long lasting systems', '2026-10-05', '09:30:00', '2.5', 'Beginner', 20, 14, '2500.00', 'assets/images/workshop-1.jpg', NULL, NULL, 1, '2026-06-03 11:54:18');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_queries`
--
ALTER TABLE `customer_queries`
  ADD CONSTRAINT `fk_queries_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `shop_orders`
--
ALTER TABLE `shop_orders`
  ADD CONSTRAINT `fk_shop_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_order_items`
--
ALTER TABLE `shop_order_items`
  ADD CONSTRAINT `fk_shop_order_items_order` FOREIGN KEY (`order_id`) REFERENCES `shop_orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
