<?php
session_start();
if ($_SESSION["role"] != "administrateur") {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Espace administrateur</title>s
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="card text-center">
        <div class="card-header bg-primary text-white">
            <h2>Bienvenue, Administrateur</h2>
        </div>
        <div class="card-body">
            <p class="lead">Gérez facilement votre système !</p>
            <div class="d-grid gap-2 d-md-flex justify-content-center">
                <a href="enseignant.html" class="btn btn-success">Ajouter un Enseignant</a>
                <a href="planing.html" class="btn btn-info">Gérer le Planning</a>
                <a href="exporter.php" class="btn btn-warning">Exporter Présences en PDF</a>
                <a href="afficherEnseignant.php" class="btn btn-danger">Voir les enseignants ajoutés</a>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="deconnexion.php" class="btn btn-dark">Déconnexion</a>
        </div>
    </div>
</div>

</body>
</html>