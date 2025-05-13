<?php
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_cours = $_POST["nom_cours"];
    $descriptions = $_POST["descriptions"];
    $heure_debut = $_POST["heure_debut"];
    $heure_fin = $_POST["heure_fin"];
    $id_enseignant = $_POST["id_enseignant"];

    $query = "INSERT INTO cours (nom_cours, descriptions, heure_debut, heure_fin, id_enseignant) VALUES ('$nom_cours', '$descriptions', '$heure_debut', '$heure_fin', $id_enseignant)";
    pg_query($conn, $query);

    echo "Cours ajouté avec succès !";
}
?>