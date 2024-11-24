CREATE TABLE IF NOT EXISTS `brands`(
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `brand_name` varchar(100) NOT NULL,
    `logo` varchar(50),
    `is_featured` boolean DEFAULT FALSE,
    `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`)
);