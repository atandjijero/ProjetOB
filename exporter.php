<?php
require('fpdf.php');
include 'connexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0, 51, 102); // Bleu foncé
$pdf->SetFillColor(220, 220, 220); // Gris clair
$pdf->Cell(190, 10, utf8_decode('Liste des Présences'), 0, 1, 'C', true);
$pdf->Ln(10);
$query = "SELECT e.nom, e.prenom, c.nom_cours, p.date_presence, p.heure_emargement FROM presence p 
          JOIN enseignant e ON p.id_enseignant = e.id_enseignant
          JOIN cours c ON p.id_cours = c.id_cours
          ORDER BY p.date_presence DESC";
$result = pg_query($conn, $query);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 51, 102);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(50, 10, utf8_decode('Nom & Prénom'), 1, 0, 'C', true);
$pdf->Cell(50, 10, utf8_decode('Cours'), 1, 0, 'C', true);
$pdf->Cell(40, 10, utf8_decode('Date_émargement'), 1, 0, 'C', true); 
$pdf->Cell(50, 10, utf8_decode('Heure_émargement'), 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0, 0, 0);

while ($row = pg_fetch_assoc($result)) {
    $pdf->SetFillColor(240, 240, 240);
    $pdf->Cell(50, 10, utf8_decode($row['nom']) . " " . utf8_decode($row['prenom']), 1, 0, 'C', true);
    $pdf->Cell(50, 10, utf8_decode($row['nom_cours']), 1, 0, 'C', true);
    $pdf->Cell(40, 10, utf8_decode($row['date_presence']), 1, 0, 'C', true);
    $pdf->Cell(50, 10, utf8_decode($row['heure_emargement']), 1, 1, 'C', true);
}
$pdf->Ln(10);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(190, 10, utf8_decode('Généré automatiquement par le système'), 0, 1, 'C');
$pdf->Output('D', 'Presences.pdf');
?>