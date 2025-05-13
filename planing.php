<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cours = $_POST["id_cours"];
    $id_enseignant = $_POST["id_enseignant"];
    $jour = $_POST["jour"];
    $heure_debut = $_POST["heure_debut"];
    $heure_fin = $_POST["heure_fin"];

    $query = "INSERT INTO planning (id_cours, id_enseignant, jour, heure_debut, heure_fin) VALUES ($id_cours, $id_enseignant, '$jour', '$heure_debut', '$heure_fin')";
    pg_query($conn, $query);

    echo "Planning ajouté avec succès !";
}
?>
