<?php
include 'connexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT); // Sécurisation du mot de passe

    $query = "INSERT INTO administrateur (nom, email, mot_de_passe) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, [$nom, $email, $mot_de_passe]);

    if ($result) {
        echo "<div class='alert alert-success'>Inscription réussie !</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de l'inscription.</div>";
    }
}

pg_close($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription Administrateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Inscription Administrateur</h2>
        <form action="administrateur.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="mot_de_passe" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
        </form>
    </div>
</body>
</html>