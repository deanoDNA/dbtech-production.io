CREATE DATABASE IF NOT EXISTS obva_system;

USE obva_system;


CREATE TABLE admin_table (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    password1 VARCHAR(255),
    password2 VARCHAR(255),
    security_answer VARCHAR(255),
    username VARCHAR(50) UNIQUE
);

CREATE TABLE mechanics_table (
    mechanic_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    phone_number VARCHAR(15),
    password1 VARCHAR(255),
    password2 VARCHAR(255),
    security_answer VARCHAR(255),
    username VARCHAR(50) UNIQUE,
    expertise VARCHAR(100),
    location VARCHAR(100)
);

CREATE TABLE services_table (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(100),
    description TEXT,
    price INT(100)
);

CREATE TABLE users_table (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    username VARCHAR(50) UNIQUE,
    phone_number VARCHAR(50),
    password1 VARCHAR(255),
    password2 VARCHAR(255),
    security_answer VARCHAR(255)
);

CREATE TABLE service_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    ID INT,
    service_id INT,
    custom_problem TEXT,
    request_date DATETIME,
    FOREIGN KEY (ID) REFERENCES users_table(ID),
    FOREIGN KEY (service_id) REFERENCES services_table(service_id)
);

INSERT INTO admin_table (admin_id, first_name, last_name, username, password1, password2, security_answer)
VALUES ('NULL', 'Desdelius', 'Nobert', 'realtime', '123456', '123456', 'realtime');
