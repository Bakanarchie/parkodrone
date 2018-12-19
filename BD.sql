use p1703235;
SET SQL_SAFE_UPDATES = 0;

DROP TABLE IF EXISTS associations_achievements, associations_competitions, achievements, associations, competitions;

CREATE TABLE associations(
	id INT NOT NULL AUTO_INCREMENT,
    Nom Varchar(254),
    Description Text,
    Domaine Text,
    MDP Varchar(64),
    Score int,
    Classement int DEFAULT 0,
    Groupe text,
    filename text,
    PRIMARY KEY(id)
);

CREATE TABLE competitions(
	id INT NOT NULL AUTO_INCREMENT,
    NomCompetition Text,
    Lieu Text,
    DateCompet datetime,
    terminee bool,
    PRIMARY KEY(id)
);

CREATE TABLE achievements(
	id int not null auto_increment,
    titre text,
    PRIMARY KEY(id)
);

CREATE TABLE associations_achievements(
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
 
  INSERT INTO associations VALUES(null, "Park'O'Drone", "Park’o drone est une entreprise proposant des services événementiels sur mesure pour les entreprises, institutions et associations.", "Séminaires", "2ee61124a8695f5f3491df998d58a9160d7acac1ee28ec3578d158a1ff026ed4", 0, 1,'admin', 'Park\'o\'Drone.png')$
 
 CREATE TRIGGER newClassement BEFORE INSERT ON associations
 FOR EACH ROW
 BEGIN
	SET NEW.Score = 0;
    SET NEW.Classement = (SELECT Classement FROM associations ORDER BY Classement DESC LIMIT 1)+1;
 END$
 
 DELIMITER ;
 
INSERT INTO associations VALUES(null, "IUT Lyon 1", "L'Excellence Technologique", "Enseignement", "043e44016b72f2c1630a9db609238712e5f85da6cee0a8c0b73a357715191735", 0, 0, 'user', 'IUTLYON1.jpg');

INSERT INTO competitions VALUES(null, "Compétition Test", "Bourg-en-Bresse", "2018-12-25, 00:00:00", 0);
INSERT INTO competitions VALUES(null, "Compétition Test Over", "Ambérieux", "2018-12-25, 00:00:00", 1);
 
 SELECT * FROM associations;