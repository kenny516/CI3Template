CREATE DATABASE garage_auto;
USE garage_auto;

CREATE TABLE garage_auto_admin
(
    id_admin      INT PRIMARY KEY AUTO_INCREMENT,
    email         VARCHAR(255),
    mots_de_passe VARCHAR(255)
);

CREATE TABLE garage_auto_ouverture
(
    id_ouverture INT PRIMARY KEY AUTO_INCREMENT,
    ouvert       SMALLINT,
    fermer       SMALLINT
);

CREATE TABLE garage_auto_type_voiture
(
    id_type_voiture INT PRIMARY KEY AUTO_INCREMENT,
    description     VARCHAR(50)
);

CREATE TABLE garage_auto_voiture
(
    id_voiture      INT PRIMARY KEY AUTO_INCREMENT,
    immatriculation VARCHAR(7),
    id_type_voiture INT,
    FOREIGN KEY (id_type_voiture) REFERENCES garage_auto_type_voiture (id_type_voiture)
);

CREATE TABLE garage_auto_service
(
    id_service INT PRIMARY KEY AUTO_INCREMENT,
    nom        VARCHAR(50) NOT NULL,
    duree      TIME        NOT NULL,
    prix       DOUBLE      NOT NULL
);

CREATE TABLE garage_auto_slot
(
    id_slot     INT PRIMARY KEY AUTO_INCREMENT,
    designation VARCHAR(50)
);

CREATE TABLE garage_auto_rendez_vous
(
    id_rendez_vous INT PRIMARY KEY AUTO_INCREMENT,
    id_voiture     INT,
    id_service     INT,
    id_slot        INT,
    date_debut     DATETIME NOT NULL,
    date_paiement  DATE,
    FOREIGN KEY (id_voiture) REFERENCES garage_auto_voiture (id_voiture),
    FOREIGN KEY (id_service) REFERENCES garage_auto_service (id_service),
    FOREIGN KEY (id_slot) REFERENCES garage_auto_slot (id_slot)
);

ALTER TABLE garage_auto_rendez_vous
    DROP FOREIGN KEY garage_auto_rendez_vous_ibfk_2;

ALTER TABLE garage_auto_rendez_vous
    ADD CONSTRAINT garage_auto_rendez_vous_ibfk_2
        FOREIGN KEY (id_service) REFERENCES garage_auto_service (id_service)
            ON DELETE CASCADE;

CREATE TABLE garage_auto_details_rendez_vous
(
    id_details     INT PRIMARY KEY AUTO_INCREMENT,
    date_details   DATE NOT NULL,
    heure_debut    TIME NOT NULL,
    heure_fin      TIME NOT NULL,
    id_rendez_vous INT  NOT NULL,
    FOREIGN KEY (id_rendez_vous) REFERENCES garage_auto_rendez_vous (id_rendez_vous)
);
