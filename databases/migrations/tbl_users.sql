CREATE TABLE IF NOT EXISTS `users`(
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(50) NOT NULL,
    `password` varchar(150) NOT NULL,
    `user_type` enum('ADMIN','CUSTOMER') DEFAULT 'CUSTOMER',
    `is_superadmin` boolean DEFAULT FALSE,
    `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_uk` (`email`)
);