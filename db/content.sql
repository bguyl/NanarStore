
/* Categories */
insert into t_category values ('Action');
insert into t_category values ('Fantastique');
insert into t_category values ('Comédie');
insert into t_category values ('Science-fiction');
insert into t_category values ('Romance');


/* Article */
insert into t_article values
(1, 'Hitman le Cobra', 'Best nanar ever!', 'Action', 'hitman.jpg', 9.99);
insert into t_article values
(2, 'AlphaForce', 'Random name!', 'Action', 'alpha.jpg', 0.99);
insert into t_article values
(3, 'Turkish Star Wars', 'Epic!', 'Science-fiction', 'turkish.jpg', 199.99);


/* raw password is 'john' */
insert into t_user values
(1, 'JohnDoe', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER', 'JohnDoe@gmail.com');
/* raw password is 'jane' */
insert into t_user values
(2, 'JaneDoe', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER', 'JaneDoe@gmail.com');
/* raw password is '@dm1n' */
insert into t_user values
(3, 'admin', 'gqeuP4YJ8hU3ZqGwGikB6+rcZBqefVy+7hTLQkOD+jwVkp4fkS7/gr1rAQfn9VUKWc7bvOD7OsXrQQN5KGHbfg==', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN', 'admin@gmail.com');


/* Comments */
insert into t_comment values
(1, 'JohnDoe', 'Le film de toute une vie', 14, 1, 1);
insert into t_comment values
(2, 'JaneDoe', 'Piou Piou Piou.', 8, 1, 2);

/* Order */
/* -- JohnDoe orders -- */
insert into t_order values (1, 1, 34);
insert into t_order values (1, 2, 21);
/* -- JaneDoe orders -- */
insert into t_order values (2, 3, 10);
insert into t_order values (2, 1, 6);
