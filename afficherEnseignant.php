<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des Enseignants</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Liste des Enseignants</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Heures Totales</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('connexion.php'); // Connexion à la base de données
                $result = pg_query($conn, "SELECT * FROM enseignant");

                while ($row = pg_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['id_enseignant'] ?></td>
                    <td><?= $row['nom'] ?></td>
                    <td><?= $row['prenom'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['heures_totales'] ?></td>
                    <td>
                        <a href="modifier.php?id=<?= $row['id_enseignant'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer.php?id=<?= $row['id_enseignant'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer vraiment un enseignant ?')">Supprimer</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>