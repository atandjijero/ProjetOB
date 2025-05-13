<?php
session_start();
include 'connexion.php';
if (!isset($_SESSION['id_utilisateur'])) {
    die('<div class="alert alert-danger text-center">Erreur : Vous devez être connecté pour voir votre historique.</div>');
}

$id_enseignant = pg_escape_string($conn, $_SESSION['id_utilisateur']);

if (empty($id_enseignant)) {
    die('<div class="alert alert-warning text-center">Erreur : ID utilisateur vide.</div>');
}

$query = "SELECT * FROM historique WHERE id_enseignant = '$id_enseignant'";
$result = pg_query($conn, $query);

if (!$result) {
    die('<div class="alert alert-danger text-center">Erreur SQL : ' . pg_last_error($conn) . '</div>');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des émargements</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<!-- Barre de navigation Bootstrap -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Gestion Historique</a>
        <button class="btn btn-danger" onclick="window.location.href='deconnexion.php'">Déconnexion</button>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center text-primary">Votre Historique des Émargements</h2>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID Historique</th>
                <th>ID Cours</th>
                <th>Date d'Émargement</th>
                <th>Heures Enseignées</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = pg_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_historique']) ?></td>
                    <td><?= htmlspecialchars($row['id_cours']) ?></td>
                    <td><?= htmlspecialchars($row['date_emargement']) ?></td>
                    <td><?= htmlspecialchars($row['heures_enseignees']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Script Bootstrap pour le responsive design -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>