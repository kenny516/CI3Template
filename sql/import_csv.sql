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
SELECT voit.id_voiture,
       serv.id_service,
       (SELECT slot.id_slot
        FROM garage_auto_slot AS slot
                 LEFT JOIN garage_auto_rendez_vous AS details_date
                           ON slot.id_slot = details_date.id_slot
                               AND (
                                  (
                                      STR_TO_DATE(CONCAT(travaux.date_rdv, ' ', IFNULL(travaux.heure_rdv, '00:00:00')),
                                                  '%d/%m/%Y %H:%i:%s')
                                          BETWEEN details_date.date_debut
                                          AND ADDTIME(details_date.date_debut,
                                                      (SELECT duree
                                                       FROM garage_auto_import_service
                                                       WHERE service = CAST(details_date.id_service AS CHAR)
                                                       LIMIT 1))
                                      )
                                      OR
                                  (
                                      details_date.date_paiement
                                          BETWEEN STR_TO_DATE(travaux.date_paiement, '%d/%m/%Y')
                                          AND ADDTIME(STR_TO_DATE(travaux.date_paiement, '%d/%m/%Y'), (SELECT duree
                                                                                                       FROM garage_auto_import_service
                                                                                                       WHERE service = CAST(details_date.id_service AS CHAR)
                                                                                                       LIMIT 1))
                                      )
                                  )
        WHERE details_date.id_slot IS NULL
        LIMIT 1)                                                                                              AS id_slot,
       STR_TO_DATE(CONCAT(travaux.date_rdv, ' ', IFNULL(travaux.heure_rdv, '00:00:00')),
                   '%d/%m/%Y %H:%i:%s')                                                                       AS date_debut,
       CASE
           WHEN travaux.date_paiement <> '' AND travaux.date_paiement IS NOT NULL
               THEN STR_TO_DATE(travaux.date_paiement, '%d/%m/%Y')
           ELSE NULL
           END                                                                                                AS date_paiement
FROM garage_auto_import_travaux travaux
         INNER JOIN garage_auto_voiture voit ON travaux.voiture = voit.immatriculation
         INNER JOIN garage_auto_service serv ON travaux.type_service = serv.nom
WHERE travaux.date_paiement IS NOT NULL
  AND travaux.date_paiement <> '';





