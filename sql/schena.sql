# CREATE DATABASE garage_auto;
#
# USE garage_auto;


CREATE TABLE garage_auto_admin(
    email VARCHAR(255),
    mots_de_passe VARCHAR(255)
);


CREATE TABLE garage_auto_ouverture
(
    ouvert SMALLINT,
    fermer SMALLINT
);

CREATE TABLE garage_auto_type_voiture
(
    id_type_voiture INT auto_increment,
    description     VARCHAR(50)
);

CREATE TABLE garage_auto_voiture
(
    id_voiture      INT auto_increment,
    immatriculation VARCHAR(7),
    id_type_voiture INT,
    FOREIGN KEY (id_type_voiture) REFERENCES garage_auto_type_voiture (id_type_voiture)
);

CREATE TABLE garage_auto_services
(
    id_service INT AUTO_INCREMENT PRIMARY KEY,
    nom        VARCHAR(50) NOT NULL,
    duree      TIME        NOT NULL,
    prix       INT         NOT NULL
);

CREATE TABLE garage_auto_slot
(
    id_slot  INT auto_increment,
    designation VARCHAR(50)
);

CREATE TABLE garage_auto_rendez_vous
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    id_voiture     INT,
    id_service    INT,
    id_slot       INT,
    date_debut    DATETIME NOT NULL,
    date_paiement DATE,
    FOREIGN KEY (id_voiture) REFERENCES garage_auto_voiture (id_voiture),
    FOREIGN KEY (id_service) REFERENCES garage_auto_services (id_service),
    FOREIGN KEY (id_slot) REFERENCES garage_auto_slot (id_slot)
);




