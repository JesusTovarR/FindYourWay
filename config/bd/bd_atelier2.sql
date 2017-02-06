
create database findyourway;
use findyourway;

create table lieu(
	id int not null auto_increment primary key,
    coord_x float not null,
    coord_y float not null,
    indication varchar(150) not null,
    description varchar(200) not null,
    image varchar(200) not null,
    indice1 varchar(150) not null,
    indice2 varchar(150) not null,
    indice3 varchar(150) not null,
    indice4 varchar(150) not null,
    indice5 varchar(150) not null
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
    distanceDF float not null,
    score int not null,
    id_chemin int not null,
	FOREIGN KEY (id_chemin) REFERENCES chemin(id)
);


create table Utilisateur(
	id_utilisateur int not null auto_increment primary key,
    nom varchar(50) not null,
    email varchar(50) not null,
    nv_droit int not null
);

