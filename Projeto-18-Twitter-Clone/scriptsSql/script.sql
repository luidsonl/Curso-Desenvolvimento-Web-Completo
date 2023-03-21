DROP DATABASE IF EXISTS twitter_clone;
CREATE DATABASE twitter_clone COLLATE utf8_unicode_ci;
USE twitter_clone;

CREATE TABLE users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR(32) NOT NULL
);