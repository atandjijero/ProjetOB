<?php
include('connexion.php'); // Connexion à PostgreSQL

// Vérifier que l'ID est bien défini et le convertir en entier
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Supprimer les références dans `presence`
    $delete_presence = pg_query($conn, "DELETE FROM presence WHERE id_enseignant = $id");

    if ($delete_presence) {
        // Maintenant, supprimer l'enseignant
        $delete_enseignant = pg_query($conn, "DELETE FROM enseignant WHERE id_enseignant = $id");

        if ($delete_enseignant) {
            header("Location: afficherEnseignant.php?success=1");
            exit();
        } else {
            die("<p class='alert alert-danger text-center'>Erreur lors de la suppression de l'enseignant !</p>");
        }
    } else {
        die("<p class='alert alert-danger text-center'>Erreur lors de la suppression des références dans 'presence' !</p>");
    }
} else {
    die("<p class='alert alert-warning text-center'>ID invalide.</p>");
}
?>