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
SELECT SUM(gas.prix) AS montant_paye_par_date_reference
FROM garage_auto_rendez_vous AS garv
        JOIN
    garage_auto_service gas ON garv.id_service = gas.id_service
WHERE garv.date_paiement IS NOT NULL       AND
      DATE(garv.date_debut) = '2024-07-16' AND
      garv.date_paiement >= DATE(garv.date_debut);

SELECT SUM(gas.prix) AS montant_impaye_par_date_reference
FROM garage_auto_rendez_vous AS garv
         JOIN
     garage_auto_service gas ON garv.id_service = gas.id_service
WHERE garv.date_paiement IS NULL         AND
    DATE(garv.date_debut) = '2024-07-17';
