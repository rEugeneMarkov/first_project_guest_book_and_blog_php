CREATE TABLE `php-first-mySQL`.`users` ( 
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL , 
    `pass` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `email` VARCHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`)
    ) 
    ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE `php-first-mySQL`.`index` ( 
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL , 
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `content` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`id`)
    ) 
    ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE `php-first-mySQL`.`articles` ( 
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL , 
    `email` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `url` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `header` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `content` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`)
    ) 
    ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE `php-first-mySQL`.`comments` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `pid` INT(11) UNSIGNED NOT NULL DEFAULT '0',
    `aid` INT(11) UNSIGNED NOT NULL DEFAULT '0',
    `comment` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)
    )
    ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci;

INSERT INTO `index` (`name`, `date`, `content`)
VALUES ('Евгений Марков', now(), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor ligula sed risus scelerisque blandit. Nulla facilisi. Mauris iaculis mauris quis consequat sagittis. Vivamus et eros fringilla ligula iaculis varius a eu velit. In vulputate leo eu erat eleifend, quis fermentum mi mattis. Praesent hendrerit efficitur mauris in scelerisque. Proin.');

INSERT INTO `index` (`name`, `date`, `content`)
VALUES ('Евгений Марков', now(), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor ligula sed risus scelerisque blandit. Nulla facilisi. Mauris iaculis mauris quis consequat sagittis. Vivamus et eros fringilla ligula iaculis varius a eu velit. In vulputate leo eu erat eleifend, quis fermentum mi mattis. Praesent hendrerit efficitur mauris in scelerisque. Proin.');

INSERT INTO `index` (`name`, `date`, `content`)
VALUES ('Евгений Марков', now(), 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor ligula sed risus scelerisque blandit. Nulla facilisi. Mauris iaculis mauris quis consequat sagittis. Vivamus et eros fringilla ligula iaculis varius a eu velit. In vulputate leo eu erat eleifend, quis fermentum mi mattis. Praesent hendrerit efficitur mauris in scelerisque. Proin.');

INSERT INTO `index` (`name`, `date`, `content`)
VALUES ('Евгений Марков', now(), '1Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor ligula sed risus scelerisque blandit. Nulla facilisi. Mauris iaculis mauris quis consequat sagittis. Vivamus et eros fringilla ligula iaculis varius a eu velit. In vulputate leo eu erat eleifend, quis fermentum mi mattis. Praesent hendrerit efficitur mauris in scelerisque. Proin.');

INSERT INTO `index` (`name`, `date`, `content`)
VALUES ('Евгений Марков', now(), '2Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor ligula sed risus scelerisque blandit. Nulla facilisi. Mauris iaculis mauris quis consequat sagittis. Vivamus et eros fringilla ligula iaculis varius a eu velit. In vulputate leo eu erat eleifend, quis fermentum mi mattis. Praesent hendrerit efficitur mauris in scelerisque. Proin.');

INSERT INTO `index` (`name`, `date`, `content`)
VALUES ('Евгений Марков', now(), '3Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin auctor ligula sed risus scelerisque blandit. Nulla facilisi. Mauris iaculis mauris quis consequat sagittis. Vivamus et eros fringilla ligula iaculis varius a eu velit. In vulputate leo eu erat eleifend, quis fermentum mi mattis. Praesent hendrerit efficitur mauris in scelerisque. Proin.');

INSERT INTO `articles` (`name`, `email`, `url`, `header`, `content`, `date`)
VALUES ('Евгений Марков', 'reugenemarkov@gmail.com', '1Lorem-ipsum-dolor-sit-amet', '1Lorem ipsum dolor sit amet', '1Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet orci sem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ultrices quam sed diam dapibus, ut posuere dolor imperdiet. Curabitur varius ipsum eget mauris dignissim sagittis. Curabitur dignissim leo nec justo egestas mollis. Nam.', now());

INSERT INTO `articles` (`name`, `email`, `url`, `header`, `content`, `date`)
VALUES ('Евгений Марков', 'reugenemarkov@gmail.com', '2Lorem-ipsum-dolor-sit-amet', '2Lorem ipsum dolor sit amet', '2Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet orci sem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ultrices quam sed diam dapibus, ut posuere dolor imperdiet. Curabitur varius ipsum eget mauris dignissim sagittis. Curabitur dignissim leo nec justo egestas mollis. Nam.', now());

INSERT INTO `articles` (`name`, `email`, `url`, `header`, `content`, `date`)
VALUES ('Евгений Марков', 'reugenemarkov@gmail.com', '3Lorem-ipsum-dolor-sit-amet', '3Lorem ipsum dolor sit amet', '3Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet orci sem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ultrices quam sed diam dapibus, ut posuere dolor imperdiet. Curabitur varius ipsum eget mauris dignissim sagittis. Curabitur dignissim leo nec justo egestas mollis. Nam.', now());

INSERT INTO `comments` (`pid`, `aid`, `comment`, `date`)
VALUES (0, '1', '1Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tristique.', now());

INSERT INTO `comments` (`pid`, `aid`, `comment`, `date`)
VALUES (0, '2', '2Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tristique.', now());

INSERT INTO `comments` (`pid`, `aid`, `comment`, `date`)
VALUES (1, '1', '3Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tristique.', now());

INSERT INTO `comments` (`pid`, `aid`, `comment`, `date`)
VALUES (2, '2', '4Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tristique.', now());

INSERT INTO `comments` (`pid`, `aid`, `comment`, `date`)
VALUES (3, '1', '5Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tristique.', now());
