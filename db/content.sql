
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
(1, 'JohnDoe', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER');
/* raw password is 'jane' */
insert into t_user values
(2, 'JaneDoe', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER');


/* Comments */
insert into t_comment values
(1, 'JohnDoe', 'Le film de toute une vie', 14, 1, 1);
insert into t_comment values
(2, 'JaneDoe', 'Piou Piou Piou.', 8, 1, 2);
