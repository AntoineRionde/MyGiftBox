DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(255) NOT NULL,
                        `firstname` varchar(255) NOT NULL,
                        `email` varchar(255) NOT NULL,
                        `password` varchar(255) NOT NULL,
                        `activation_token` varchar(255) NOT NULL,
                        `activation_expire` timestamp,
                        `renew_token` varchar(128),
                        `renew_expires` timestamp,
                        `is_active` tinyint(1) NOT NULL DEFAULT '0',
                        `role` varchar(255) NOT NULL,
                        `level` int(11) NOT NULL DEFAULT '1',
                        `created_at` datetime NOT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;