<?php
include 'connexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier que les données sont bien reçues
if (!isset($_POST["id_enseignant"], $_POST["id_cours"])) {
    die("<p style='color:red;'>Erreur : Les informations requises sont manquantes.</p>");
}

$id_enseignant = pg_escape_string($conn, $_POST["id_enseignant"]);
$id_cours = pg_escape_string($conn, $_POST["id_cours"]);

// Vérifier la connexion à la base
if (!$conn) {
    die("<p style='color:red;'>Erreur de connexion : " . pg_last_error() . "</p>");
}

// Vérifier si l'enseignant a déjà émargé aujourd’hui
$query = "SELECT * FROM presence WHERE id_enseignant = '$id_enseignant' AND id_cours = '$id_cours' AND date_presence = CURRENT_DATE";
$result = pg_query($conn, $query);

if (pg_num_rows($result) > 0) {
    echo "<p style='color:green;'>Vous avez déjà émargé aujourd’hui.</p>";
} else {
    // 🔹 Enregistrement automatique de la présence
    $query = "INSERT INTO presence (id_enseignant, id_cours, date_presence) VALUES ('$id_enseignant', '$id_cours', CURRENT_DATE)";
    pg_query($conn, $query);

    // 🔹 Récupérer la durée du cours
    $query = "SELECT heure_debut, heure_fin FROM cours WHERE id_cours = '$id_cours'";
    $result = pg_query($conn, $query);
    $cours = pg_fetch_assoc($result);

    if (!$cours) {
        die("<p style='color:red;'>Erreur : Impossible de récupérer les horaires du cours.</p>");
    }

    // 🔹 Calculer la durée du cours
    $heure_debut = new DateTime($cours['heure_debut']);
    $heure_fin = new DateTime($cours['heure_fin']);
    $duree = $heure_debut->diff($heure_fin)->format('%H.%i');

    // 🔹 Mettre à jour les heures totales de l’enseignant
    $query = "UPDATE enseignant SET heures_totales = heures_totales + '$duree' WHERE id_enseignant = '$id_enseignant'";
    pg_query($conn, $query);

    // 🔹 Enregistrer automatiquement dans `historique`
    $query = "INSERT INTO historique (id_enseignant, id_cours, date_emargement, heures_enseignees) 
              VALUES ('$id_enseignant', '$id_cours', CURRENT_DATE, '$duree')";
    pg_query($conn, $query);

    echo "<p style='color:green;'>Présence émargée avec succès et ajout automatique dans l'historique ! Durée du cours : $duree heures.</p>
      <a href='deconnexion.php' class='btn btn-danger'>Déconnectez-vous alors!</a>";
}
?>