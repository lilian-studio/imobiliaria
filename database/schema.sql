-- Schema para sistema de imobiliária
-- Cria banco e tabelas básicas
CREATE DATABASE IF NOT EXISTS `imobiliaria` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `imobiliaria`;

-- tabela de imóveis
CREATE TABLE IF NOT EXISTS `properties` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `price` DECIMAL(12,2) DEFAULT 0.00,
  `address` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- imagens dos imóveis
CREATE TABLE IF NOT EXISTS `property_images` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `property_id` INT UNSIGNED NOT NULL,
  `filename` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX (`property_id`),
  CONSTRAINT `fk_property_images_property` FOREIGN KEY (`property_id`) REFERENCES `properties`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
