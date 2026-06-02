-- ============================================================
-- EcoSprout - SAMPLE DATA (run AFTER schema.sql)
-- phpMyAdmin: SQL tab | MySQL Workbench: execute script
-- ============================================================

USE ecosprout;

-- Users (login with EMAIL + password)
INSERT IGNORE INTO users (id, email, password, full_name, phone, role, is_active) VALUES
(1, 'admin@ecosprout.com', 'Admin123', 'Admin User', NULL, 2, 1),
(2, 'staff@ecosprout.com', 'Staff123', 'Staff Member', NULL, 1, 1),
(3, 'customer@ecosprout.com', 'Customer123', 'John Customer', '555-0100', 0, 1);

-- Plants (catalogue)
INSERT INTO plants (name, category, description, price, stock, difficulty, image_url) VALUES
('Monstera Deliciosa', 'Indoor', 'Tropical plant with distinctive split leaves.', 29.99, 15, 'Intermediate', 'assets/images/plant-1.jpg'),
('Snake Plant', 'Indoor', 'Hardy air-purifying plant for low light.', 19.99, 23, 'Beginner', 'assets/images/plant-2.jpg'),
('Aloe Vera', 'Medicinal', 'Medicinal succulent with gel-filled leaves.', 12.99, 12, 'Beginner', 'assets/images/plant-3.jpg'),
('Golden Pothos', 'Indoor', 'Trailing vine with golden foliage.', 22.99, 8, 'Beginner', 'assets/images/plant-6.jpg'),
('Lavender Plant', 'Outdoor', 'Fragrant outdoor flowering plant.', 12.99, 10, 'Beginner', 'assets/images/plant-5.jpg'),
('Phalaenopsis Orchid', 'Flowering', 'Elegant flowering plant with long-lasting blooms.', 45.99, 6, 'Advanced', 'assets/images/plant-4.jpg'),
('ZZ Plant', 'Indoor', 'Modern glossy plant, low maintenance.', 32.99, 14, 'Beginner', 'assets/images/plant-8.jpg'),
('Jade Plant', 'Succulents', 'Hardy succulent symbol of prosperity.', 24.99, 18, 'Beginner', 'assets/images/plant-7.jpg');

-- Tools
INSERT INTO tools (name, description, price, stock, image_url) VALUES
('Pruning Shears', 'Professional-grade stainless steel pruning shears.', 24.99, 30, 'assets/images/tool-1.jpg'),
('Watering Can (2L)', 'Elegant metal watering can with rose attachment.', 18.99, 25, 'assets/images/tool-2.jpg'),
('Soil Moisture Meter', 'Digital moisture meter for accurate soil checks.', 14.99, 40, 'assets/images/tool-3.jpg'),
('Gardening Gloves Set', 'Durable leather gloves. Set of 2 pairs.', 12.99, 50, 'assets/images/tool-4.jpg'),
('Ceramic Planter Set (3-Pack)', 'Ceramic pots with drainage holes.', 34.99, 20, 'assets/images/tool-5.jpg'),
('Garden Shovel', 'Heavy-duty steel shovel for planting.', 18.99, 22, 'assets/images/tool-6.jpg');

-- Services
INSERT INTO services (name, description, price, price_note, icon_emoji) VALUES
('Plant Care Consultation', 'Personalized advice on plant selection and maintenance.', 49.99, NULL, '🌿'),
('Garden Design', 'Custom garden design for your space and climate.', 299.99, NULL, '🎨'),
('Installation & Setup', 'Installation of planters and irrigation systems.', 159.99, NULL, '🔧'),
('Regular Maintenance', 'Monthly plant care and maintenance service.', 99.99, 'per month', '💚'),
('Pest Management', 'Eco-friendly pest control for your plants.', 79.99, NULL, '🐛'),
('Expert Consultation', 'One-hour session with a senior horticulturist.', 89.99, NULL, '🎓');

-- Workshops
INSERT INTO workshops (title, description, event_date, event_time, duration_hours, difficulty, capacity, spots_available, price) VALUES
('Indoor Plant Care Basics', 'Fundamentals of caring for indoor plants.', '2026-07-15', '10:00:00', 2.0, 'Beginner', 20, 18, 19.99),
('Propagation Techniques', 'Plant propagation through cuttings and division.', '2026-07-22', '14:00:00', 3.0, 'Intermediate', 15, 12, 29.99),
('Outdoor Garden Planning', 'Design your outdoor garden with expert guidance.', '2026-07-29', '09:00:00', 4.0, 'Intermediate', 25, 20, 34.99),
('Succulent & Cactus Care', 'Grow and maintain succulents and cacti.', '2026-08-06', '13:00:00', 2.5, 'Beginner', 20, 20, 24.99),
('Urban Gardening Techniques', 'Gardening in small urban spaces.', '2026-08-13', '11:00:00', 2.0, 'Beginner', 18, 15, 22.99),
('Organic Composting 101', 'Create nutrient-rich compost at home.', '2026-08-20', '10:00:00', 2.0, 'Beginner', 22, 22, 18.99);

-- Sample orders for customer dashboard / staff orders
INSERT INTO shop_orders (user_id, order_number, total_amount, status, shipping_address, payment_method) VALUES
(3, 'ORD-10001', 64.78, 'pending', '123 Green Lane, Eco City, EC 12345', 'card'),
(3, 'ORD-10002', 49.97, 'shipped', '123 Green Lane, Eco City, EC 12345', 'card');

INSERT INTO shop_order_items (order_id, product_type, product_id, product_name, quantity, unit_price, line_total) VALUES
(1, 'plant', 1, 'Monstera Deliciosa', 1, 29.99, 29.99),
(1, 'plant', 2, 'Snake Plant', 1, 19.99, 19.99),
(1, 'tool', 2, 'Watering Can (2L)', 1, 18.99, 18.99),
(2, 'plant', 3, 'Aloe Vera', 2, 12.99, 25.98),
(2, 'tool', 3, 'Soil Moisture Meter', 1, 14.99, 14.99),
(2, 'tool', 4, 'Gardening Gloves Set', 1, 12.99, 12.99);

-- Bookings (customer bookings page)
INSERT INTO bookings (user_id, booking_number, booking_type, reference_id, booking_date, booking_time, status) VALUES
(3, 'BK-001', 'service', 1, '2026-07-10', '10:00:00', 'upcoming'),
(3, 'BK-002', 'workshop', 2, '2026-07-22', '14:00:00', 'upcoming');

-- Customer queries (contact form / staff queries)
INSERT INTO customer_queries (user_id, full_name, email, subject, message, status) VALUES
(3, 'Sarah Brown', 'sarah@example.com', 'Watering Monstera', 'I just got a Monstera and need help with watering schedule.', 'new'),
(NULL, 'Tom Wilson', 'tom@example.com', 'July workshops', 'Are there workshops scheduled for next month?', 'new'),
(NULL, 'Lisa Green', 'lisa@example.com', 'Bulk order', 'Can I place a bulk order for office plants?', 'in_progress');

-- Blog
INSERT INTO blog_articles (title, category, content, image_url, published_at) VALUES
('How to Revive a Dying Plant', 'Plant Care', 'Step-by-step tips to rescue struggling houseplants.', 'assets/images/blog-1.jpg', '2026-06-01'),
('Summer Garden Maintenance Guide', 'Seasonal Tips', 'Keep your garden thriving during hot months.', 'assets/images/blog-2.jpg', '2026-05-28'),
('Best Indoor Plants for Beginners', 'Plant Care', 'Easy plants that thrive with minimal care.', 'assets/images/blog-3.jpg', '2026-05-20');
