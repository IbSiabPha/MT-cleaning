CREATE TABLE appointment
(
    appId INT(3) NOT NULL,
    userId BIGINT(12) NOT NULL,
    scheduleId INT(10) NOT NULL,
    needService VARCHAR(100) NOT NULL,
    serviceComment VARCHAR(100) NOT NULL,
    status VARCHAR(10) NOT NULL DEFAULT 'process'
);

--------------------------------------------------

INSERT INTO appointment
    (
    appId, userId, scheduleId, needService, serviceComment, status
    )
VALUES
    (
        88, 1234, 47, 'Garage Cleaning', 'I want my garage cleaned', 'done'
),
    (
        89, 8903, 48, 'Home Cleaning', 'Clean up the carpets really well', 'done'
);

-------------------------------------------------

CREATE TABLE admin1
(
    idAdmin BIGINT(12) NOT NULL,
    password VARCHAR(20) NOT NULL,
    adminId INT(3) NOT NULL,
    adminFirstName VARCHAR(50) NOT NULL,
    adminEmail VARCHAR(20) NOT NULL
);

INSERT INTO admin1
    (
    idAdmin, password, adminId, adminFirstName, adminEmail
    )
VALUES
    (
        0, '123', 123, 'Admin', 'admin@mtcleaning.com'
);

-------------------------------------------------

CREATE TABLE employee
(
    idEmployee int NOT NULL
    AUTO_INCREMENT PRIMARY KEY,
password LONGTEXT NOT NULL,
employeeId int
    (3) NOT NULL,
email TINYTEXT NOT NULL, 
employeeFirstName varchar
    (20) NOT NULL,
employeeLastName varchar
    (20) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-------------------------------------------------

    CREATE TABLE adminSchedule
    (
        scheduleId INT(11) NOT NULL,
        scheduleDate date NOT NULL,
        scheduleDay VARCHAR(15) NOT NULL,
        startTime time NOT NULL,
        endTime time NOT NULL,
        bookAvail VARCHAR(10) NOT NULL
    );

    INSERT INTO adminSchedule
        (
        scheduleId, scheduleDate, scheduleDay, startTime, endTime, bookAvail
        )
    VALUES
        (47, '2020-10-06', '', '00:05:00', '03:10:00', 'notavail'),
        (48, '2020-10-14', '', '12:00:00', '01:05:00', 'notavail'),
        (49, '2020-11-24', '', '00:00:00', '00:00:00', '');

-------------------------------------------------

CREATE TABLE client1 (
    idUser BIGINT(12) NOT NULL,
    password VARCHAR(20) NOT NULL,
    userFisrtName VARCHAR(20) NOT NULL,
    userLastName VARCHAR(20) NOT NULL,
    userDOB DATE NOT NULL,
    userGender VARCHAR(10) NOT NULL,
    userAddress VARCHAR(100) NOT NULL,
    userPhone VARCHAR(15) NOT NULL,
    userEmail VARCHAR(100) NOT NULL
);

INSERT INTO client1 (
    idUser, password, userFirstName, userLastName, userDOB, userGender, userAddress, userPhone, userEmail
) VALUES (
    0, '1234', 'Jack', 'Sparrow', '1980-01-24', 'male', '897 Pirates Ave', '651-900-6547', 'jsparrow@gmail.com'
);

-------------------------------------------------------------------

ALTER TABLE `appointment`
ADD PRIMARY KEY
(`appId`),
ADD UNIQUE KEY `scheduleId_2`
(`scheduleId`),
ADD KEY `userId`
(`userId`),
ADD KEY `scheduleId`
(`scheduleId`);

--------------------------------------------------------------------------

ALTER TABLE `admin1`
ADD PRIMARY KEY
(`idAdmin`);

-------------------------------------------------------------------------

ALTER TABLE `adminschedule`
ADD PRIMARY KEY
(`scheduleId`);

--------------------------------------------------------------------

ALTER TABLE `client1`
ADD PRIMARY KEY
(`idUser`);

--------------------------------------------------------------

ALTER TABLE `appointment`
  MODIFY `appId` int
(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

-------------------------------------------------------------

ALTER TABLE `adminschedule`
  MODIFY `scheduleId` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

---------------------------------------------------------------

