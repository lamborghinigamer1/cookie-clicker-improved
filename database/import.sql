CREATE DATABASE cookie_clicker_improved;

USE cookie_clicker_improved;

CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    score int NULL
);