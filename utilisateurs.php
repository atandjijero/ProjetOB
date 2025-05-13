<?php
include 'connexion.php'; // Connexion à PostgreSQL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_BCRYPT); // Sécurisation du mot de passe
    $role = $_POST["role"];

    // Vérifier la connexion
    if (!$conn) {
        die("Erreur de connexion : " . pg_last_error());
    }

    // Insérer l'utilisateur
    $query = "INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES ('$nom', '$email', '$mot_de_passe', '$role')";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "Utilisateur ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout : " . pg_last_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 500px; margin-top: 50px; }
        .shadow { background: white; padding: 20px; border-radius: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Ajouter un Utilisateur</h2>
        <form action="utilisateurs.php" method="POST" class="shadow">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Rôle</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="administrateur">Administrateur</option>
                    <option value="enseignant">Enseignant</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Ajouter</button>
        </form>
    </div>
</body>
</html>