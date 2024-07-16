CREATE OR REPLACE VIEW garage_auto_date_rendez_vous AS
SELECT rdv.id_rendez_vous,
       rdv.date_debut AS date_debut,
       MAX(CONCAT(details.date_details, ' ', details.heure_fin)) AS date_fin,
       slot.designation AS slot_designation,
       slot.id_slot AS id_slot
FROM garage_auto_details_rendez_vous AS details
INNER JOIN garage_auto_rendez_vous rdv
    ON details.id_rendez_vous = rdv.id_rendez_vous
INNER JOIN garage_auto_slot AS slot
    ON rdv.id_slot = slot.id_slot
GROUP BY rdv.id_rendez_vous;

SELECT *
FROM garage_auto_slot AS slot
WHERE slot.id_slot NOT IN (
    SELECT details_date.id_slot
    FROM garage_auto_date_rendez_vous AS details_date
    WHERE details_date.date_debut BETWEEN '2024-07-15 16:00:00' AND '2024-07-15 19:00:00'
        OR details_date.date_fin BETWEEN '2024-07-15 16:00:00' AND '2024-07-15 19:00:00'
);

/*
 * Requêtes pour le dashboard
 */
-- Montant payé par date de référence
SELECT SUM(gas.prix) AS montant_paye_par_date_reference
FROM garage_auto_rendez_vous AS garv
        JOIN
    garage_auto_service gas ON garv.id_service = gas.id_service
WHERE garv.date_paiement IS NOT NULL       AND
      DATE(garv.date_debut) = '2024-07-16' AND
      garv.date_paiement >= DATE(garv.date_debut);

-- Montant impayé par date de référence
SELECT SUM(gas.prix) AS montant_impaye_par_date_reference
FROM garage_auto_rendez_vous AS garv
         JOIN
     garage_auto_service gas ON garv.id_service = gas.id_service
WHERE garv.date_paiement IS NULL AND
    DATE(garv.date_debut) = '2024-07-17';

-- Chiffre d'affaire par type de voiture
SELECT gatv.id_type_voiture,
       gatv.description AS description_type_voiture,
       SUM(gas.prix)    AS chiffre_affaire_par_type_voiture
FROM garage_auto_rendez_vous garv
        JOIN
     garage_auto.garage_auto_voiture gav ON garv.id_voiture = gav.id_voiture
        JOIN
     garage_auto.garage_auto_type_voiture gatv ON gav.id_type_voiture = gatv.id_type_voiture
        JOIN
     garage_auto.garage_auto_service gas ON garv.id_service = gas.id_service
WHERE garv.date_paiement IS NOT NULL
GROUP BY gatv.id_type_voiture;

-- Voitures traitées dans une date donnée
SELECT COUNT(gadrv.id_details),
       gadrv.date_details
FROM garage_auto_details_rendez_vous gadrv
        JOIN
     garage_auto.garage_auto_rendez_vous garv ON gadrv.id_rendez_vous = garv.id_rendez_vous
        JOIN
    garage_auto.garage_auto_service gas ON garv.id_service = gas.id_service
WHERE gadrv.date_details = ''
GROUP BY gadrv.date_details;
