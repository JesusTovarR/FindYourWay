
create database findyourway;
use findyourway;

create table lieu(
	  id int not null auto_increment primary key,
	  nom_lieu VARCHAR (150) not null,
    lat float not null,
    lng float not null,
    indication varchar(150) not null,
    description varchar(500) null,
    image varchar(200) not null,
    indice1 varchar(150) null,
    indice2 varchar(150) null,
    indice3 varchar(150) null,
    indice4 varchar(150) null,
    indice5 varchar(150) null,
    dest_finale tinyint(1) not null
);

create table chemin(
	id int not null auto_increment primary key,
    id_dest_finale int not null,
    id_lieu1 int not null,
    id_lieu2 int not null,
    id_lieu3 int not null,
    id_lieu4 int not null,
    id_lieu5 int not null,
    FOREIGN KEY (id_dest_finale) REFERENCES lieu(id),
	  FOREIGN KEY (id_lieu1) REFERENCES lieu(id),
    FOREIGN KEY (id_lieu2) REFERENCES lieu(id),
    FOREIGN KEY (id_lieu3) REFERENCES lieu(id),
    FOREIGN KEY (id_lieu4) REFERENCES lieu(id),
    FOREIGN KEY (id_lieu5) REFERENCES lieu(id) 
);

create table partie(
	  id int not null auto_increment primary key,
	  token varchar(255) NOT NULL,
    distanceDF float not null,
    score int not null,
    id_chemin int not null,
	FOREIGN KEY (id_chemin) REFERENCES chemin(id)
);


create table utilisateur(
	id_utilisateur int not null auto_increment primary key,
    nom varchar(50) not null,
    email varchar(50) not null,
    nv_droit int not null
);

/*latitud -> coord_y  longitud->coord_X*/
INSERT INTO lieu VALUES (null,'Arc du triomphe',48.8737917,2.29502750000006,
'Ça bien failli être un projet un peu fou: celui d’un éléphant gigantesque dont l’intérieur serait aménagé en musée à la gloire de l’Empereur',
'l''Arc de Triomphe, dont la construction, décidée par l''empereur Napoléon Ier, débuta en 1806 et s''acheva en 1836 sous Louis-Philippe, est situé à Paris, dans le 8e arrondissement. Il s''élève au centre de la place Charles-de-Gaulle',
'img/Arc_Triomphe.jpg',
'Ce type d''ouvrages est un des éléments les plus caractéristiques de l''architecture romaine',
'Utilisé pour commémorer les généraux victorieux',
'Utilisé pour commémorer les évènements importants comme le décès d''un membre de la famille impériale',
'À l''origine, lls sont des structures temporaires en bois. Ils sont ensuite réalisés en pierre',
'Sous sa forme la plus simple,ils se composent de deux piliers, massifs de maçonnerie supportés par des piédestaux',
1
);

INSERT INTO lieu VALUES (null,'Besançon',47.237829,6.024053900000013,
'Elle est entourée de collines et est traversée par le Doubs.',
null,
'img/Besancon.jpg',null,null,null,null,null,0
);

INSERT INTO lieu VALUES (null,'Bordeaux',44.837789,-0.5791799999999512,
'Cette region, à elle seule a plus de 9.000 châteaux producteurs de vin.',
null,
'img/Bordeaux.jpg',
null,null,null,null,null,0
);

INSERT INTO lieu VALUES (null,'Nantes',47.218371,-1.553621000000021,
'À la fin de l’Empire romain, la ville est couramment appelée Portus Namnetum',
null,
'img/Elephant_Nantes.jpg',
null,null,null,null,null,0
);

INSERT INTO lieu VALUES (null,'Dijon',47.3237985,5.03861459999996,
'Sa moutarde très connue',
null,
'img/Dijon.jpg'
,null,null,null,null,null,0);

INSERT INTO lieu VALUES (null,'Limoges',45.83361900000001,1.2611050000000432,
'Sa porcelaine est très connue',
null,
'img/Limoges.jpg',
null,null,null,null,null,0);

INSERT INTO chemin VALUES (null,1,2,3,4,5,6);

INSERT INTO partie VALUES (null,'6ogdeqt586mxjw8lg9rh9hcdjacfz6zw',50000,0,1);