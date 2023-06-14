DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(256) NOT NULL,
                        `firstname` varchar(256) NOT NULL,
                        `email` varchar(256) NOT NULL,
                        `password` varchar(256) NOT NULL,
                        `activation_token` varchar(128) NOT NULL,
                        `activation_expire` timestamp,
                        `renew_token` varchar(128),
                        `renew_expires` timestamp,
                        `is_active` tinyint(4) NOT NULL DEFAULT '0',
                        `role` int(4) NOT NULL,
                        `level` int(4) NOT NULL DEFAULT '1',
                        `created_at` datetime NOT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;