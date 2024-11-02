CREATE TABLE IF NOT EXISTS `categories`(
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `category_name` varchar(100) NOT NULL,
    `image` varchar(50),
    `is_featured` boolean DEFAULT FALSE,
    `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`)
);

INSERT INTO `categories` (`category_name`, `image`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
('Category 1', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 2', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 3', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 4', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 5', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 6', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 7', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 8', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 9', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 10', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 11', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 12', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 13', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 14', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 15', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 16', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 17', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 18', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 19', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 20', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 21', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 22', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 23', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 24', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 25', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 26', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 27', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 28', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 29', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 30', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 31', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 32', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 33', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 34', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 35', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 36', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 37', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 38', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 39', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 40', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 41', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 42', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 43', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 44', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 45', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 46', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 47', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 48', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 49', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 50', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 51', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 52', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 53', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 54', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 55', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 56', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 57', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 58', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 59', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 60', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 61', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 62', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 63', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 64', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 65', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 66', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 67', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 68', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 69', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 70', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 71', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 72', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 73', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 74', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 75', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 76', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 77', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 78', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 79', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 80', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 81', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 82', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 83', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 84', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 85', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 86', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 87', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 88', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 89', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 90', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 91', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 92', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 93', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 94', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 95', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 96', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 97', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 98', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 99', 'https://placehold.co/100x100', TRUE, 'ACTIVE', CURRENT_TIMESTAMP, NULL),
('Category 100', 'https://placehold.co/100x100', FALSE, 'INACTIVE', CURRENT_TIMESTAMP, NULL);