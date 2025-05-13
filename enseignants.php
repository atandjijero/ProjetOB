<?php
session_start();
if ($_SESSION["role"] != "enseignant") {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Espace Enseignant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 600px; margin-top: 50px; }
        .card { padding: 20px; border-radius: 10px; background: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        a { text-decoration: none; font-size: 18px; }
        .btn-lg { margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card text-center">
            <h2 class="mb-4">Bienvenue, Enseignant</h2>
            <a href="emargement.html" class="btn btn-primary btn-lg">📌 Marquer Présence</a>
            <a href="historique.php" class="btn btn-success btn-lg">📜 Voir Historique</a>
            <a href="cours.html" class="btn btn-warning btn-lg">📚 Ajouter un cours</a>
            <a href="deconnexion.php" class="btn btn-danger btn-lg">🚪 Déconnexion</a>
        </div>
    </div>
</body>
</html>