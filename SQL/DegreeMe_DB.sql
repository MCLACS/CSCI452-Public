DROP DATABASE IF EXISTS degree_me;
CREATE DATABASE degree_me;

USE degree_me;

CREATE TABLE roles
(
	role_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	role_name varchar(25) NOT NULL
);

CREATE TABLE users
(
	user_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	a_number varchar(9) NOT NULL UNIQUE,
	f_name varchar(25) NOT NULL,
	l_name varchar(25) NOT NULL,
	email varchar(50) NOT NULL UNIQUE,
	password varchar(25) NOT NULL,
	role_id int NOT NULL,
	FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

CREATE TABLE concentrations
(
	conc_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	conc_name varchar(50) NOT NULL
);

CREATE TABLE user_conc
(
	user_id int NOT NULL,
	conc_id int NOT NULL,
	PRIMARY KEY(user_id, conc_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id),
	FOREIGN KEY(conc_id) REFERENCES concentrations(conc_id)
);

CREATE TABLE courses
(
	course_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	course_name varchar(75) NOT NULL,
	course_number varchar(8) NOT NULL,
	course_credits int NOT NULL
);

CREATE TABLE course_conc
(
	course_id int NOT NULL,
	conc_id int NOT NULL,
	PRIMARY KEY(course_id, conc_id),
	FOREIGN KEY(course_id) REFERENCES courses(course_id),
	FOREIGN KEY(conc_id) REFERENCES concentrations(conc_id)
);
​
CREATE TABLE prerequisites
(
	course_id int NOT NULL,
	prereq_id int NOT NULL,
	PRIMARY KEY(course_id, prereq_id),
	FOREIGN KEY(course_id) REFERENCES courses(course_id),
	FOREIGN KEY(prereq_id) REFERENCES courses(course_id)
);

CREATE TABLE user_courses
(
	user_id int NOT NULL,
	course_id int NOT NULL,
	PRIMARY KEY(user_id, course_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id),
	FOREIGN KEY(course_id) REFERENCES courses(course_id)
);

INSERT INTO roles VALUES(NULL, 'Admin');

INSERT INTO users(a_number, f_name, l_name, email, password, role_id)
VALUES('A30048792', 'Maximillian', 'May', 'mm8792@mcla.edu', 'password', 1);
INSERT INTO users(a_number, f_name, l_name, email, password, role_id)
VALUES('A20016137', 'Eric', 'Rogers', 'er6137@mcla.edu', 'password', 1);

INSERT INTO concentrations VALUES (NULL, 'Software Development');
INSERT INTO concentrations VALUES (NULL, 'Information Technology');

INSERT INTO user_conc VALUES (1,1);
INSERT INTO user_conc VALUES (2, 1);

INSERT INTO courses VALUES (NULL, 'Programming in Java I', 'CSCI-121', 3);
INSERT INTO courses VALUES (NULL, 'Network Theory & Administration I', 'CSCI-210', 3);
INSERT INTO courses VALUES (NULL, 'Introduction to Computer Science', 'CSCI-101', 3);
INSERT INTO courses VALUES (NULL, 'Programming in Java II', 'CSCI-122', 3);
INSERT INTO courses VALUES (NULL, 'Data Structures & Algorithms', 'CSCI-122', 3);
INSERT INTO courses VALUES (NULL, 'Computer Triage', 'CSCI-302', 3);

INSERT INTO course_conc VALUES (1, 1);
INSERT INTO course_conc VALUES (1, 2);
INSERT INTO course_conc VALUES (2, 1);
INSERT INTO course_conc VALUES (2, 2);
INSERT INTO course_conc VALUES (3, 1);
INSERT INTO course_conc VALUES (3, 2);
INSERT INTO course_conc VALUES (4, 1);
INSERT INTO course_conc VALUES (4, 2);
INSERT INTO course_conc VALUES (5, 1);
INSERT INTO course_conc VALUES (6, 2);

INSERT INTO prerequisites VALUES (4, 1);
INSERT INTO prerequisites VALUES (6, 3);
INSERT INTO prerequisites VALUES (5, 4);
