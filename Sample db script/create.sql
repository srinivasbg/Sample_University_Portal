create database univ2;
use univ2;

/* Department table contains the existing department in the university and the faculty strength of each department */
create table department
(Deptname varchar(20) not null,
facstrength int(2),
primary key(Deptname));

/*Student table has unique student id and other details of the student and
 also says which department the student belongs to.The password cannot be empty
 and checking of the length and being alphanumeric is done at the application level.
 The student table is connected to "assosicate with relationship" as a many:1 association and since its redundant  the
 relationship assisiocate with has been combined with the student table */

create table student
(studentid int(9),
name varchar(25)not null,
address varchar(50)not null,
billaddress varchar(50),
deptname varchar(20),
email varchar(20),
password varchar(20)not null,
primary key(studentid),
foreign key(deptname)references department(Deptname)
);

create table credit
(studentid int(9),
name varchar(25)not null,
address varchar(50)not null,
ccno varchar(20) unique,
primary key(studentid,ccno),
foreign key(studentid)references student(studentid)
);

/* Instructor table contains instructor information and the id for the instructor is unique
and this field cannot be empty also deptname is stored in this table which is referenced in the department table.
The instructor is connected to belongs to relation as a many:1 association and since its redundant  the relation
belong to has been combined with the instructor table*/

create table instructor
(IID int(9)not null,
name varchar(25)not null,
homepage varchar(30),
parttime bool,
fulltime bool,
email varchar(30),
officeno varchar(25),
password varchar(10),
primary key(IID));

Alter table instructor add column deptname varchar(20);
Alter table instructor add foreign key(deptname) references department(Deptname);

/* The course table is superset of all the courses offered in the university and its relavent information
are stored in this table. The course name is unique and every course should have defined a noofunit */

create table courses
(cno int(5) not null,
cname varchar(50),
noofunits int(5)not null,
Deptname varchar(20)not null,
catalog varchar(20),
primary key(cno,Deptname),
foreign key(Deptname)references department(Deptname),
unique(cname));


/*This table has all the payment for the courses that student completed or are currently enrroled*/
create table payment
(receiptno int(10),
amount int(10),
ccno int(20),
sid int(9) not null,
cno int (5) not null,
primary key(receiptno,sid,cno),
foreign key (sid) references student(studentid),
foreign key (cno) references courses(cno));

/*contains information on student belonging to particular specilization and
what core and elective courses are required for this specialization */
create table specialization
(sname varchar(20),
corecourses varchar(20),
electivecourses varchar(20),
deptname varchar(20),
stid int(9),
primary key(sname,stid,deptname),
foreign key (stid) references student(studentid),
foreign key (deptname) references department(Deptname));
Alter table specialization add column CoreCourse2 int(9);
Alter table specialization add column ElectiveCourse2 int(9);

/*Contains the information of the instructor who is taking the class and the students who are enrolled  for this class
Here the waitlist no will be checked with the waitlist cap at the application level.Similiarly the section capacity will be
checked at the application level*/

create table section
(secno int(5),
seccap int(3),
sem varchar(10),
waitcap int(3),
waitno int(3),
cno int(5),
deptname varchar(20),
IID int(9),
primary key(secno,cno,deptname,IID),
foreign key(cno,deptname)references courses(cno,Deptname),
foreign key(IID)references instructor(IID));
ALTER TABLE `section` ADD `day` VARCHAR(10) NOT NULL AFTER `IID`;
ALTER TABLE `section` ADD `time` TIME NOT NULL;
ALTER TABLE `section` ADD `room` INT( 3 ) NOT NULL AFTER `Time`;
ALTER TABLE `section` ADD UNIQUE (IID,day,time,room);




create table enrollment
(
secno int(5),
grade varchar(5),
studentid int(9),
rosterno int(5),
gradeunits int(5),
primary key(secno,studentid),
foreign key (studentid) references student(studentid),
foreign key (secno) references section(secno));
ALTER TABLE `enrollment` ADD `waitno` INT( 3 ) NOT NULL AFTER `gradeunits`;
ALTER TABLE `enrollment` CHANGE `grade` `grade` VARCHAR( 25 );


/*this table provides  department chair details.The chair is also an instructor and hence derives the instrutor details
from intructor table. The instructor id and the deptname referenced here cannot be modifies in thi relational table  */
create table ischair
(iid int(9),dname varchar(20),
primary key(iid,dname),
foreign key (iid) references instructor(IID) on update no action on delete no action,
foreign key (dname) references department(Deptname) on update no action on delete no action);


/*The teaches table is used store which instructor teaches which section.
Here iid dname,studentid ,cno and secno cannot be modified. */
create table teaches
(iid int(9),
secno int(5),
primary key(iid,secno),
foreign key (iid) references instructor(IID) on update no action on delete no action,
foreign key (secno) references section(secno) on update no action on delete no action);


/*This table maintains which student has taken what course studentid,dname,sname are not allowed to be modofied*/
create table chooses
(studentid int(9),sname varchar(20),
primary key(studentid,sname),
foreign key (studentid)references student(studentid)on update no action on delete no action,
foreign key (sname)references specialization(sname) on update no action on delete no action);


/* stores the prereq if any particular course it has.The prereq name can be got by the course table which is a
superset of all courses */
create table prereq(prereqid int(5),cno int(5),
primary key(prereqid,cno),
foreign key(cno) references courses(cno)on update no action on delete no action);


/* stores the coreq if any particular course it has.The coreq name can be got by the course table which is a
superset of all courses */
create table coreq(coreqid int(5),cno int(5),
primary key(coreqid,cno),
foreign key(cno) references courses(cno)on update no action on delete no action);