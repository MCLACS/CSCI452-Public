<<<<<<< HEAD
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
	password varchar(50) NOT NULL,
	role_id int,
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
	course_number varchar(10) NOT NULL,
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

CREATE TABLE prereq_text
(
	prereq_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	prereq_name varchar(75) NOT NULL
);

CREATE TABLE user_courses
(
	user_id int NOT NULL,
	course_id int NOT NULL,
	taken boolean NOT NULL DEFAULT FALSE,
	PRIMARY KEY(user_id, course_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id),
	FOREIGN KEY(course_id) REFERENCES courses(course_id)
);

CREATE TABLE prereq_bridge
(
	course_id int not null,
	prereq_id int not null,
	PRIMARY KEY(prereq_id, course_id),
	FOREIGN KEY(prereq_id) REFERENCES prereq_text(prereq_id),
	FOREIGN KEY(course_id) REFERENCES courses(course_id)
);

DESC users;

INSERT INTO roles VALUES(NULL, 'Admin');

INSERT INTO users(a_number, f_name, l_name, email, password, role_id)
VALUES('A30048792', 'Maximillian', 'May', 'mm8792@mcla.edu', 'password', 1);
INSERT INTO users(a_number, f_name, l_name, email, password, role_id)
VALUES('A20016137', 'Eric', 'Rogers', 'er6137@mcla.edu', 'password', 1);

INSERT INTO concentrations VALUES (NULL, 'Software Development');
INSERT INTO concentrations VALUES (NULL, 'Business Information Systems');
INSERT INTO concentrations VALUES (NULL, 'Bioinformatics');
INSERT INTO concentrations VALUES (NULL, 'Information Technology');

INSERT INTO user_conc VALUES (1,1);
INSERT INTO user_conc VALUES (2, 1);

INSERT INTO courses VALUES (NULL, 'Introduction to Computer Science', 'CSCI-101', 3);
INSERT INTO courses VALUES (NULL, 'Programming in Java I', 'CSCI-121', 3);
INSERT INTO courses VALUES (NULL, 'Network Theory & Administration I', 'CSCI-210', 3);
INSERT INTO courses VALUES (NULL, 'Programming in Java II', 'CSCI-122', 3);
INSERT INTO courses VALUES (NULL, 'Programming in Java III', 'CSCI-221', 3);
INSERT INTO courses VALUES (NULL, 'Data Structures & Algorithms', 'CSCI-361', 3);
INSERT INTO courses VALUES (NULL, 'Digital Circuit Design', 'CSCI-235', 4);
INSERT INTO courses VALUES (NULL, 'Programming in Java IV', 'CSCI-222', 3);
INSERT INTO courses VALUES (NULL, 'Operating Systems', 'CSCI-362', 3);
INSERT INTO courses VALUES (NULL, 'Programming in C++', 'CSCI-330', 3);
INSERT INTO courses VALUES (NULL, 'Computer Organization and Assembly Language', 'CSCI-318', 3);
INSERT INTO courses VALUES (NULL, 'Object Oriented Design', 'CSCI-328', 3);
INSERT INTO courses VALUES (NULL, 'Web Development', 'CSCI-236', 3);
INSERT INTO courses VALUES (NULL, 'Database Development', 'CSCI-243', 3);
INSERT INTO courses VALUES (NULL, 'Server-Side Software Development', 'CSCI-343', 3);
INSERT INTO courses VALUES (NULL, 'Junior Qualification Symposium', 'CSCI-390', 1);
INSERT INTO courses VALUES (NULL, 'Senior Project I', 'CSCI-461', 1);
INSERT INTO courses VALUES (NULL, 'Software Engineering', 'CSCI-452', 3);
INSERT INTO courses VALUES (NULL, 'Senior Project II', 'CSCI-462', 1);
INSERT INTO courses VALUES (NULL, 'Macroeconomics', 'ECON-141', 3);
INSERT INTO courses VALUES (NULL, 'Programming in C I', 'CSCI-246', 3);
INSERT INTO courses VALUES (NULL, 'Programming in C II', 'CSCI-248', 3);
INSERT INTO courses VALUES (NULL, 'Math Methods for Business and Economics', 'BADM-206', 3);
INSERT INTO courses VALUES (NULL, 'Visual Studio', 'CSCI-346', 3);
INSERT INTO courses VALUES (NULL, 'Financial Accounting', 'BADM-224', 3);
INSERT INTO courses VALUES (NULL, 'Financial Management', 'BADM-340', 3);
INSERT INTO courses VALUES (NULL, 'Business Information Systems', 'CSCI-352', 3);
INSERT INTO courses VALUES (NULL, 'Information Technology for Business', 'BADM-210', 3);
INSERT INTO courses VALUES (NULL, 'Advanced Info Tech for Business', 'BADM-310', 3);
INSERT INTO courses VALUES (NULL, 'Systems Development', 'CSCI-252', 3);
INSERT INTO courses VALUES (NULL, 'Introduction to Biology', 'BIOL-150', 4);
INSERT INTO courses VALUES (NULL, 'Parallel Computing', 'CSCI-350', 3);
INSERT INTO courses VALUES (NULL, 'Botany', 'BIOL-235', 4);
INSERT INTO courses VALUES (NULL, 'Zoology', 'BIOL-245', 4);
INSERT INTO courses VALUES (NULL, 'Genetics', 'BIOL-240', 4);
INSERT INTO courses VALUES (NULL, 'Biometry', 'BIOL-390', 3);
INSERT INTO courses VALUES (NULL, 'Biotechniques', 'BIOL-410', 4);
INSERT INTO courses VALUES (NULL, 'Bioinformatics', 'CSCI-420', 3);
INSERT INTO courses VALUES (NULL, 'Network Theory & Administration II', 'CSCI 211', 3);
INSERT INTO courses VALUES (NULL, 'Computer Triage', 'CSCI-302', 3);
INSERT INTO courses VALUES (NULL, 'Network Security I', 'CSCI 360', 3);
INSERT INTO courses VALUES (NULL, 'Network Security II', 'CSCI 363', 3);
INSERT INTO courses VALUES (NULL, 'Business Writing and Presentation', 'ENGL-306', 3);
INSERT INTO courses VALUES (NULL, 'Physics Elective', 'PHYS-131+', 3);
INSERT INTO courses VALUES (NULL, 'MATH Elective', 'MATH 200+', 3);
INSERT INTO courses VALUES (NULL, 'Computing and Communications', 'CCCL-100', 3);
INSERT INTO courses VALUES (NULL, 'Quantitative Reasoning', 'CMA', 3);

INSERT INTO course_conc VALUES (1,1);
INSERT INTO course_conc VALUES (2,1);
INSERT INTO course_conc VALUES (3,1);
INSERT INTO course_conc VALUES (4,1);
INSERT INTO course_conc VALUES (5,1);
INSERT INTO course_conc VALUES (6,1);
INSERT INTO course_conc VALUES (7,1);
INSERT INTO course_conc VALUES (8,1);
INSERT INTO course_conc VALUES (9,1);
INSERT INTO course_conc VALUES (10,1);
INSERT INTO course_conc VALUES (11,1);
INSERT INTO course_conc VALUES (12,1);
INSERT INTO course_conc VALUES (13,1);
INSERT INTO course_conc VALUES (14,1);
INSERT INTO course_conc VALUES (15,1);
INSERT INTO course_conc VALUES (16,1);
INSERT INTO course_conc VALUES (17,1);
INSERT INTO course_conc VALUES (18,1);
INSERT INTO course_conc VALUES (19,1);
INSERT INTO course_conc VALUES (43,1);
INSERT INTO course_conc VALUES (44,1);
INSERT INTO course_conc VALUES (45,1);
INSERT INTO course_conc VALUES (20,2);
INSERT INTO course_conc VALUES (21,2);
INSERT INTO course_conc VALUES (22,2);
INSERT INTO course_conc VALUES (23,2);
INSERT INTO course_conc VALUES (24,2);
INSERT INTO course_conc VALUES (25,2);
INSERT INTO course_conc VALUES (26,2);
INSERT INTO course_conc VALUES (27,2);
INSERT INTO course_conc VALUES (28,2);
INSERT INTO course_conc VALUES (29,2);
INSERT INTO course_conc VALUES (30,2);
INSERT INTO course_conc VALUES (1,2);
INSERT INTO course_conc VALUES (13,2);
INSERT INTO course_conc VALUES (14,2);
INSERT INTO course_conc VALUES (17,2);
INSERT INTO course_conc VALUES (19,2);
INSERT INTO course_conc VALUES (43,2);
INSERT INTO course_conc VALUES (46,2);
INSERT INTO course_conc VALUES (31,3);
INSERT INTO course_conc VALUES (32,3);
INSERT INTO course_conc VALUES (33,3);
INSERT INTO course_conc VALUES (34,3);
INSERT INTO course_conc VALUES (35,3);
INSERT INTO course_conc VALUES (36,3);
INSERT INTO course_conc VALUES (37,3);
INSERT INTO course_conc VALUES (38,3);
INSERT INTO course_conc VALUES (39,3);
INSERT INTO course_conc VALUES (1,3);
INSERT INTO course_conc VALUES (2,3);
INSERT INTO course_conc VALUES (4,3);
INSERT INTO course_conc VALUES (6,3);
INSERT INTO course_conc VALUES (9,3);
INSERT INTO course_conc VALUES (10,3);
INSERT INTO course_conc VALUES (14,3);
INSERT INTO course_conc VALUES (17,3);
INSERT INTO course_conc VALUES (19,3);
INSERT INTO course_conc VALUES (45,3);
INSERT INTO course_conc VALUES (40,4);
INSERT INTO course_conc VALUES (41,4);
INSERT INTO course_conc VALUES (42,4);
INSERT INTO course_conc VALUES (1,4);
INSERT INTO course_conc VALUES (2,4);
INSERT INTO course_conc VALUES (21,4);
INSERT INTO course_conc VALUES (4,4);
INSERT INTO course_conc VALUES (22,4);
INSERT INTO course_conc VALUES (3,4);
INSERT INTO course_conc VALUES (7,4);
INSERT INTO course_conc VALUES (10,4);
INSERT INTO course_conc VALUES (13,4);
INSERT INTO course_conc VALUES (14,4);
INSERT INTO course_conc VALUES (15,4);
INSERT INTO course_conc VALUES (17,4);
INSERT INTO course_conc VALUES (19,4);
INSERT INTO course_conc VALUES (43,4);
INSERT INTO course_conc VALUES (44,4);
INSERT INTO course_conc VALUES (45,4);

INSERT INTO prereq_text VALUES (NULL, 'Introduction to Computer Science');
INSERT INTO prereq_text VALUES (NULL, 'Programming in Java I');
INSERT INTO prereq_text VALUES (NULL, 'Network Theory & Administration I');
INSERT INTO prereq_text VALUES (NULL, 'Programming in Java II');
INSERT INTO prereq_text VALUES (NULL, 'Programming in Java III');
INSERT INTO prereq_text VALUES (NULL, 'Data Structures & Algorithms');
INSERT INTO prereq_text VALUES (NULL, 'Digital Circuit Design');
INSERT INTO prereq_text VALUES (NULL, 'Programming in Java IV');
INSERT INTO prereq_text VALUES (NULL, 'Object Oriented Design');
INSERT INTO prereq_text VALUES (NULL, 'Web Development');
INSERT INTO prereq_text VALUES (NULL, 'Database Development');
INSERT INTO prereq_text VALUES (NULL, 'Server-Side Software Development');
INSERT INTO prereq_text VALUES (NULL, 'Junior Qualification Symposium');
INSERT INTO prereq_text VALUES (NULL, 'Senior Project I');
INSERT INTO prereq_text VALUES (NULL, 'Macroeconomics');
INSERT INTO prereq_text VALUES (NULL, 'Programming in C I');
INSERT INTO prereq_text VALUES (NULL, 'Programming in C II');
INSERT INTO prereq_text VALUES (NULL, 'Financial Accounting');
INSERT INTO prereq_text VALUES (NULL, 'Information Technology for Business');
INSERT INTO prereq_text VALUES (NULL, 'Systems Development');
INSERT INTO prereq_text VALUES (NULL, 'Introduction to Biology');
INSERT INTO prereq_text VALUES (NULL, 'Zoology');
INSERT INTO prereq_text VALUES (NULL, 'Genetics');
INSERT INTO prereq_text VALUES (NULL, 'Network Theory & Administration II');
INSERT INTO prereq_text VALUES (NULL, 'Network Security I');
INSERT INTO prereq_text VALUES (NULL, 'MATH Elective');
INSERT INTO prereq_text VALUES (NULL, 'Computing and Communications');
INSERT INTO prereq_text VALUES (NULL, 'Quantitative Reasoning');

INSERT INTO prereq_bridge VALUES (4,2);
INSERT INTO prereq_bridge VALUES (5,4);
INSERT INTO prereq_bridge VALUES (6,4);
INSERT INTO prereq_bridge VALUES (8,5);
INSERT INTO prereq_bridge VALUES (9,6);
INSERT INTO prereq_bridge VALUES (10,4);
INSERT INTO prereq_bridge VALUES (11,7);
INSERT INTO prereq_bridge VALUES (12,4);
INSERT INTO prereq_bridge VALUES (15,10);
INSERT INTO prereq_bridge VALUES (15,11);
INSERT INTO prereq_bridge VALUES (15,4);
INSERT INTO prereq_bridge VALUES (16,8);
INSERT INTO prereq_bridge VALUES (16,7);
INSERT INTO prereq_bridge VALUES (16,10);
INSERT INTO prereq_bridge VALUES (16,11);
INSERT INTO prereq_bridge VALUES (17,9);
INSERT INTO prereq_bridge VALUES (18,9);
INSERT INTO prereq_bridge VALUES (18,10);
INSERT INTO prereq_bridge VALUES (19,11);
INSERT INTO prereq_bridge VALUES (22,13);
INSERT INTO prereq_bridge VALUES (23,19);
INSERT INTO prereq_bridge VALUES (24,4);
INSERT INTO prereq_bridge VALUES (24,14);
INSERT INTO prereq_bridge VALUES (25,27);
INSERT INTO prereq_bridge VALUES (26,18);
INSERT INTO prereq_bridge VALUES (26,12);
INSERT INTO prereq_bridge VALUES (27,12);
INSERT INTO prereq_bridge VALUES (28,27);
INSERT INTO prereq_bridge VALUES (29,19);
INSERT INTO prereq_bridge VALUES (32,4);
INSERT INTO prereq_bridge VALUES (33,13);
INSERT INTO prereq_bridge VALUES (34,13);
INSERT INTO prereq_bridge VALUES (35,13);
INSERT INTO prereq_bridge VALUES (36,26);
INSERT INTO prereq_bridge VALUES (37,23);
INSERT INTO prereq_bridge VALUES (37,14);
INSERT INTO prereq_bridge VALUES (38,23);
INSERT INTO prereq_bridge VALUES (38,11);
INSERT INTO prereq_bridge VALUES (39,3);
INSERT INTO prereq_bridge VALUES (40,1);
INSERT INTO prereq_bridge VALUES (41,24);
INSERT INTO prereq_bridge VALUES (42,18);


SELECT * FROM users;
SELECT * FROM concentrations;
SELECT courses.course_name, courses.course_number FROM courses INNER JOIN course_conc ON courses.course_id = course_conc.course_id ORDER BY course_conc.conc_id, courses.course_number ASC;