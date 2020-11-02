create table elevated(
user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
user_name TINYTEXT NOT NULL, 
pwd LONGTEXT NOT NULL
);

create table ratings(
post_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 	
name TINYTEXT NOT NULL,
subject TINYTEXT NOT NULL,
comments TEXT NOT NULL,
rateNumber INT NOT NULL,
date DATE
);

create table user_login(
users_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
name TINYTEXT NOT NULL,
subject TINYTEXT NOT NULL,
comments TEXT NOT NULL,
rateNumber INT NOT NULL,
date date
);


CREATE table profile(
pro_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
users_id INT NOT NULL, FOREIGN KEY (users_id) REFERENCES user_login(users_id),
age INT NOT NULL, 
job TINYTEXT NOT NULL, 
about TEXT NOT NULL, 
image LONGTEXT NOT NULL
);
<--------------------------------499 below------------------------------------------------>
for another project test......

CREATE TABLE admin1(
idAdmin bigint(12) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
password varchar(20) NOT NULL, 
adminId int(3) NOT NULL,
adminFirstName varchar(50) NOT NULL, 
adminEmail varchar(20) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO admin1(password, adminId, adminFirstName, adminEmail)
VALUES('123', 123, 'Admin', 'admin@mtcleaning.com');

CREATE TABLE adminschedule(
scheduleId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
scheduleDate date NOT NULL,
scheduleDay varchar(15) NOT NULL,
startTime time NOT NULL,
endTime time NOT NULL,
bookAvail varchar(10) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE appointment(
appId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
userId bigint (12) NOT NULL,
scheduleId int (10) NOT NULL,
needService varchar (100) NOT NULL,
serviceComment varchar (100) NOT NULL,
status varchar (10) NOT NULL DEFAULT 'process') ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE employee(
idEmployee int NOT NULL AUTO_INCREMENT PRIMARY KEY,
password varchar (20) NOT NULL,
employeeId int (3) NOT NULL, 
employeeFirstName varchar (20) NOT NULL,
employeeLastName varchar (20) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO employee(password, employeeId, employeeFirstName, employeeLastName) 
VALUES ('456', '456', 'Employee', 'Employee');

