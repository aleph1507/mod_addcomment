CREATE TABLE IF NOT EXISTS `#__comments` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `comment` varchar(120) NOT NULL,
    `article_id` int(10) NOT NULL,

    PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;