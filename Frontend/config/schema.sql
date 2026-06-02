-- ============================================================
-- EcoSprout Nursery - COMPLETE DATABASE SCHEMA
-- Run in phpMyAdmin (SQL tab) or MySQL Workbench
-- Login: email + password | Tables match all website modules
-- ============================================================

CREATE DATABASE IF NOT EXISTS ecosprout CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ecosprout;

-- ------------------------------------------------------------
-- 1. USERS (login, register, admin user management)
-- role: 0 = Customer, 1 = Staff, 2 = Admin
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(191) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  full_name VARCHAR(255) NOT NULL,
  phone VARCHAR(50) DEFAULT NULL,
  role TINYINT NOT NULL DEFAULT 0,
  is_active TINYINT NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- 2. PLANTS (catalogue.php, plant.php, staff Manage Plants)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS plants (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  category VARCHAR(100) NOT NULL,
  description TEXT,
  price DECIMAL(10, 2) NOT NULL,
  stock INT NOT NULL DEFAULT 0,
  difficulty VARCHAR(50) DEFAULT 'Beginner',
  image_url VARCHAR(255) DEFAULT 'assets/images/plant-1.jpg',
  image_url_2 VARCHAR(255) DEFAULT NULL,
  image_url_3 VARCHAR(255) DEFAULT NULL,
  is_active TINYINT NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- 3. TOOLS (tools.php, staff Manage Tools, cart/checkout)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tools (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10, 2) NOT NULL,
  stock INT NOT NULL DEFAULT 0,
  image_url VARCHAR(255) DEFAULT 'assets/images/tool-1.jpg',
  image_url_2 VARCHAR(255) DEFAULT NULL,
  image_url_3 VARCHAR(255) DEFAULT NULL,
  is_active TINYINT NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- 4. SERVICES (services.php, staff Manage Services, bookings)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10, 2) NOT NULL,
  price_note VARCHAR(100) DEFAULT NULL,
  icon_emoji VARCHAR(20) DEFAULT NULL,
  image_url VARCHAR(255) DEFAULT 'assets/images/service-1.jpg',
  image_url_2 VARCHAR(255) DEFAULT NULL,
  image_url_3 VARCHAR(255) DEFAULT NULL,
  is_active TINYINT NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- 5. WORKSHOPS (workshops.php, staff Manage Workshops, bookings)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS workshops (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  event_date DATE NOT NULL,
  event_time TIME NOT NULL,
  duration_hours DECIMAL(4, 1) DEFAULT 2.0,
  difficulty VARCHAR(50) DEFAULT 'Beginner',
  capacity INT NOT NULL DEFAULT 20,
  spots_available INT NOT NULL DEFAULT 20,
  price DECIMAL(10, 2) NOT NULL,
  image_url VARCHAR(255) DEFAULT 'assets/images/workshop-1.jpg',
  image_url_2 VARCHAR(255) DEFAULT NULL,
  image_url_3 VARCHAR(255) DEFAULT NULL,
  is_active TINYINT NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- 6. SHOP ORDERS (customer orders, staff Process Orders, admin reports)
-- Table name shop_orders avoids MySQL reserved word "orders"
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS shop_orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  order_number VARCHAR(20) NOT NULL UNIQUE,
  order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  total_amount DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  status VARCHAR(50) NOT NULL DEFAULT 'pending',
  shipping_address TEXT,
  payment_method VARCHAR(50) DEFAULT 'card',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_shop_orders_user (user_id),
  CONSTRAINT fk_shop_orders_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- 7. SHOP ORDER ITEMS (plants + tools in one order)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS shop_order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_type VARCHAR(20) NOT NULL,
  product_id INT NOT NULL,
  product_name VARCHAR(255) NOT NULL,
  quantity INT NOT NULL DEFAULT 1,
  unit_price DECIMAL(10, 2) NOT NULL,
  line_total DECIMAL(10, 2) NOT NULL,
  INDEX idx_shop_order_items_order (order_id),
  CONSTRAINT fk_shop_order_items_order FOREIGN KEY (order_id) REFERENCES shop_orders(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- 8. BOOKINGS (customer bookings: services + workshops)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  booking_number VARCHAR(20) NOT NULL UNIQUE,
  booking_type VARCHAR(20) NOT NULL,
  reference_id INT NOT NULL,
  booking_date DATE NOT NULL,
  booking_time TIME DEFAULT NULL,
  status VARCHAR(50) NOT NULL DEFAULT 'upcoming',
  notes TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_bookings_user (user_id),
  CONSTRAINT fk_bookings_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- 9. CUSTOMER QUERIES (contact.php, staff Handle Queries)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS customer_queries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT DEFAULT NULL,
  full_name VARCHAR(255) NOT NULL,
  email VARCHAR(191) NOT NULL,
  subject VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  status VARCHAR(50) NOT NULL DEFAULT 'new',
  staff_reply TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_queries_user (user_id),
  CONSTRAINT fk_queries_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- 10. BLOG ARTICLES (blog.php, article.php) - optional content
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS blog_articles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  category VARCHAR(100) NOT NULL,
  content TEXT NOT NULL,
  image_url VARCHAR(255) DEFAULT 'assets/images/blog-1.jpg',
  published_at DATE NOT NULL,
  is_active TINYINT NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- 11. NEWSLETTER (home page signup)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS newsletter_subscribers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(191) NOT NULL UNIQUE,
  subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
