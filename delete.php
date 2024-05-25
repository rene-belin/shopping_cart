<?php
include 'connect.php';
session_start();  // Démarrer la session

if (isset($_GET['delete'])) {
    // Récupération de l'ID à supprimer en utilisant une méthode sécurisée
    $delete_id = intval($_GET['delete']);

    try {
        // Préparation de la requête DELETE
        $delete_query = $objectPDO->prepare("DELETE FROM products WHERE id = :id");
        $delete_query->bindParam(':id', $delete_id, PDO::PARAM_INT);

        // Exécution de la requête
        if ($delete_query->execute()) {
            $_SESSION['message'] = "Le produit à été supprimé avec succès.";
        } else {
            $_SESSION['message'] = "Échec de la suppression du produit.";
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Erreur lors de la suppression : " . $e->getMessage();
    }

    // Redirection après suppression
    header('Location: view_product.php');
    exit();
}
?>
