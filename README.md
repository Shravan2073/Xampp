

Just a simple php web application i made under a club at my college. it's kinda works, but
 I need to smoothen some edges out. 




for database, add where "admin" is the admin user id and password is "admin" too put this in the sql tab and hit go !!!

enter this and you will create a new DB and can start using the app. 


~~~mysql
CREATE DATABASE IF NOT EXISTS file_management;
USE file_management;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT 0
);

-- Create updates table
CREATE TABLE IF NOT EXISTS updates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create files table
CREATE TABLE IF NOT EXISTS files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert admin user
INSERT INTO users (username, password, is_admin) VALUES ('admin', '$2y$10$Ut6yN6vHM3cnHrFle62tv.pXjmIsDnFhPzj2gJH8ZDEiKais4VsB.', 1);
~~~
