CREATE DATABASE IF NOT EXISTS vsgame;
USE vsgame;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    registration_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    wins INT DEFAULT 0,
    losses INT DEFAULT 0
);

CREATE TABLE cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    attack INT NOT NULL,
    defense INT NOT NULL,
    image VARCHAR(255)
);

CREATE TABLE config (
    id INT AUTO_INCREMENT PRIMARY KEY,
    difficulty INT NOT NULL  
);

CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    difficulty_id INT NOT NULL,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_rounds INT NOT NULL,
    rounds_won INT NOT NULL,
    result BOOLEAN NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (difficulty_id) REFERENCES config(id)
);