use p1703235;
SET SQL_SAFE_UPDATES = 0;

DROP TABLE IF EXISTS 
resultat,
associations_duels,
duels,
achievements_associations, 
associations_competitions, 
achievements, 
associations, 
competitions;

CREATE TABLE associations(
	id INT NOT NULL AUTO_INCREMENT,
    nom varchar(100),
    description varchar(500),
    domaine varchar(50),
    mdp Varchar(64),
    score int,
    classement int DEFAULT 0,
    groupe text,
    filename text,
    website varchar(100),
    PRIMARY KEY(id)
);

CREATE TABLE competitions(
	id INT NOT NULL AUTO_INCREMENT,
    NomCompetition Text,
    Lieu Text,
    DateCompet datetime,
    Description Text,
    Image text,
    terminee bool,
    PRIMARY KEY(id)
);

CREATE TABLE achievements(
	id int not null auto_increment,
    titre text,
    PRIMARY KEY(id)
);

CREATE TABLE achievements_associations(
	association_id int,
    achievement_id int,
    date_obtention datetime,
    PRIMARY KEY(association_id, achievement_id),
    CONSTRAINT FOREIGN KEY(association_id) REFERENCES associations(id),
    CONSTRAINT FOREIGN KEY(achievement_id) REFERENCES achievements(id)
);

CREATE TABLE associations_competitions(
	association_id int,
    competition_id int,
    PRIMARY KEY(association_id, competition_id),
    CONSTRAINT FOREIGN KEY(association_id) REFERENCES associations(id),
    CONSTRAINT FOREIGN KEY(competition_id) REFERENCES competitions(id)
);

CREATE TABLE duels(
	id int not null auto_increment,
    duelDate datetime,
    message text,
    PRIMARY KEY(id)
);

CREATE TABLE associations_duels(
	duel_id int not null,
    association_id int not null,
    PRIMARY KEY (association_id, duel_id),
    FOREIGN KEY (duel_id) REFERENCES duels(id),
    FOREIGN KEY (association_id) REFERENCES associations(id)	
    
);

DROP TRIGGER IF EXISTS updateClassement;
DROP TRIGGER IF EXISTS newClassement;
DROP TRIGGER IF EXISTS updateScore;
DROP FUNCTION IF EXISTS getFirstAssocScore;

DELIMITER $

CREATE TRIGGER updateClassement AFTER UPDATE ON associations
FOR EACH ROW
BEGIN
	IF NOT (NEW.Classement = OLD.Classement) THEN
	UPDATE Associations SET Classement = Classement+1 WHERE Classement >= NEW.Classement;
    END IF;
END$

CREATE FUNCTION getFirstAssocScore(score int , classement int) RETURNS INT
BEGIN
	DECLARE endloop BOOL;
	DECLARE parcoursAssoc CURSOR FOR (SELECT classement, score FROM associations);
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET endloop:=1;
    OPEN parcoursAssoc;
    WHILE NOT (endloop) DO
		IF parcoursAssoc.score < score THEN
			SET classement := parcoursAssoc.classement;
        END IF;
    END WHILE;
    RETURN id;
END$

CREATE TRIGGER updateScore BEFORE UPDATE ON associations
FOR EACH ROW
BEGIN
	IF NOT (NEW.Score = OLD.Score) THEN
			SET NEW.Classement = getFirstAssocScore(NEW.Score);
    END IF;
END$
 
  INSERT INTO associations VALUES(null, "Park'O'Drone", "Park’o drone est une entreprise proposant des services événementiels sur mesure pour les entreprises, institutions et associations.", "Séminaires", "2ee61124a8695f5f3491df998d58a9160d7acac1ee28ec3578d158a1ff026ed4", 0, 1,'admin', 'Park\'o\'Drone.png', 'http://www.parkodrone.fr/')$
 
 CREATE TRIGGER newClassement BEFORE INSERT ON associations
 FOR EACH ROW
 BEGIN
	SET NEW.Score = 0;
    SET NEW.Classement = (SELECT Classement FROM associations ORDER BY Classement DESC LIMIT 1)+1;
    SET NEW.groupe = 'user';
 END$
 
 CREATE TRIGGER updtClass AFTER DELETE ON associations
 FOR EACH ROW
 BEGIN
	UPDATE Associations SET Classement = Classement+1 WHERE Classement >= OLD.Classement;
    
    END$
 
 DELIMITER ;
 
INSERT INTO associations VALUES(null, "IUT Lyon 1", "L'Excellence Technologique", "Enseignement", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://iut.univ-lyon1.fr/');
INSERT INTO associations VALUES(null, "BarrelRollGames", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Jeux Vidéos", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');

/*LIGNE GENEREE AUTOMATIQUEMENT*/
INSERT INTO associations VALUES(null, "NeoAgri", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Réparations et Vente d'Ordinateurs", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Jean-Philippe", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Education", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "EduAgri", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Education", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Neo Enterprises", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Réparations et Vente d'Ordinateurs", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Tech Inc.", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Réparations et Vente d'Ordinateurs", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Jean-Philippe&Co", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Education", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Bio Enterprises", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Industrie Agro-Alimentaire", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "GameAgri", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Win", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Win Enterprises", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Wintest", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Tech&Co", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Réparations et Vente d'Ordinateurs", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Game Inc.", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Win Inc.", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Jean-Philippe Corp.", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Education", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "File&Co", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "TechnoAgri", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Réparations et Vente d'Ordinateurs", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "WinAgri", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "File Corp.", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Jean-Philippetest", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Education", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Technotest", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Réparations et Vente d'Ordinateurs", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Info", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Edu", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Education", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Win Corp.", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "TechAgri", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Réparations et Vente d'Ordinateurs", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Edu&Co", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Education", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Game&Co", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Biotest", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Industrie Agro-Alimentaire", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "File Inc.", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "File", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Game", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Win&Co", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Info Corp.", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Developpement de Logiciels", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Neo&Co", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Réparations et Vente d'Ordinateurs", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');INSERT INTO associations VALUES(null, "Techno Corp.", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue nisl erat, at auctor nulla semper non. Pellentesque convallis consectetur mauris, ac feugiat libero efficitur faucibus. In hac habitasse platea dictumst. Maecenas ut orci sit amet purus efficitur viverra. Nullam sit amet neque sodales, cursus felis ac, pellentesque nunc. Fusce vestibulum eleifend tellus, in euismod nunc ornare eu. Vestibulum vestibulum id enim vitae semper.", "Réparations et Vente d'Ordinateurs", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ');


/*LIGNE GENEREE AUTOMATIQUEMENT*/
INSERT INTO competitions VALUES(null, "Festival Turbo", "Lyon", "2018-5-27, 3:15:00","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor arcu, aliquet et quam gravida, elementum ultrices tellus. Phasellus lacus tortor, congue nec congue vehicula, molestie et dolor. Proin eget commodo ex. Donec in imperdiet velit. Duis suscipit sapien vitae ligula ullamcorper, vel venenatis sem vulputate. Aenean cursus nisl at porta mattis. Nullam eleifend molestie arcu a vestibulum. Duis ac ex quis sem ornare luctus sed eu nisl. Ut odio metus, condimentum quis dui ac, vehicula auctor lacus. Praesent eget metus porttitor ipsum egestas tempus. Nam placerat eget odio in faucibus. Curabitur nisi turpis, blandit nec commodo consectetur, ultrices ac purus. Donec tempor efficitur auctor.","Park'o'Drone.png", 1);
INSERT INTO competitions VALUES(null, "Compétition Turbo", "Paris", "2019-7-21, 5:45:00","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor arcu, aliquet et quam gravida, elementum ultrices tellus. Phasellus lacus tortor, congue nec congue vehicula, molestie et dolor. Proin eget commodo ex. Donec in imperdiet velit. Duis suscipit sapien vitae ligula ullamcorper, vel venenatis sem vulputate. Aenean cursus nisl at porta mattis. Nullam eleifend molestie arcu a vestibulum. Duis ac ex quis sem ornare luctus sed eu nisl. Ut odio metus, condimentum quis dui ac, vehicula auctor lacus. Praesent eget metus porttitor ipsum egestas tempus. Nam placerat eget odio in faucibus. Curabitur nisi turpis, blandit nec commodo consectetur, ultrices ac purus. Donec tempor efficitur auctor.","Park'o'Drone.png", 0);
INSERT INTO competitions VALUES(null, "Course Expert", "Lyon", "2018-0-20, 1:00:00","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor arcu, aliquet et quam gravida, elementum ultrices tellus. Phasellus lacus tortor, congue nec congue vehicula, molestie et dolor. Proin eget commodo ex. Donec in imperdiet velit. Duis suscipit sapien vitae ligula ullamcorper, vel venenatis sem vulputate. Aenean cursus nisl at porta mattis. Nullam eleifend molestie arcu a vestibulum. Duis ac ex quis sem ornare luctus sed eu nisl. Ut odio metus, condimentum quis dui ac, vehicula auctor lacus. Praesent eget metus porttitor ipsum egestas tempus. Nam placerat eget odio in faucibus. Curabitur nisi turpis, blandit nec commodo consectetur, ultrices ac purus. Donec tempor efficitur auctor.","Park'o'Drone.png", 1);
INSERT INTO competitions VALUES(null, "Festival Eclair", "Nice", "2019-9-22, 4:15:00","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor arcu, aliquet et quam gravida, elementum ultrices tellus. Phasellus lacus tortor, congue nec congue vehicula, molestie et dolor. Proin eget commodo ex. Donec in imperdiet velit. Duis suscipit sapien vitae ligula ullamcorper, vel venenatis sem vulputate. Aenean cursus nisl at porta mattis. Nullam eleifend molestie arcu a vestibulum. Duis ac ex quis sem ornare luctus sed eu nisl. Ut odio metus, condimentum quis dui ac, vehicula auctor lacus. Praesent eget metus porttitor ipsum egestas tempus. Nam placerat eget odio in faucibus. Curabitur nisi turpis, blandit nec commodo consectetur, ultrices ac purus. Donec tempor efficitur auctor.","Park'o'Drone.png", 0);
INSERT INTO competitions VALUES(null, "Grand Prix Eclair", "Bourg-en-Bresse", "2019-8-6, 1:15:00","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor arcu, aliquet et quam gravida, elementum ultrices tellus. Phasellus lacus tortor, congue nec congue vehicula, molestie et dolor. Proin eget commodo ex. Donec in imperdiet velit. Duis suscipit sapien vitae ligula ullamcorper, vel venenatis sem vulputate. Aenean cursus nisl at porta mattis. Nullam eleifend molestie arcu a vestibulum. Duis ac ex quis sem ornare luctus sed eu nisl. Ut odio metus, condimentum quis dui ac, vehicula auctor lacus. Praesent eget metus porttitor ipsum egestas tempus. Nam placerat eget odio in faucibus. Curabitur nisi turpis, blandit nec commodo consectetur, ultrices ac purus. Donec tempor efficitur auctor.","Park'o'Drone.png", 0);
INSERT INTO competitions VALUES(null, "Compétition Tutoriel", "Bordeaux", "2018-11-6, 6:30:00","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor arcu, aliquet et quam gravida, elementum ultrices tellus. Phasellus lacus tortor, congue nec congue vehicula, molestie et dolor. Proin eget commodo ex. Donec in imperdiet velit. Duis suscipit sapien vitae ligula ullamcorper, vel venenatis sem vulputate. Aenean cursus nisl at porta mattis. Nullam eleifend molestie arcu a vestibulum. Duis ac ex quis sem ornare luctus sed eu nisl. Ut odio metus, condimentum quis dui ac, vehicula auctor lacus. Praesent eget metus porttitor ipsum egestas tempus. Nam placerat eget odio in faucibus. Curabitur nisi turpis, blandit nec commodo consectetur, ultrices ac purus. Donec tempor efficitur auctor.", "Park'o'Drone.png", 1);
INSERT INTO competitions VALUES(null, "Festival Tutoriel", "Nantes", "2019-7-24, 0:00:00","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor arcu, aliquet et quam gravida, elementum ultrices tellus. Phasellus lacus tortor, congue nec congue vehicula, molestie et dolor. Proin eget commodo ex. Donec in imperdiet velit. Duis suscipit sapien vitae ligula ullamcorper, vel venenatis sem vulputate. Aenean cursus nisl at porta mattis. Nullam eleifend molestie arcu a vestibulum. Duis ac ex quis sem ornare luctus sed eu nisl. Ut odio metus, condimentum quis dui ac, vehicula auctor lacus. Praesent eget metus porttitor ipsum egestas tempus. Nam placerat eget odio in faucibus. Curabitur nisi turpis, blandit nec commodo consectetur, ultrices ac purus. Donec tempor efficitur auctor.", "Park'o'Drone.png", 0);
INSERT INTO competitions VALUES(null, "Course Spécial", "Nice", "2018-6-16, 21:30:00","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor arcu, aliquet et quam gravida, elementum ultrices tellus. Phasellus lacus tortor, congue nec congue vehicula, molestie et dolor. Proin eget commodo ex. Donec in imperdiet velit. Duis suscipit sapien vitae ligula ullamcorper, vel venenatis sem vulputate. Aenean cursus nisl at porta mattis. Nullam eleifend molestie arcu a vestibulum. Duis ac ex quis sem ornare luctus sed eu nisl. Ut odio metus, condimentum quis dui ac, vehicula auctor lacus. Praesent eget metus porttitor ipsum egestas tempus. Nam placerat eget odio in faucibus. Curabitur nisi turpis, blandit nec commodo consectetur, ultrices ac purus. Donec tempor efficitur auctor.", "Park'o'Drone.png", 1);
INSERT INTO competitions VALUES(null, "Compétition Test Over", "Ambérieux", "2018-12-25, 00:00:00","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tortor arcu, aliquet et quam gravida, elementum ultrices tellus. Phasellus lacus tortor, congue nec congue vehicula, molestie et dolor. Proin eget commodo ex. Donec in imperdiet velit. Duis suscipit sapien vitae ligula ullamcorper, vel venenatis sem vulputate. Aenean cursus nisl at porta mattis. Nullam eleifend molestie arcu a vestibulum. Duis ac ex quis sem ornare luctus sed eu nisl. Ut odio metus, condimentum quis dui ac, vehicula auctor lacus. Praesent eget metus porttitor ipsum egestas tempus. Nam placerat eget odio in faucibus. Curabitur nisi turpis, blandit nec commodo consectetur, ultrices ac purus. Donec tempor efficitur auctor.", "Park'o'Drone.png", 1);
 
SELECT * FROM associations_competitions;
