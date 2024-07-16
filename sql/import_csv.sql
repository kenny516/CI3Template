INSERT INTO garage_auto_service (nom, duree, prix)
SELECT service, duree,
       (SELECT montant
        FROM garage_auto_import_travaux travaux
        WHERE travaux.type_service = service
        ORDER BY date_rdv DESC, heure_rdv DESC
        LIMIT 1) AS prix_recent
FROM garage_auto_import_service;



--
INSERT INTO garage_auto_type_voiture (description)
SELECT DISTINCT type_voiture
FROM garage_auto_import_travaux
WHERE type_voiture NOT IN (SELECT description FROM garage_auto_type_voiture);



--
INSERT INTO garage_auto_voiture (immatriculation, id_type_voiture)
SELECT DISTINCT voiture,
                (SELECT id_type_voiture FROM garage_auto_type_voiture WHERE description = travaux.type_voiture)
FROM garage_auto_import_travaux travaux
WHERE voiture NOT IN (SELECT immatriculation FROM garage_auto_voiture);



--
INSERT INTO garage_auto_rendez_vous (id_voiture, id_service, id_slot, date_debut, date_paiement)
SELECT
    (SELECT id_voiture FROM garage_auto_voiture WHERE immatriculation = travaux.voiture),
    (SELECT id_service FROM garage_auto_service WHERE nom = travaux.type_service),
    1, -- Assumant que id_slot est une valeur fixe ou peut être déterminé autrement
    CONCAT(travaux.date_rdv, ' ', travaux.heure_rdv),
    travaux.date_paiement
FROM garage_auto_import_travaux travaux;
