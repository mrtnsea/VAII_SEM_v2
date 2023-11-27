SET foreign_key_checks = 0;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `characters`;
CREATE TABLE `characters`
(
    `id`    int(11) NOT NULL AUTO_INCREMENT,
    `name`  varchar(30) NOT NULL,
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `guides`;
CREATE TABLE `guides`
(
    `id`    int(11) NOT NULL AUTO_INCREMENT,
    `character_id`  int(11) NOT NULL,
    `is_infographic`   varchar(3) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`character_id`) REFERENCES `characters` (`id`)
);

DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections`
(
    `id`    int(11) NOT NULL AUTO_INCREMENT,
    `guide_id`  int(11) NOT NULL,
    `parent_section` int(11) NULL,
    `order` int(11) NOT NULL,
    `header`    varchar(100) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`guide_id`) REFERENCES `guides` (`id`)
);

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images`
(
    `id`    int(11) NOT NULL AUTO_INCREMENT,
    `section_id`  int(11) NOT NULL,
    `image` varchar(300) NOT NULL,
    `card_header`   varchar(30) NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
);

INSERT INTO `characters` (`name`)
VALUES ('Asta'),
       ('Blade'),
       ('Gepard'),
       ('Jingliu'),
       ('Luocha'),
       ('Welt');

INSERT INTO `guides` (`character_id`, `is_infographic`)
VALUES (1, 'no'),
       (2, 'no'),
       (3, 'no'),
       (3, 'yes'),
       (4, 'no'),
       (5, 'no'),
       (6, 'no');

INSERT INTO `sections` (guide_id, `order`, `header`, `parent_section`)
VALUES (2, 1, 'Blade Guide', null),
       (2, 2, 'Mechanics', null),
       (2, 3, 'Relics', null),
       (2, 4, 'Stats', null),
       (2, 5, 'Main stats', 4),
       (2, 6, 'Substats priority:\nCrit Rate / Damage > HP% > Speed', 4);

INSERT INTO `images` (section_id, image, card_header)
VALUES (1, '../../public/images/characters/splash-arts/Blade.webp', null),
       (3, '../../public/images/relics/icons/LongevousDisciple.png', null),
       (3, '../../public/images/relics/icons/EagleOfTwilightLine.png', null),
       (3, '../../public/images/relics/icons/RutilantArena.png', null),
       (3, '../../public/images/relics/icons/InertSalsotto.png', null),
       (5, '../../public/images/relics/stats/Body.png', 'Crit'),
       (5, '../../public/images/relics/stats/Boots.png', 'Speed / Hp%'),
       (5, '../../public/images/relics/stats/Necklace.png', 'Dmg%'),
       (5, '../../public/images/relics/stats/Sphere.png', 'Hp%');