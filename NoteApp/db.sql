    CREATE DATABASE noteapp;

    USE noteapp;

    SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
    SET AUTOCOMMIT = 0;
    SET time_zone = "+00:00";

    CREATE TABLE notes (
    note_id int(11) NOT NULL,
    user_ID int(11) NOT NULL,
    title varchar(100) NOT NULL,
    note varchar(1000) NOT NULL,
    time_in varchar(50) NOT NULL,
    last_updated_at datetime NOT NULL
    );

    CREATE TABLE register (
    user_ID int(11) NOT NULL,
    fullName varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    password varchar(100) NOT NULL
    );

    INSERT INTO `notes` (`note_id`, `user_ID`, `title`, `note`, `time_in`, `last_updated_at`) VALUES
    (6, 1, 'Momentum', 'Momentum is a commonly used term in sports. A team that has the momentum is on the move and is going to take some effort to stop. A team that has a lot of momentum is really on the move and is going to be hard to stop. Momentum is a physics term; it refers to the quantity of motion that an object has. A sports team that is on the move has the momentum. If an object is in motion (on the move) then it has momentum.\r\n\r\nMomentum can be defined as \"mass in motion.\" All objects have mass; so if an object is moving, then it has momentum - it has its mass in motion. The amount of momentum that an object has is dependent upon two variables: how much stuff is moving and how fast the stuff is moving. Momentum depends upon the variables mass and velocity. In terms of an equation, the momentum of an object is equal to the mass of the object times the velocity of the object.', '10:15:08pm', '2021-09-02 01:02:43'),
    (7, 1, 'Cohesive Force', 'Excel is a spreadsheet program that allows you to store, organize, and analyze information. While you may think Excel is only used by certain people to process complicated data, anyone can learn how to take advantage of the program\'s powerful features. Whether you\'re keeping a budget, organizing a training log, or creating an invoice, Excel makes it easy to work with different types of data.', '12:11:04am', '2021-09-02 00:54:34'),
    (8, 1, 'Photosynthesis', 'Photosynthesis is a process used by plants and other organisms to convert light energy into chemical energy that, through cellular respiration, can later be released to fuel the organisms activities.', '12:26:33am', '0000-00-00 00:00:00'),
    (9, 1, 'What are the planets name in the solar system', 'The eight planets are Mercury, Venus, Earth, Mars, Jupiter, Saturn, Uranus, and Neptune. Mercury is closest to the Sun. Neptune is the farthest. Planets, asteroids, and comets orbit our Sun.','10:15:08pm', '2021-09-02 01:02:43');

    INSERT INTO `register` (`user_ID`, `fullName`, `email`, `password`) VALUES
    (1, 'Dang Cong Khanh', 'khanh@gmail.com', '202cb962ac59075b964b07152d234b70'),
    (2, 'Nguyen Quoc Dung', 'dung@gmail.com', '202cb962ac59075b964b07152d234b70');

    ALTER TABLE `notes`
        ADD PRIMARY KEY (`note_id`);

    ALTER TABLE `register`
    ADD PRIMARY KEY (`user_ID`);

    ALTER TABLE `notes`
    MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

    ALTER TABLE `register`
    MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
