CREATE DATABASE degree_me;

USE degree_me;

CREATE TABLE users
(
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	a_number varchar(9) NOT NULL UNIQUE,
	f_name varchar(25) NOT NULL,
	l_name varchar(25) NOT NULL,
	email varchar(50) NOT NULL UNIQUE,
	password varchar(25)
);

DESC users;

INSERT INTO users(a_number, f_name, l_name, email, password)
VALUES('A30048792', 'Maximillian', 'May', 'mm8792@mcla.edu', 'password');

SELECT *  FROM FROM users;
