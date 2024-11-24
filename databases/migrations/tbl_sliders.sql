CREATE TABLE IF NOT EXISTS `sliders`(
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `title` varchar(100) NOT NULL,
    `image` varchar(100) NOT NULL,
    `description` text DEFAULT NULL,
    `btn_text` varchar(30) DEFAULT NULL,
    `btn_link` varchar(50) DEFAULT NULL,
    `show_btn` enum('YES','NO') DEFAULT 'YES',
    `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`)
);
