drop table if exists t_comment;
drop table if exists t_user;
drop table if exists t_article;
drop table if exists t_category;

create table t_category (
    cat_name varchar(100) not null primary key
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_article (
    art_id integer not null primary key auto_increment,
    art_title varchar(100) not null,
    art_description varchar(2000) not null,
    art_category varchar(100) not null,
    foreign key (art_category) references t_category(cat_name),
    art_image varchar(100) not null,
    art_price float not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_user (
    usr_id integer not null primary key auto_increment,
    usr_name varchar(50) not null,
    usr_password varchar(88) not null,
    usr_salt varchar(23) not null,
    usr_role varchar(50) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_order (
    ord_usr integer not null,
    foreign key (ord_usr) references t_user(usr_id),
    ord_art integer not null,
    foreign key (ord_art) references t_article(art_id),
    ord_qt integer,
    primary key (ord_usr, ord_art)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_comment (
    com_id integer not null primary key auto_increment,
    com_author varchar(100) not null,
    com_content varchar(500) not null,
	com_grade int not null,
    art_id integer not null,
	usr_id integer not null,
    constraint fk_com_art foreign key(art_id) references t_article(art_id),
	constraint fk_com_usr foreign key(usr_id) references t_user(usr_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;
