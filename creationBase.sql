create database archerscoueronnais;
use 'archerscoueronnais' ;

CREATE USER 'archerscoueronnais'@'localhost' IDENTIFIED BY '2020ESCArchers' ;
 GRANT USAGE ON *.* TO 'archerscoueronnais'@'localhost' IDENTIFIED BY '2020ESCArchers' ;
 GRANT ALL privileges ON archerscoueronnais.* to  'archerscoueronnais'@'localhost'  IDENTIFIED BY '2020ESCArchers' ;
CREATE TABLE IF NOT EXISTS adherents ( categories int ,civilite varchar (10) , nom varchar (40),prenom varchar (40),dateNaissance Date,nationnalite varchar (40), email1 varchar (40),email2 varchar (40),telephone1 varchar (13), telephone2 varchar (13),adresse varchar (40), cp varchar (5),commune varchar (40),nomRep1 varchar (40),prenomRep1 varchar (40),nomRep2 varchar (40),prenomRep2 varchar (40), droitimageClub varchar (3),droitimagePress varchar (3),kit varchar (3),lot varchar (3) ,listAttente int,prix int,PRIMARY KEY (nom,prenom));
CREATE TABLE IF NOT EXISTS users (  id_user varchar (20) , mot_passe varchar (20));
insert into users(id_user,mot_passe)value ('jm','celine1');
