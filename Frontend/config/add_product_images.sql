-- Run once in phpMyAdmin if you already created the database earlier.
USE ecosprout;

ALTER TABLE plants
  ADD COLUMN image_url_2 VARCHAR(255) DEFAULT NULL AFTER image_url,
  ADD COLUMN image_url_3 VARCHAR(255) DEFAULT NULL AFTER image_url_2;

ALTER TABLE tools
  ADD COLUMN image_url_2 VARCHAR(255) DEFAULT NULL AFTER image_url,
  ADD COLUMN image_url_3 VARCHAR(255) DEFAULT NULL AFTER image_url_2;

ALTER TABLE services
  ADD COLUMN image_url VARCHAR(255) DEFAULT 'assets/images/service-1.jpg' AFTER icon_emoji,
  ADD COLUMN image_url_2 VARCHAR(255) DEFAULT NULL AFTER image_url,
  ADD COLUMN image_url_3 VARCHAR(255) DEFAULT NULL AFTER image_url_2;

ALTER TABLE workshops
  ADD COLUMN image_url VARCHAR(255) DEFAULT 'assets/images/workshop-1.jpg' AFTER price,
  ADD COLUMN image_url_2 VARCHAR(255) DEFAULT NULL AFTER image_url,
  ADD COLUMN image_url_3 VARCHAR(255) DEFAULT NULL AFTER image_url_2;

