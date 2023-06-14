-- Adminer 4.8.1 MySQL 5.5.5-10.3.11-MariaDB-1:10.3.11+maria~bionic dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `user` (`id`, `name`, `firstname`, `email`, `password`, `activation_token`, `activation_expire`, `renew_token`, `renew_expires`, `is_active`, `role`, `level`, `created_at`)
VALUES
    (1, 'admin', 'admin', 'Admin@mail.com', 'Admin1234_', 'fb5d3a14f5085b4decb07cff6f5b20b67fb2684136f92ef31e7fa4d9f3e0ddb2', '2023-06-16 16:20:00', '4f629e1ad04fb29476b5df0126f23469dd18c27d08745e1ef6743708628391f2ba83a224d601f983362bc492dee6ee8e87e39a79640a9d452e1eeac5f052f3ab', '2023-06-17 15:50:00', 1, 1000 , 1000, '2023-06-13 14:41:00');
