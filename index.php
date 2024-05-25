<?php
include "connect.php";

if (isset($_POST["add_product"])) {
    // Récupération des données du formulaire
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_image = $_FILES["product_image"]["name"];
    $product_image_tmp = $_FILES["product_image"]["tmp_name"];
    $product_image_folder = "images/" . $product_image;

    // Préparation de la requête d'insertion
    $stmt = $objectPDO->prepare("INSERT INTO products (name, price, image) VALUES (:name, :price, :image)");

    // Lier les valeurs
    $stmt->bindParam(':name', $product_name);
    $stmt->bindParam(':price', $product_price);
    $stmt->bindParam(':image', $product_image);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Si l'insertion a réussi, déplacer le fichier image vers le dossier spécifié
        if (move_uploaded_file($product_image_tmp, $product_image_folder)) {
            $display_message = 'Produit ajouté avec succès.';
        } else {
            $display_message = "Erreur lors du déplacement de l'image.";
        }
    } else {
        // Affichage des informations d'erreur
        print_r($stmt->errorInfo());
    }
}
?>
<!-- HTML -->
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- include header-->
    <?php include 'header.php' ?>

    <!-- form section-->
    <div class="container">
        <!-- message display -->
        <?php
        if (isset($display_message)) {
            echo "<div class='display_message'>
            <span>$display_message</span>
            <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
        </div>";
        }
        ?>

        <section>
            <h3>Ajouter des produits</h3>
            <form action="" class="add_product" method="post" enctype="multipart/form-data">
                <input type="text" name="product_name" placeholder="Entrez le nom du produit" class="input_fields" required>
                <input type="number" name="product_price" min="0" placeholder="Entrez le prix du produit" class="input_fields" required>
                <input type="file" name="product_image" class="input_fields" required accept="image/png, image/jpg, image/jpeg">
                <input type="submit" name="add_product" class="submit_btn" value="Ajoutez un produit" required>
            </form>
        </section>
    </div>

    <!-- script-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>