<?php
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    if (isset($_POST['mot_de_passe'])) {
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    } else {
        die("Le mot de passe est manquant dans le formulaire !");
    }
    $heures_totales = $_POST["heures_totales"];

    $query = "INSERT INTO enseignant (nom, prenom, email, mot_de_passe,heures_totales) VALUES ('$nom', '$prenom', '$email', '$mot_de_passe','$heures_totales')";
    pg_query($conn, $query);

    echo "Enseignant ajouté avec succès !";
}
?>