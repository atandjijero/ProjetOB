<?php
include('connexion.php'); // Connexion à la base de données

$id = $_GET['id']; 
$query = pg_query($conn, "SELECT * FROM enseignant WHERE id_enseignant = '$id'");
$row = pg_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $heures_totales = $_POST['heures_totales'];

    pg_query($conn, "UPDATE enseignant SET nom='$nom', prenom='$prenom', email='$email', heures_totales='$heures_totales' WHERE id_enseignant='$id'");
    
    header("Location: afficherEnseignant.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier Enseignant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Modifier Enseignant</h2>
    <form method="POST" class="shadow p-4 bg-light rounded">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" value="<?= $row['nom'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" value="<?= $row['prenom'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="<?= $row['email'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Heures Totales</label>
            <input type="number" name="heures_totales" value="<?= $row['heures_totales'] ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="afficherEnseignant.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>