CREATE TABLE IF NOT EXISTS `products`(
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `squ` varchar(10) NOT NULL,
    `category_id` int(10) NOT NULL,
    `brand_id` int(10) NOT NULL,
    `product_name` varchar(100) NOT NULL,
    `description` text NOT NULL,
    `buying_price` double(8,2) NOT NULL DEFAULT 0,
    `selling_price` double(8,2) NOT NULL DEFAULT 0,
    `image` varchar(100) NOT NULL,
    `is_featured` boolean DEFAULT FALSE,
    `status` enum('PUBLISHED','UNPUBLISHED') DEFAULT 'PUBLISHED',
    `condition` enum('NEW','USED') DEFAULT 'NEW',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_products_squ` (`squ`),
    CONSTRAINT `fk_products_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`),
    CONSTRAINT `fk_products_brand_id` FOREIGN KEY (`brand_id`) REFERENCES `brands`(`id`)
);
