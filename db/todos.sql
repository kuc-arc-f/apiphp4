create table todos(
	id int not null auto_increment primary key,
	title varchar(512),
	content text,
	complete int,
	uid int,
	up_date datetime
);



