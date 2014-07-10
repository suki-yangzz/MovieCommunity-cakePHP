use php_db;

drop table if exists messages;

create table messages (
	id int unsigned auto_increment primary key,
	sender_id int unsigned,
	user_id int unsigned,
	title varchar(50),
	body text,
	created datetime
);
