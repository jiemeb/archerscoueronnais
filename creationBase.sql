create database archerscoueronnais;
use 'archerscoueronnais' ;

CREATE USER 'archerscoueronnais'@'localhost' IDENTIFIED BY '2020ESCArchers' ;
 GRANT USAGE ON *.* TO 'archerscoueronnais'@'localhost' IDENTIFIED BY '2020ESCArchers' ;
 GRANT ALL privileges ON archerscoueronnais.* to  'archerscoueronnais'@'localhost'  IDENTIFIED BY '2020ESCArchers' ;
CREATE TABLE IF NOT EXISTS adherents ( id_adherent int AUTO_INCREMENT PRIMARY KEY ,categories int ,civilite varchar (10) , nom varchar (40),prenom varchar (40),dateNaissance Date,nationalite varchar (40), email1 varchar (40),email2 varchar (40),telephone1 varchar (13), telephone2 varchar (13),adresse varchar (40), cp varchar (5),commune varchar (40),nomRep1 varchar (40),prenomRep1 varchar (40),nomRep2 varchar (40),prenomRep2 varchar (40), droitimageClub varchar (3),droitimagePress varchar (3),kit varchar (3),lot varchar (3) ,lateralite varchar (20), arc int ,arcType varchar (32),listAttente int,prix int,chequeKit varchar(20) ,chequeCotisation varchar (20),dossier varchar (20), certificat varchar (10), licence varchar (10),groupe varchar(32),remarque varchar (32) CONSTRAINT uniqueNom UNIQUE (nom,prenom));
CREATE TABLE IF NOT EXISTS users (  id_user varchar (20) , mot_passe varchar (100),authorized varchar (1) default '0',PRIMARY KEY (id_user) );
CREATE TABLE IF NOT EXISTS images ( id_image int  AUTO_INCREMENT PRIMARY KEY, photo blob, foreign key   (id_Image) REFERENCES adherents(id_adherent) ON DELETE CASCADE );


mise a  jour
alter table adherents add  dossier varchar (20) ;
alter table adherents add  certificat varchar (10) ;
alter table adherents modify lateralite varchar (20);
alter table adherents add ( licence varchar (10), debutant varchar (5),arcType varchar (10)) ;
alter table adherents add ( groupe varchar (32));
alter table adherents add ( remarque varchar (32));

CREATE TABLE IF NOT EXISTS concours ( id_concours int AUTO_INCREMENT PRIMARY KEY  ,concoursName varchar (100) , concoursDate date, referent varchar (100) ,note varchar (200), prixAdulte  varchar (5),prixEnfant  varchar (5), CONSTRAINT concourName UNIQUE (concoursName))  ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci  ;

CREATE TABLE IF NOT EXISTS concoursArchers ( id_concoursArchers  int AUTO_INCREMENT PRIMARY KEY ,id_adherent int ,id_concours int,blason varchar (30), depart VARCHAR (20) ,ConcoursPrix float , etat  varchar (20), CONSTRAINT uniqueNom UNIQUE (id_adherent, id_concours),  FOREIGN KEY (id_concours) REFERENCES concours (id_concours) ON DELETE CASCADE, FOREIGN KEY (id_adherent)  REFERENCES adherents (id_adherent) ON DELETE CASCADE ) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

