<?php
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $heures_totales = $_POST["heures_totales"];

    $query = "INSERT INTO enseignant (nom, prenom, email, heures_totales) VALUES ('$nom', '$prenom', '$email','$heures_totales')";
    pg_query($conn, $query);

    echo "Enseignant ajouté avec succès !";
}
?>