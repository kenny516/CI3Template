<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/fpdf/fpdf.php';

if (! function_exists('generate_service_receipt_pdf')) {
    function generate_service_receipt_pdf($rendezVousDetails, $filename = 'devis.pdf') {
        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);

        $pdf->SetFillColor(79, 129, 189);
        $pdf->SetTextColor(255);

        $pdf->Cell(0, 20, 'RECU DE DEVIS - Garage Auto', 0, 1, 'C', true);

        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(0);

        $pdf->Cell(60, 10, utf8_decode('Immatriculation:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, utf8_decode($rendezVousDetails['immatriculation']), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 10, utf8_decode('Type de Voiture:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, utf8_decode($rendezVousDetails['type_voiture']), 0, 1, 'L');

        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('Détails du Service'), 0, 1, 'L');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(60, 10, utf8_decode('Service:'), 0, 0, 'L');
        $pdf->Cell(0, 10, utf8_decode($rendezVousDetails['service_name']), 0, 1, 'L');

        $pdf->Cell(60, 10, utf8_decode('Prix du Service:'), 0, 0, 'L');
        $pdf->Cell(0, 10, utf8_decode($rendezVousDetails['service_price']) . ' $', 0, 1, 'L');

        $pdf->Cell(60, 10, utf8_decode('Durée du Service:'), 0, 0, 'L');
        $pdf->Cell(0, 10, utf8_decode($rendezVousDetails['service_duration']), 0, 1, 'L');

        $pdf->Cell(60, 10, utf8_decode('Date de Début:'), 0, 0, 'L');
        $pdf->Cell(0, 10, utf8_decode($rendezVousDetails['date_debut']), 0, 1, 'L');

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('Résumé des Coûts'), 0, 1, 'L');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(60, 10, utf8_decode('Total:'), 0, 0, 'L');
        $pdf->Cell(0, 10, utf8_decode($rendezVousDetails['service_price']) . ' $', 0, 1, 'L');

        $pdf->Output('D', $filename);
    }
}
