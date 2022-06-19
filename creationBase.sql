create database archerscoueronnais;
use 'archerscoueronnais' ;

CREATE USER 'archerscoueronnais'@'localhost' IDENTIFIED BY '2020ESCArchers' ;
 GRANT USAGE ON *.* TO 'archerscoueronnais'@'localhost' IDENTIFIED BY '2020ESCArchers' ;
 GRANT ALL privileges ON archerscoueronnais.* to  'archerscoueronnais'@'localhost'  IDENTIFIED BY '2020ESCArchers' ;
CREATE TABLE IF NOT EXISTS adherents ( id_adherent int AUTO_INCREMENT PRIMARY KEY ,categories int ,civilite varchar (10) , nom varchar (40),prenom varchar (40),dateNaissance Date,nationnalite varchar (40), email1 varchar (40),email2 varchar (40),telephone1 varchar (13), telephone2 varchar (13),adresse varchar (40), cp varchar (5),commune varchar (40),nomRep1 varchar (40),prenomRep1 varchar (40),nomRep2 varchar (40),prenomRep2 varchar (40), droitimageClub varchar (3),droitimagePress varchar (3),kit varchar (3),lot varchar (3) ,lateralite varchar (20), arc int ,arcType varchar (10),listAttente int,prix int,chequeKit varchar(20) ,chequeCotisation varchar (20),dossier varchar (20), certificat varchar (10), licence varchar (10), CONSTRAINT uniqueNom UNIQUE (nom,prenom));
CREATE TABLE IF NOT EXISTS users (  id_user varchar (20) , mot_passe varchar (100),authorized varchar (1) default '0',PRIMARY KEY (id_user) );
CREATE TABLE IF NOT EXISTS images ( id_image int  AUTO_INCREMENT PRIMARY KEY, photo blob, foreign key   (id_Image) REFERENCES adherents(id_adherent) ON DELETE CASCADE );


mise a  jour
alter table adherents add  dossier varchar (20) ;
alter table adherents add  certificat varchar (10) ;
alter table adherents modify lateralite varchar (20);
alter table adherents add ( licence varchar (10), debutant varchar (5),arcType varchar (10)) ;