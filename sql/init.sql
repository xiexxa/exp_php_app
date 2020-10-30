drop table users;
drop table articles;
drop table follows;
drop table likes;
drop table auth_histories;

create table users (
    id serial not null primary key,
    name varchar(16)  not null unique,
    screen_name varchar(20) not null,
    email varchar(100) not null unique,
    password varchar(64) not null, 
    created_at timestamp not null,
    updated_at timestamp not null
);

create table articles (
    id serial not null primary key,
    body varchar(160) not null,
    user_id int not null,
    created_at timestamp not null,
    updated_at timestamp not null
);

create table follows (
    id serial not null primary key,
    follow_user_id int not null,
    followed_user_id int not null,
    created_at timestamp not null,
    updated_at timestamp not null
);

create table likes (
    id serial not null primary key,
    like_user_id int not null,
    liked_article_id int not null,
    created_at timestamp not null,
    updated_at timestamp not null
);

create table auth_histories (
    id serial not null primary key,
    authorized_user_id int not null,
    ipaddress varchar(15) not null,
    created_at timestamp not null,
    updated_at timestamp not null
);
