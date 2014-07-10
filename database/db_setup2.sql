use php_db;

drop table if exists comments;

create table comments (
	id int unsigned auto_increment primary key,
	user_id int unsigned,
	review_id int unsigned,
	body text
);
