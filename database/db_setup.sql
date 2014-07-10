use php_db;

drop table if exists reviews;
drop table if exists users;

create table reviews (
	id int unsigned auto_increment primary key,
	user_id int unsigned,
	title varchar(50),
	body text,
	rating int,
	media varchar(20),
	created datetime,
	modified datetime
);

create table users (
	id int unsigned auto_increment primary key,
	username varchar(50),
	password varchar(50),
	created datetime,
	modified datetime
);
