insert into users(name, screen_name, email, password, created_at, updated_at) values ('john', 'john_sc', 'mail1@mail.com', 'pass', '2020-10-31 0:00:00', '2020-10-31 0:00:00');
insert into users(name, screen_name, email, password, created_at, updated_at) values ('taro', 'taro_sc', 'mail2@mail.com', 'pass', '2020-10-31 0:00:00', '2020-10-31 0:00:00');

insert into articles(body, user_id, created_at, updated_at) values ('bodybody1', '1', '2020-10-31 0:00:00', '2020-10-31 0:00:00');
insert into articles(body, user_id, created_at, updated_at) values ('bodybody2', '2', '2020-10-31 0:00:00', '2020-10-31 0:00:00');
insert into articles(body, user_id, created_at, updated_at) values ('bodybody3', '1', '2020-10-31 0:00:00', '2020-10-31 0:00:00');

insert into follows(follow_user_id, followed_user_id, created_at, updated_at) values ('1', '2', '2020-10-31 0:00:00', '2020-10-31 0:00:00');

insert into likes(like_user_id, liked_article_id, created_at, updated_at) values ('1', '2', '2020-10-31 0:00:00', '2020-10-31 0:00:00');

insert into auth_histories(authorized_user_id, ipaddress, created_at, updated_at) values ('1', '192.168.0.1', '2020-10-31 0:00:00', '2020-10-31 0:00:00');
