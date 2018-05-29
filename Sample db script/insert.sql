use univ2;

INSERT INTO `univ2`.`department` (`Deptname`, `facstrength`) VALUES ('cs', '5'), ('cmpe', '5');
INSERT INTO `univ2`.`department` (`Deptname`, `facstrength`) VALUES ('EE', '5');


INSERT INTO `univ2`.`student` (`studentid`, `name`, `address`, `billaddress`, `deptname`, `email`, `password`)
VALUES ('006376730', 'Jason', '65,pierce avenue, Market Street, San Jose CA 95112', '65,pierce avenue, Market Street, San Jose CA 95112', 'cs', 'jason@gmail.com', 'abc12345'),
('006376731', 'Alex', '65,pierce avenue, Market Street, San Jose CA 95112', '65,pierce avenue, Market Street, San Jose CA 95112', 'cs', 'alex@yahoo.com', 'abc12345');


INSERT INTO `univ2`.`student` (`studentid`, `name`, `address`, `billaddress`, `deptname`, `email`, `password`)
VALUES ('006376732', 'John', '65,pierce avenue, Market Street, San Jose CA 95112', '65,pierce avenue, Market Street, San Jose CA 95112', 'cmpe', 'john@google.com', 'abc12345'),
('006376733', 'Mark', '65,pierce avenue, Market Street, San Jose CA 95112', '65,pierce avenue, Market Street, San Jose CA 95112', 'cmpe', 'mark@intel.com', 'abc12345');


INSERT INTO `univ2`.`student` (`studentid`, `name`, `address`, `billaddress`, `deptname`, `email`, `password`)
VALUES ('006376734', 'Amy', '65,pierce avenue, Market Street, San Jose CA 95112', '65,pierce avenue, Market Street, San Jose CA 95112', 'EE', 'amy@hollywood.com', 'abc12345'),
('006376735', 'shauna', '65,pierce avenue, Market Street, San Jose CA 95112', '65,pierce avenue, Market Street, San Jose CA 95112', 'EE', 'shauna@hotmail.com', 'abc12345'),('006376737', 'Brad', '65,pierce avenue, Market Street, San Jose CA 95112', '65,pierce avenue, Market Street, San Jose CA 95112', 'cs', 'brad@google.com', 'abc12345');

insert into student(studentid,name,address,billaddress,deptname,email,password)values(6376736,'Anjelina','65,pierce avenue, Market Street, San Jose CA 95112','65,pierce avenue, Market Street, San Jose CA 95112','cs','anjelina@hotmail.com','abc12345');





INSERT INTO `univ2`.`instructor` (`IID`, `name`, `homepage`, `parttime`, `fulltime`, `email`, `officeno`, `password`, `deptname`) VALUES ('11', 'Magdalini Erinaki', 'http://www.facebook.com', '0', '1', 'magda@yahoo.com', '101', 'abc12345', 'cs'), ('22', 'Dan Harkey', 'http://www.yahoo.com', '0', '1', 'dan@yahoo.com', '102', 'abc12345', 'cs'), ('33', 'Donald Hung', 'http://www.yahoo.com', '0', '1', 'donald@yahoo.com', '103', 'abc12345', 'cs'), ('44', 'Xiao su', 'http://www.yahoo.com', '0', '1', 'xiao@yahoo.com', '104', 'abc12345', 'cs'), ('55', 'richard sinn', 'http://www.yahoo.com', '0', '1', 'richard@yahoo.com', '105', 'abc12345', 'cs'),('66', 'Rod fatoohi', 'http://www.yahoo.com', '0', '1', 'xiao@yahoo.com', '106', 'abc12345', 'cmpe');



INSERT INTO `univ2`.`courses` (`cno`, `cname`, `noofunits`, `Deptname`, `catalog`)
VALUES ('226', 'Database Systems', '4', 'cs', 'MySQL queries'), ('227', 'Web Mining', '4', 'cs', 'Data Warehousing');


INSERT INTO `univ2`.`courses` (`cno`, `cname`, `noofunits`, `Deptname`, `catalog`)
VALUES ('228', 'Business Intelligence', '4', 'cs', 'Business Intelligenc'), ('229', 'Advanced Database', '4', 'cs', 'Database Progams');


INSERT INTO `univ2`.`courses` (`cno`, `cname`, `noofunits`, `Deptname`, `catalog`)
VALUES ('206', 'Computer Networks', '4', 'cs', 'OSI model'), ('207', 'Network Programming', '4', 'cs', 'Distributed System');

INSERT INTO `univ2`.`courses` (`cno`, `cname`, `noofunits`, `Deptname`, `catalog`)
VALUES ('208', 'Network Architecture', '4', 'cs', 'Protocols study'), ('209', 'Network Security', '4', 'cs', 'Security Concepts');

INSERT INTO `univ2`.`section` (`secno`, `seccap`, `sem`, `waitcap`, `waitno`, `cno`, `deptname`, `IID`,`day`,`time`,`room`)
VALUES ('99', '3', 'f09', '3', '0', '226', 'cs', '11','monday','18:00:00','333'), ('100', '3', 's09', '3', '0', '226', 'cs', '11','tuesday','18:00:00','335'), ('101', '3', 's10', '3', '0', '227', 'cs', '22','monday','18:00:00','337'), ('102', '2', 'f09', '0', '0', '227', 'cs', '44','friday','18:00:00','339'), ('103', '3', 's10', '3', '0', '228', 'cs', '33','monday','18:00:00','400');

INSERT INTO `univ2`.`section` (`secno`, `seccap`, `sem`, `waitcap`, `waitno`, `cno`, `deptname`, `IID`,`day`,`time`,`room`)
VALUES ('104', '3', 's10', '3', '0', '229', 'cs', '44','monday','18:00:00','343'), ('105', '3', 's10', '3', '0', '229', 'cs', '44','tuesday','18:00:00','353');


INSERT INTO `univ2`.`section` (`secno`, `seccap`, `sem`, `waitcap`, `waitno`, `cno`, `deptname`, `IID`,`day`,`time`,`room`)
VALUES ('106', '3', 's10', '3', '0', '206', 'cs', '11','wednesday','18:00:00','333'), ('107', '3', 's10', '3', '0', '206', 'cs', '11','thursday','18:00:00','333'), ('108', '3', 's10', '3', '0', '206', 'cs', '11','friday','18:00:00','333'), ('109', '3', 'f09', '3', '0', '207', 'cs', '22','wednesday','18:00:00','363'), ('110', '3', 'f09', '3', '0', '207', 'cs', '22','thursday','18:00:00','373');

INSERT INTO `univ2`.`section` (`secno`, `seccap`, `sem`, `waitcap`, `waitno`, `cno`, `deptname`, `IID`,`day`,`time`,`room`)
VALUES ('111', '3', 's09', '3', '0', '208', 'cs', '33','wednesday','18:00:00','433'), ('112', '3', 's09', '3', '0', '208', 'cs', '33','tuesday','18:00:00','473');

INSERT INTO `univ2`.`section` (`secno`, `seccap`, `sem`, `waitcap`, `waitno`, `cno`, `deptname`, `IID`,`day`,`time`,`room`)
VALUES ('113', '3', 's09', '3', '0', '209', 'cs', '44','wednesday','18:00:00','393'), ('114', '3', 's09', '3', '0', '209', 'cs', '44','thursday','18:00:00','499');




insert into teaches(iid,secno)values('11','99'),('11','100'),('22','101'),('44','102'),('33','103'),('44','104'),('44','105'),('11','106'),('11','107'),('11','108'),('22','109'),('22','110'),('33','111'),('33','112'),('44','113'),('44','114');
insert into ischair(iid,dname)values('22','cs'),('66','cmpe');


INSERT INTO `univ2`.`courses` (`cno`, `cname`, `noofunits`, `Deptname`, `catalog`)
VALUES ('272', 'Enterprise Overview', '4', 'cmpe', 'Ent concepts'), ('273', 'Enterprise systems', '4', 'cmpe', 'Java pgms');

INSERT INTO `univ2`.`courses` (`cno`, `cname`, `noofunits`, `Deptname`, `catalog`)
VALUES ('274', 'Service Oriented Arch', '4', 'cmpe', 'SOA concepts'), ('275', 'XML', '4', 'cmpe', 'xml');


INSERT INTO `univ2`.`courses` (`cno`, `cname`, `noofunits`, `Deptname`, `catalog`)
VALUES ('202', 'System Software', '4', 'cmpe', 'Modelling'), ('203', 'Engr Management', '4', 'cmpe', 'Management Concepts');

INSERT INTO `univ2`.`courses` (`cno`, `cname`, `noofunits`, `Deptname`, `catalog`)
VALUES ('204', 'Operating Systems', '4', 'cmpe', 'Os concepts'), ('205', 'Distributed Systems', '4', 'cmpe', 'Distributed Systems');



INSERT INTO `univ2`.`courses` (`cno`, `cname`, `noofunits`, `Deptname`, `catalog`)
VALUES ('220', 'Logic Design', '4', 'EE', 'gates design'), ('221', 'Electical Circuits', '4', 'EE', 'EC analysis');

INSERT INTO `univ2`.`courses` (`cno`, `cname`, `noofunits`, `Deptname`, `catalog`)
VALUES ('222', 'Digital Circuits', '4', 'EE', 'AC/DC'), ('223', 'Analog Circuits', '4', 'EE', 'Analog Circuits');


INSERT INTO `univ2`.`courses` (`cno`, `cname`, `noofunits`, `Deptname`, `catalog`)
VALUES ('225', 'Cryptography', '4', 'EE', 'Cryptography concept'), ('230', 'Voip', '4', 'EE', 'Voip Concepts');

INSERT INTO `univ2`.`courses` (`cno`, `cname`, `noofunits`, `Deptname`, `catalog`)
VALUES ('231', 'Electrical Security', '4', 'EE', 'Electrical Security'), ('232', 'Internetworking', '4', 'EE', 'Fiber Optics');



INSERT INTO `univ2`.`specialization` (`sname`, `corecourses`, `electivecourses`, `deptname`, `stid`, `CoreCourse2`, `ElectiveCourse2`)
VALUES ('Database', '226', '228', 'cs', '006376730', '227', '229'), ('Networking', '206', '208', 'cs', '006376731', '207', '209');


INSERT INTO `univ2`.`specialization` (`sname`, `corecourses`, `electivecourses`, `deptname`, `stid`, `CoreCourse2`, `ElectiveCourse2`)
VALUES ('Enterprise', '272', '274', 'cmpe', '006376732', '273', '275'), ('System Software', '202', '204', 'cmpe', '006376733', '203', '205');

INSERT INTO `univ2`.`specialization` (`sname`, `corecourses`, `electivecourses`, `deptname`, `stid`, `CoreCourse2`, `ElectiveCourse2`)
VALUES ('VLSI', '220', '222', 'EE', '006376734', '221', '223'), ('Enetworking', '225', '231', 'EE', '006376735', '230', '232');

insert into specialization(sname,corecourses,electivecourses,deptname,stid,CoreCourse2,ElectiveCourse2)values('Networking',206,208,'cs',6376736,207,209);
insert into specialization(sname,corecourses,electivecourses,deptname,stid,CoreCourse2,ElectiveCourse2)values('Networking',206,208,'cs',6376737,207,209);





INSERT INTO `univ2`.`enrollment` (`secno`, `grade`, `studentid`, `rosterno`, `gradeunits`, `waitno`)
VALUES ('100', 'A', '006376730', '2', '4', '0'), ('102', 'In Progress', '006376734', '1', '0', '0'),('102', 'In Progress', '006376735', '2', '0', '0'),('102', 'In Progress', '006376733', '3', '0', '0');

INSERT INTO `univ2`.`enrollment` (`secno`, `grade`, `studentid`, `rosterno`, `gradeunits`, `waitno`)
VALUES ('105', 'In Progress', '006376737', '0', '0', '1');

insert into enrollment(secno,grade,studentid,rosterno,gradeunits,waitno)values(113,'B',6376737,1,3,0);
insert into enrollment(secno,grade,studentid,rosterno,gradeunits,waitno)values(114,'B',6376731,1,3,0);
insert into enrollment(secno,grade,studentid,rosterno,gradeunits,waitno)values(104,'In Progress',6376731,1,0,0);

insert into payment values (1000,1000,123456789,6376730,226);
insert into payment values (1001,1000,123456789,6376730,228);
insert into payment values (1000,1005,123456789,6376730,227);


insert into credit values(6376730,'Jason','65 market street san jose',123456789);
insert into credit values(6376730,'JASON','65 market street san jose',123456798);

INSERT INTO `univ2`.`chooses` (`studentid`, `sname`) VALUES ('006376730', 'Database'), ('006376731', 'Networking'), ('006376732', 'Enterprise'), ('006376733', 'System Software'), ('006376734', 'VLSI');
INSERT INTO `univ2`.`chooses` (`studentid`, `sname`) VALUES ('006376735', 'Enetworking'), ('006376736', 'Networking');
INSERT INTO `univ2`.`chooses` (`studentid`, `sname`) VALUES ('006376737', 'Networking');







INSERT INTO `univ2`.`prereq` (`prereqid`, `cno`) VALUES ('226', '227'), ('228', '229');