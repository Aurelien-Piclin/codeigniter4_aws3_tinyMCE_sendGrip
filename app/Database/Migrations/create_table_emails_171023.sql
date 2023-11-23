CREATE TABLE `emails` (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `uuid` char(36) NOT NULL DEFAULT '',
                          `to_email` varchar(250) DEFAULT NULL,
                          `from_email` varchar(250) DEFAULT NULL,
                          `email_subject` varchar(250) DEFAULT NULL,
                          `email_body` text,
                          `aws_bucket` varchar(100),
                          `aws_folder` varchar(200),
                          `aws_file_name` varchar(100),
                          `status` tinyint(3) NOT NULL DEFAULT '0',
                          `created` datetime DEFAULT CURRENT_TIMESTAMP,
                          `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                          PRIMARY KEY (`id`),
                          UNIQUE KEY `uuid` (`uuid`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;