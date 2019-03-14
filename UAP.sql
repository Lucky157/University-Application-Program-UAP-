CREATE TABLE if not exists `qualification` (
  `QID` int(11) primary key NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `minScore` varchar(10) NOT NULL,
  `maxScore` varchar(10) NOT NULL,
  `resultCalcDescription` varchar(100) NOT NULL,
  `noOfSubjects` int (1) not null,
  `gradeList` varchar(200) NOT NULL
);


CREATE TABLE if not exists `user` (
  `username` varchar(100) primary key NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usertype` char(2) NOT NULL
);

CREATE TABLE if not exists `applicant` (
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `IDType` varchar(50) NOT NULL,
  `IDNumber` varchar(50) Primary Key NOT NULL,
  `phoneno` varchar(20) NOT NULL,
  `dateOfBirth` date NOT NULL,
  FOREIGN KEY (username) references user(username)
); 

CREATE TABLE if not exists `result` (
  `QID` int(11) NOT NULL,
  `IDNumber` varchar(50) NOT NULL,
  `subjectName` varchar(100) NOT NULL,
  `grade` varchar(10),
  `score` varchar(10),
   PRIMARY KEY (QID, IDNumber, subjectName),
  FOREIGN KEY (QID) references qualification(QID),
  FOREIGN KEY (IDNumber) references Applicant(IDNumber)
);

CREATE TABLE if not exists`qualificationObtained` (
  `QID` int(11) NOT NULL,
  `IDNumber` varchar(50) NOT NULL,
  `overallScore` varchar(100) NOT NULL,
  PRIMARY KEY (QID, IDNumber, overallScore),
  FOREIGN KEY (QID) references qualification(QID),
  FOREIGN KEY (IDNumber) references Applicant(IDNumber)
);

CREATE TABLE if not exists`university` (
  `universityID` int(11) Primary key NOT NULL AUTO_INCREMENT,
  `universityName` varchar(100) NOT NULL
);

CREATE TABLE if not exists `uniAdmin` (
  `username` varchar(100) primary key NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `universityID` int(11) not null,
   FOREIGN KEY (universityID) references University (universityID)
); 

CREATE TABLE if not exists`programme` (
  `programmeID` int(11) Primary key NOT NULL AUTO_INCREMENT, 
  `programmeName` varchar(100) NOT NULL,
  `description` varchar(800) NOT NULL,
  `closingDate` date not null,
  `universityID` int(11),
  FOREIGN KEY (universityID) references university(universityID)
);
 
CREATE TABLE if not exists`application` (
  `AID` int(11) primary key NOT NULL AUTO_INCREMENT,
  `applicationName` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `programmeID` int(11) not null,
  `IDNumber` varchar(50) NOT NULL,
  FOREIGN KEY (programmeID) references programme(programmeID),
  FOREIGN KEY (IDNumber) references Applicant(IDNumber)
) ;

INSERT INTO `user` (`username`, `password`, `fullname`, `email`, `usertype`) VALUES
('Lucky157', 'password', 'Leila Tleubayeva', 'juviasan157@gmail.com', 'S'),
('Admin1','password', 'Aigerim Sarsenova', 'aikosh@help.com','SA'),
('UniAdmin','password','James Bond','bond@yahoo.com','UA');

INSERT INTO `applicant` (`username`, `password`, `fullname`, `email`, `IDType`,`IDNumber`,`phoneno`,`dateOfBirth` ) VALUES
('Lucky157', 'password', 'Leila Tleubayeva', 'juviasan157@gmail.com','myKad','b1500794','011-123456','1997-08-27');

INSERT INTO `qualification` (`QID`, `name`, `minScore`, `maxScore`, `resultCalcDescription`,`noOfSubjects`, `gradeList`) VALUES
(1,'STPM', '0.0', '4.0', 'Average of best 3 Subjects', 3, 'A (4.00), A- (3.67), B+ (3.33), B (3.00), B- (2.67), C+ (2.33),C (2.00), C- (1.67), D+ (1.33), D (1.00),F (0.00)'),
(2,'A-levels', '0.0', '5.0', 'Average of best 3 Subjects', 3, 'A -5 points, B -4 points, C -3 points, D -2 points, E -1 point'),
(3,'Australian Matriculation', '0', '100%', 'Average of best 4 Subjects', 4, '0-100%');
INSERT INTO `result` (`QID`, `IDNumber`, `subjectName`, `grade`, `score`) VALUES
(1, 'b1500794','ICT','B+','3.33'),
(1, 'b1500794','Physics','B+','3.33'),
(1, 'b1500794','Chemistry','B+','3.33');

INSERT INTO `university` (`universityID`, `universityName`) VALUES
(1,'HELP University');

INSERT INTO `uniAdmin` (`username`, `password`, `fullname`, `email`, `universityID`) VALUES
('UniAdmin','password','James Bond','bond@yahoo.com',1);

INSERT INTO `programme` (`programmeID`, `programmeName`, `description`, `closingDate`, `universityID`) VALUES
(1,'Bachelor of Information Technology', 'The Bachelor of Information Technology (Hons) offered by HELP University is a three year course and is designed to equip students with skills and attributes required to be effective and efficient information technology professionals.', '2019-06-10', '1'),
(2,'Bachelor of Business (Accounting)', 'This programme prepares students to become professional accountants. It covers theoretical and conceptual accounting matters combined with the basic accounting skills needed to make graduates employable.', '2019-06-10', '1');


INSERT INTO `application` (`AID`, `applicationName`, `status`, `programmeID`, `IDNumber`) VALUES
(1, 'lucky157','pending',1,'b1500794');

INSERT INTO `qualificationObtained` (`QID`, `IDNumber`, `overallScore`) VALUES
(1, 'b1500794','3.33');


