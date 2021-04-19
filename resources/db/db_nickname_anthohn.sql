-- ETML
-- Auteur: kilgood
-- Date: 08.03.2021
-- Description: 

DROP DATABASE IF EXISTS db_nickname_anthohn;

CREATE DATABASE db_nickname_anthohn;

DROP USER IF EXISTS 'dbNicknameUser'@'%';

CREATE USER 'dbNicknameUser'@'%' IDENTIFIED BY 'grp2B_21';

GRANT SELECT, INSERT, UPDATE, DELETE ON db_nickname_anthohn.* TO 'dbNicknameUser'@'%';

USE db_nickname_anthohn;

CREATE TABLE t_teacher(
	idTeacher int AUTO_INCREMENT PRIMARY KEY,
	teaFirstname varchar(50) NOT NULL,
	teaName varchar(50) NOT NULL,
	teaGender char(1) NOT NULL,
	teaNickname varchar(100) NOT NULL,
	teaOrigin varchar(255) NOT NULL);

CREATE TABLE t_section(
	idSection int AUTO_INCREMENT PRIMARY KEY,
	secName varchar(30) NOT NULL);

CREATE TABLE t_teaches(
	fkteacher int NOT NULL,
	fksection int NOT NULL,
	CONSTRAINT fk_teacher_teaches_id FOREIGN KEY (fkteacher) REFERENCES t_teacher(idTeacher) ON DELETE CASCADE,
	CONSTRAINT fk_section_teaches_id FOREIGN KEY (fksection) REFERENCES t_section(idSection) ON DELETE CASCADE,
	PRIMARY KEY (fksection,fkteacher));

CREATE TABLE t_user(
	idUser int AUTO_INCREMENT PRIMARY KEY,
	useLogin varchar(50) NOT NULL,
	usePassword varchar(255) NOT NULL,
	useIsAdmin BOOLEAN NOT NULL);

INSERT INTO t_user (useLogin, usePassword, useIsAdmin) VALUES 
("admin", "$2y$10$ebINd1FQ518pmgmdagSBzeoSS3Ps5NEucIASl0DVnqJt4jD9oXV1a", 1
);

INSERT INTO t_section (secName) VALUES 
("Informatique"),
("Théorie");

INSERT INTO t_teacher (teaFirstname, teaName, teaGender, teaNickname, teaOrigin) VALUES 
("Karim", "Bourahla", "M", "Ca va?? Vous allez bien ??", "Il dit toujours ça lm a O"),
("Michel","Delgado","M","THE G.O.A.T","Meilleur prof :O"),
("Patrick", "Chenaux", "M", "?", "C'est qui ?"),
("Patrick", "Olivier", "O", "Sportif", "sportif et gentil."),
("Aurélie", "Curchod", "W", "Classe", "On la voit que en scéance de classe."),
("Laurent", "Duding", "M", "Covid", "On l'a eu lors des rattrapage covid."),
("Olivier", "Merenda", "M", "Merenda Consulting", "Entreprise factisse lors de son cours."),
("Salulessa", "Salulessa", "M", "WE MOVE TO YOU", "Phrase qu'il dit quand nous lisons et qu'il change d'élève."),
("Sarah", "Ridet", "W", "OKAYYYY", "Dit ça à chaque fin de pause."),
("Jean-Christophe", "Jaggi", "M", "KILLIAANNNN", "Il dit KilliEn à la place de killian."),
("Jonathan", "Gander", "M", "the best", "Prof jeune sympathique est dynamqique, très gentil !!"),
("Gilbert", "Gruaz", "M", "Gruazerie", "Car il nous fait toujours des gruazeries."),
("Betrand", "Sahli", "M", "Médiateur", "Car c'est un médiateur."),
("Cyril", "Sokoloff", "M", "Story zzz", "Aime beacoup raconter des histoires.."),
("Isabelle", "Stucki", "W", "Cookie", "Nous a offert de cookies et un gâteau lors du premier cours."
);

INSERT INTO t_teaches (fkteacher, fksection) VALUES 
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1
);