
/* Categories */
insert into t_category values ('Action');
insert into t_category values ('Fantastique');
insert into t_category values ('Comédie');
insert into t_category values ('Science-fiction');
insert into t_category values ('Romance');
insert into t_category values ('Horreur');
insert into t_category values ('Hors catégories');


/* Article */
insert into t_article values
(1, 'Hitman le Cobra', "Après une course effrénée, l'impassible Phillip tue Roger, affreux jeune homme ayant vendu des informations aux japonais. Mike, le frère de Roger, veut se venger de Phillip. Il envoie Bob Blackie et un autre sbire retrouver Phillip.", 'Action', 'hitman_le_cobra.jpg', 9.99);
insert into t_article values
(2, 'Alpha Force', "In the not too distant future a new team of specially trained government soldiers called an Interception Team contend with the latest hostile alien encounter. When an alien scout ship crashes in eastern Russia, Sean Lambert and his elite force are dispatched to investigate. ", 'Action', 'alpha_force.jpg', 0.99);
insert into t_article values
(3, 'Turkish Star Wars', "Murat, pilote de vaisseau spatial, et son coéquipier combattent des extra-terrestres. Ils s'égarent sur une planète, qui sera prise d'assaut par l'Empire Tyrannique. Les impérialistes comptent dominer l'univers grâce à l'intelligence humaine : Ils prennent des cerveaux humains pour constituer un seul cerveau gigantesque. Murat combattra l'Empire et deviendra le très légendaire homme qui sauva le monde.", 'Science-fiction', 'turkish_star_wars.jpg', 19.99);
insert into t_article values
(4, 'Crocodile Fury', "Dans un petit village de Thailande, un monstrueux crocodile dévore un à un les habitants... ", 'Hors catégories', 'crocodile_fury.jpg', 0.99);
insert into t_article values
(5, 'Blood Freak', "Herschell un motard, rencontre une jeune femme catholique qui lui propose de venir chez elle. Il y fait la connaissance de la soeur de cette dernière qui lui trouve un emploi dans une ferme d'élevage de dindes tenue par son père, un savant fou. Le scientifique et son acolyte vont transformer Herschell en monstre dinde qui va s'attaquer aux dealers et aux consommateurs de drogues... ", 'Horreur', 'blood_freak.jpg', 9.99);


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
