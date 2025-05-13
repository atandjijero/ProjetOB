<?php
include 'connexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];
    $confirmer_mot_de_passe = $_POST["confirmer_mot_de_passe"]; // Définition de la variable
    $role = $_POST["role"];
    if ($mot_de_passe !== $confirmer_mot_de_passe) {
        die("Les mots de passe ne correspondent pas.");
    }
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_BCRYPT);
    $query = "INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES ('$nom', '$email', '$mot_de_passe_hash', '$role')";
    $result = pg_query($conn, $query);

    if ($result) {
        echo '<div class="container mt-5">
        <div class="alert alert-success text-center">
            <h4>Votre compte a été créé avec succès !</h4>
            <p><a href="login.html" class="btn btn-primary">Connectez-vous alors !</a></p>
        </div>
      </div>';
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
        <h2 class="text-center">Inscrivez-vous! Enseignant ou Administrateur</h2>
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
                <label for="confirmer_mot_de_passe" class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="confirmer_mot_de_passe" name="confirmer_mot_de_passe" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Rôle</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="administrateur">Administrateur</option>
                    <option value="enseignant">Enseignant</option>
                </select>
            </div>
<button type="submit" class="btn btn-primary w-100">S'inscrire</button>

<div class="container mt-5">
    <div class="alert alert-light border rounded-3 text-center shadow-sm p-4">
        <h5 class="fw-bold text-secondary">Déjà inscrit ?</h5>
        <p class="text-muted">Accédez à votre espace en toute simplicité.</p>
        <a href="login.html" class="btn btn-success btn-lg mt-2">Connectez-vous maintenant !</a>
    </div>
</div>
        </form>
    </div>
</body>
</html>