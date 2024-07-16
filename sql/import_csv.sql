INSERT INTO garage_auto_service (nom, duree, prix)
SELECT service,
       duree,
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
    voit.id_voiture,
    serv.id_service,
    (
        SELECT slot.id_slot
        FROM garage_auto_slot AS slot
                 LEFT JOIN garage_auto_rendez_vous AS details_date ON slot.id_slot = details_date.id_slot
            AND (
                                                                          details_date.date_debut BETWEEN CONCAT(REPLACE(travaux.date_rdv,'-','/'), ' ', travaux.heure_rdv)
                                                                              AND ADDTIME(CONCAT(REPLACE(travaux.date_rdv,'-','/'), ' ', travaux.heure_rdv),
                                                                                          (SELECT duree
                                                                                           FROM garage_auto_import_service
                                                                                           WHERE service = travaux.type_service)
                                                                                  )
                                                                              OR
                                                                          details_date.date_paiement BETWEEN CONCAT(REPLACE(travaux.date_rdv,'-','/'), ' ', travaux.heure_rdv)
                                                                              AND ADDTIME(CONCAT(REPLACE(travaux.date_rdv,'-','/'), ' ', travaux.heure_rdv),
                                                                                          (SELECT duree
                                                                                           FROM garage_auto_import_service
                                                                                           WHERE service = travaux.type_service)
                                                                                  )
                                                                          )
        WHERE details_date.id_slot IS NULL
        LIMIT 1
    ) AS id_slot,
    STR_TO_DATE(CONCAT(REPLACE(travaux.date_rdv,'-','/'), ' ', travaux.heure_rdv), '%d/%m/%Y %H:%i') AS date_debut,
    travaux.date_paiement AS date_paiement
FROM garage_auto_import_travaux travaux
         INNER JOIN garage_auto_voiture voit ON travaux.voiture = voit.immatriculation
         INNER JOIN garage_auto_service serv ON travaux.type_service = serv.nom;







