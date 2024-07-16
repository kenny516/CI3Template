-- Horaires d'ouverture
INSERT INTO garage_auto_ouverture (ouvert, fermer)
VALUES (8, 18);

-- Types de voiture
INSERT INTO garage_auto_type_voiture (description)
VALUES ('Légère'),
       ('4x4'),
       ('Utilitaire');

-- Voitures
INSERT INTO garage_auto_voiture (immatriculation, id_type_voiture)
VALUES ('123ABC', 1),
       ('456DEF', 2),
       ('789GHI', 3),
       ('321JKL', 1),
       ('654MNO', 2);

-- Services
INSERT INTO garage_auto_service (nom, duree, prix)
VALUES ('Réparation simple', '01:00:00', 150000),
       ('Réparation standard', '02:00:00', 250000),
       ('Réparation complexe', '08:00:00', 800000),
       ('Entretien', '02:30:00', 300000);

-- Slots
INSERT INTO garage_auto_slot (designation)
VALUES ('A'),
       ('B'),
       ('C');

-- Rendez-vous
INSERT INTO garage_auto_rendez_vous (id_voiture, id_service, id_slot, date_debut, date_paiement)
VALUES (1, 1, 1, '2024-07-15 08:00:00', '2024-07-15'),
       (2, 2, 2, '2024-07-15 10:00:00', '2024-07-15'),
       (3, 3, 3, '2024-07-16 08:00:00', '2024-07-16'),
       (4, 4, 1, '2024-07-16 11:00:00', '2024-07-16'),
       (5, 1, 2, '2024-07-17 09:00:00', null),
       (1, 1, 2, '2024-07-16 11:00:00', null);


INSERT INTO garage_auto_details_rendez_vous (date_details, heure_debut, heure_fin, id_rendez_vous)
VALUES ('2024-07-15', '08:00:00', '09:00:00', 1),
       ('2024-07-15', '10:00:00', '12:00:00', 2),
       ('2024-07-16', '08:00:00', '16:00:00', 3),
       ('2024-07-16', '11:00:00', '13:30:00', 4),
       ('2024-07-17', '09:00:00', '10:00:00', 5),
       ('2024-07-16', '11:00:00', '10:00:00', 6);
