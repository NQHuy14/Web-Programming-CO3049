create database if not exists cvbuilderDB;
use cvbuilderDB;

create table if not exists user(
	id int auto_increment,
    username varchar(255),
    password varchar(255),
    
    primary key(id)
);

create table if not exists cv (
	id int auto_increment,
    
    fname varchar(50),
    lname varchar(50),
    title varchar(100),
    gender varchar(10),
    dob date,
    location varchar(100),
    objective text,
    hobby text,
    img varchar(255),
    
    userID int,
    
    primary key (id),
    constraint FK_UserCv foreign key (userID) references user(id) on delete cascade
);


create table if not exists phoneNumber(
	id int auto_increment,
    numbers varchar(20),
    
    cvID int,
    
    primary key (id),
    constraint FK_PhoneNumberCv foreign key (cvID) references cv(id) on delete cascade
);	


create table if not exists emailAddress (
	id int auto_increment,
    email varchar(100),
    
    cvID int,
    
    primary key (id),
    constraint FK_EmailAddressCv foreign key (cvID) references cv(id) on delete cascade
);


create table if not exists socialLink (
	id int auto_increment,
    link varchar(255),
    
    cvID int,
    
    primary key (id),
    constraint FK_SociallinkCv foreign key (cvID) references cv(id) on delete cascade
);


create table if not exists languages (
	id int auto_increment,
    lang varchar(50),
    
    cvID int,
    
    primary key (id),
    constraint FK_LanguagesCv foreign key (cvID) references cv(id) on delete cascade
);

create table if not exists degree (
	id int auto_increment,
    school varchar(100),
    major varchar(100),
    gpa decimal(4,2),
    startYear int,
    endYear int,
    
    cvID int,
    
    primary key (id),
    constraint FK_DegreeCv foreign key (cvID) references cv(id) on delete cascade
);


create table if not exists workExperience (
	id int auto_increment,
    company varchar(200),
    title varchar(200),
    detail text,
    startYear int,
    endYear int,
    
    cvID int,
    
    primary key (id),
    constraint FK_WorkExperienceCv foreign key (cvID) references cv(id) on delete cascade
);


create table if not exists activity (
	id int auto_increment,
    title varchar(200),
    detail text,
    startYear int,
    endYear int,
    
    cvID int,
    
    primary key(id),
    constraint FK_ActivityCv foreign key (cvID) references cv(id) on delete cascade
);


create table if not exists certification (
	id int auto_increment,
    year int,
    detail text,
    
    cvID int,
    
    primary key (id),
    constraint FK_CertificationCv foreign key (cvID) references cv(id) on delete cascade
);


create table if not exists award (
	id int auto_increment,
    year int,
    detail text,
    
    cvID int,
    
    primary key (id),
    constraint FK_AwardCv foreign key (cvID) references cv(id) on delete cascade
);