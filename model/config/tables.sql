-- --------------------------------------------------------

--
-- Table structure for table `users`
--
CREATE TABLE IF NOT EXISTS `users` (
    `id_user` int(11) NOT NULL AUTO_INCREMENT,
    `fname` varchar(100) DEFAULT NULL,
    `lname` varchar(100) DEFAULT NULL,
    `email` varchar(100) NOT NULL,
    `login` varchar(32) NOT NULL,
    `pass` varchar(255) NOT NULL,
    `active` tinyint(1) NOT NULL DEFAULT '0',
    `admin` tinyint(1) NOT NULL DEFAULT '0',
    `e_notif` tinyint(1) NOT NULL DEFAULT '1',
    `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_user`),
    UNIQUE INDEX `id_user_UNIQUE` (`id_user` ASC),
    UNIQUE INDEX `login_UNIQUE` (`login` ASC),
    UNIQUE INDEX `email_UNIQUE` (`email` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--
CREATE TABLE IF NOT EXISTS `posts` (
    `id_post` int(11) NOT NULL AUTO_INCREMENT,
    `user` varchar(32) NOT NULL,
    `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `photo` varchar(255) NOT NULL,
    `thumb` varchar(255) NOT NULL,
    PRIMARY KEY (`id_post`),
    FOREIGN KEY (`user`) REFERENCES `users`(`login`),
    UNIQUE INDEX `id_post_UNIQUE` (`id_post` ASC),
    UNIQUE INDEX `photo_UNIQUE` (`photo` ASC),
    UNIQUE INDEX `thumb_UNIQUE` (`thumb` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--
CREATE TABLE IF NOT EXISTS `comments` (
    `id_comment` int(11) NOT NULL AUTO_INCREMENT,
    `id_post` int(11) NOT NULL,
    `user` varchar(32) NOT NULL,
    `comment` text NOT NULL,
    `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_comment`),
    FOREIGN KEY (`id_post`) REFERENCES `posts`(`id_post`),
    FOREIGN KEY (`user`) REFERENCES `users`(`login`),
    UNIQUE INDEX `id_comment_UNIQUE` (`id_comment` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `likes`
--
CREATE TABLE IF NOT EXISTS `likes` (
    `id_like` int(11) NOT NULL AUTO_INCREMENT,
    `id_post` int(11) NOT NULL,
    `user` varchar(32) NOT NULL,
    `creation_date` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_like`),
    UNIQUE INDEX `id_like_UNIQUE` (`id_like` ASC),
    FOREIGN KEY (`id_post`) REFERENCES `posts`(`id_post`),
    FOREIGN KEY (`user`) REFERENCES `users`(`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `frames`
--
CREATE TABLE IF NOT EXISTS `frames` (
    `id_frame` int(11) NOT NULL AUTO_INCREMENT,
    `frame` varchar(50) NOT NULL,
    `fr_path` varchar(255) NOT NULL,
    PRIMARY KEY (`id_frame`),
    UNIQUE INDEX `id_frame_UNIQUE` (`id_frame` ASC),
    UNIQUE INDEX `frame_UNIQUE` (`frame` ASC),
    UNIQUE INDEX `fr_path_UNIQUE` (`fr_path` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `frames` 
    (`frame`, `fr_path`) 
VALUES 
    ('Black', 'public/images/frames/black.png'),
    ('Blue', 'public/images/frames/blue.png'),
    ('Red&Black', 'public/images/frames/rednblack.png'),
    ('Haluc', 'public/images/frames/haluc.png'),
    ('Forest', 'public/images/frames/forest.png'),
    ('Xmas1', 'public/images/frames/xmas1.png'),
    ('Xmas2', 'public/images/frames/xmas2.png');