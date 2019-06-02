create table repos(
	id int not null auto_increment primary key,
	name varchar(256),
	content text,
	url varchar(1024),
	uid int,
	up_date datetime
);



