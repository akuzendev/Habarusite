[//tbl_users]

designation:
	1 = user
	2 = writer
	3 = moderator
	4 = admin

status
	1 = active
	2 = pendingreview
	3 = blocked
	4 = scheduledfordeletion



CREATE TABLE habarudb.tbl_users (
	id INT(255) auto_increment NOT NULL,
	fname varchar(255) NOT NULL,
	lname varchar(255) NOT NULL,
	username varchar(255) NOT NULL,
	gender INT(1) NOT NULL,
	designation INT(1) NOT NULL,
	status INT(1) NOT NULL,
	countrycode INT(3) NOT NULL,
	phoneno INT(255) NOT NULL,
	email LONGTEXT NOT NULL,
	pssword LONGTEXT NOT NULL,
	CONSTRAINT tbl_users_PK PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=latin1
COLLATE=latin1_swedish_ci
COMMENT='This table stores information about the users of the application';



INSERT INTO `tbl_users`(`fname`, `lname`, `username`, `gender`, `designation`, `status`, `countrycode`, `phoneno`, `email`, `pssword`) VALUES ('john','doe','johntheuser',1,1,1,960,9741941,'johndoe@gmail.com','$2y$10$c.z/Ntv.i6uF8JTnklgoquaXkgE1445AN3jVa1jarFAKHPqWZDkF6')


INSERT INTO `tbl_users`(`fname`, `lname`, `username`, `gender`, `designation`, `status`, `countrycode`, `phoneno`, `email`, `pssword`) VALUES ('jean','davis','jeanthewriter',2,2,1,960,9741941,'jeandavis@gmail.com','$2y$10$nPB7grmc7wV8OBRefwC0TOM/ukFVwxTv4KlXZRpvrgtW2gHDkXFse')


INSERT INTO `tbl_users`(`fname`, `lname`, `username`, `gender`, `designation`, `status`, `countrycode`, `phoneno`, `email`, `pssword`) VALUES ('shaara','doe','shaarathemod',2,3,1,960,9741941,'sharaaz@gmail.com','$2y$10$Ne.O60s6vzYf/MQg.OhPr.HEtvAhsaAFO9nBgVjMuqWqesXwFWFSi')


INSERT INTO `tbl_users`(`fname`, `lname`, `username`, `gender`, `designation`, `status`, `countrycode`, `phoneno`, `email`, `pssword`) VALUES ('alim','doe','alimtheadmin',3,4,1,960,9741941,'alim2424@gmail.com','$2y$10$nmTJV0xVXf2wIj.LiEFPYONlLZ6vEHuZoUdWb4kzbkekHRjsmCrUC')

[//tbl_articles]
CREATE TABLE habarudb.tbl_articles (
	id INT(255) auto_increment NOT NULL,
	istimeline BOOL NOT NULL,
	timelineid INT(255) NULL,
	title varchar(255) NOT NULL,
	subtitle varchar(255) NOT NULL,
	thumbnail LONGTEXT NOT NULL,
	timestamp DATETIME NOT NULL,
	content LONGTEXT NOT NULL,
	relcommentid INT(255) NOT NULL,
	CONSTRAINT tbl_articles_PK PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=latin1
COLLATE=latin1_swedish_ci
COMMENT='This table stores information about Articles of the Habarusite application.';




[//tbl_comments]
CREATE TABLE habarudb.tbl_comments (
	id INT(255) auto_increment NOT NULL,
	content LONGTEXT NOT NULL,
	`timestamp` DATETIME NOT NULL,
	byuserid INT(255) NOT NULL,
	onarticleid INT(255) NOT NULL,
	status INT(1) NOT NULL,
	CONSTRAINT tbl_comments_PK PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=latin1
COLLATE=latin1_swedish_ci
COMMENT='This table stores information about Comments on Articles of the Habarusite.';




[//tbl_reports]
CREATE TABLE habarudb.tbl_reports (
	id INT(255) auto_increment NOT NULL,
	`type` VARCHAR(255) NOT NULL,
	byuserid INT(255) NOT NULL,
	contentid INT(255) NOT NULL,
	reason LONGTEXT NOT NULL,
	status INT(1) NOT NULL,
	`timestamp` DATETIME NOT NULL,
	handleddate DATETIME NOT NULL,
	handledbyuserid INT(255) NOT NULL,
	CONSTRAINT tbl_reports_PK PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=latin1
COLLATE=latin1_swedish_ci
COMMENT='This table stores information about the reports on the content of the Habarusite application';



[//tbl_timelines]
CREATE TABLE habarudb.tbl_timelines (
	id INT(255) auto_increment NOT NULL,
	title VARCHAR(255) NULL,
	subtitle VARCHAR(255) NULL,
	thumbnailurl LONGTEXT NULL,
	createddate DATETIME NULL,
	yuserid VARCHAR(255) NULL,
	CONSTRAINT tbl_timelines_PK PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=latin1
COLLATE=latin1_swedish_ci
COMMENT='This table stores information about the Timelines of the Habarusite application.';
