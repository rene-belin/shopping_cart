<!-- En-tête -->

<!-- PHP code -->
<?php
include 'connect.php';


if (isset($_GET['delete'])) {
    // Récupération de l'ID à supprimer en utilisant une méthode sécurisée
    $delete_id = intval($_GET['delete']);

    try {
        // Préparation de la requête DELETE
        $delete_query = $objectPDO->prepare("DELETE FROM products WHERE id = :id");
        $delete_query->bindParam(':id', $delete_id, PDO::PARAM_INT);

        // Exécution de la requête
        if ($delete_query->execute()) {
            $_SESSION['message'] = "Produit supprimé avec succès.";

            // Redirection après suppression réussie
            header('Location: view_product.php');
            exit();
        } else {
            // Message d'erreur si la suppression échoue
            $_SESSION["message"] = "echec dela suppression du produit.";
            header('Location: view_product.php');
            exit();
        }
    } catch (PDOException $e) {
        // Affichage du message d'erreur en cas d'exception
        $_SESSION["message"] = "Erreur lors de la suppression : " . $e->getMessage();
        header('Location: view_product.php');
        exit();
    }
}
?>