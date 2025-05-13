<?php
include 'connexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["email"]) || !isset($_POST["mot_de_passe"])) {
        die("Erreur : Email ou mot de passe manquant !");
    }

    $email = pg_escape_string($conn, $_POST["email"]);
    $mot_de_passe = $_POST["mot_de_passe"];

    if (!$conn) {
        die("Erreur de connexion à la base : " . pg_last_error());
    }

    $query = "SELECT * FROM utilisateurs WHERE email = '$email'";
    $result = pg_query($conn, $query);
    $user = pg_fetch_assoc($result);

    if (!$user) {
        die("Erreur : Aucun utilisateur trouvé avec cet email.");
    }

    // Vérification du mot de passe
    if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION["email"] = $email;
        $_SESSION["role"] = $user["role"];
        $_SESSION["id_utilisateur"] = $user["id_utilisateur"]; // AJOUTÉ

        if ($user["role"] == "administrateur") {
            header("Location: admin.php");
        } else {
            header("Location: enseignants.php"); // Rediriger vers emarge.php après connexion
        }
        exit();
    } else {
        echo "Identifiants incorrects.";
    }
}
?>