CREATE TABLE admin1(
idAdmin bigint(12) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
password varchar(20) NOT NULL, 
adminId int(3) NOT NULL,
adminFirstName varchar(50) NOT NULL, 
adminEmail varchar(20) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO admin1(password, adminId, adminFirstName, adminEmail)
VALUES('123', 123, 'Admin', 'admin@mtcleaning.com');


CREATE TABLE appointment(
appId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
userId bigint (12) NOT NULL,
scheduleId int (10) NOT NULL,
needService varchar (100) NOT NULL,
serviceComment varchar (100) NOT NULL,
status varchar (10) NOT NULL DEFAULT 'process') ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE employee(
idEmployee int NOT NULL AUTO_INCREMENT PRIMARY KEY,
password LONGTEXT NOT NULL,
employeeId int (3) NOT NULL,
email TINYTEXT NOT NULL, 
employeeFirstName varchar (20) NOT NULL,
employeeLastName varchar (20) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE adminschedule(
scheduleId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
employeeId int (3) NOT NULL,
scheduleDate date NOT NULL,
startTime time NOT NULL,
endTime time NOT NULL,
bookAvail varchar(10) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE client1 (
    idUser BIGINT(12) NOT NULL,
    password VARCHAR(20) NOT NULL,
    userFirstName VARCHAR(20) NOT NULL,
    userLastName VARCHAR(20) NOT NULL,
    userDOB DATE NOT NULL,
    userGender VARCHAR(10) NOT NULL,
    userAddress VARCHAR(100) NOT NULL,
    userPhone VARCHAR(15) NOT NULL,
    userEmail VARCHAR(100) NOT NULL
);

INSERT INTO client1 (idUser, password, userFirstName, userLastName, userDOB, userGender, userAddress, userPhone, userEmail) 
VALUES (0, '1234', 'Jack', 'Sparrow', '1980-01-24', 'male', '897 Pirates Ave', '651-900-6547', 'jsparrow@gmail.com');
