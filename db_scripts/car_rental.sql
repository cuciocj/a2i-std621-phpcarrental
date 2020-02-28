CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(20) UNIQUE NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) UNIQUE NOT NULL,
  `date_joined` date NOT NULL,
  `role_id` int NOT NULL
);

CREATE TABLE `roles` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar[15] UNIQUE NOT NULL
);

CREATE TABLE `vehicles` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `body` varchar(15) NOT NULL,
  `color` varchar(10) NOT NULL,
  `transmission` varchar(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT 0
);

CREATE TABLE `transactions` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `vehicle_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `approving_officer` int NOT NULL
);

CREATE TABLE `rent_requests` (
  `user_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `vehicle_id` int NOT NULL
);

CREATE TABLE `user_feedbacks` (
  `user_id` int NOT NULL,
  `subject` varchar(50) NOT NULL DEFAULT "no subject",
  `message` varchar(255) NOT NULL DEFAULT "no message",
  `type` varchar(10) NOT NULL,
  `date_received` date DEFAULT "now()"
);

ALTER TABLE `users` ADD FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

ALTER TABLE `transactions` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `transactions` ADD FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

ALTER TABLE `transactions` ADD FOREIGN KEY (`approving_officer`) REFERENCES `users` (`id`);

ALTER TABLE `users` ADD FOREIGN KEY (`id`) REFERENCES `rent_requests` (`user_id`);

ALTER TABLE `rent_requests` ADD FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

ALTER TABLE `user_feedbacks` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
