<!-- Inclure la connexion à la base de données -->
<?php include 'connect.php'; ?>
<!-- HTML -->
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voir les produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- En-tête -->
    <?php include 'header.php'; ?>
    <div class="container">
        <section class="display_product">
            <table>
                <thead>
                    <tr class="text-center">
                        <th>N°</th>
                        <th>Image du produit</th>
                        <th>Nom du produit</th>
                        <th>Prix du produit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Code PHP pour afficher les produits dynamiquement -->
                    <?php
                    // Requête pour sélectionner les produits dans la base de données
                    $query = "SELECT * FROM products";

                    // Préparation et exécution de la requête
                    $stmt = $objectPDO->prepare($query);
                    $stmt->execute();

                    // Récupération de tous les produits sous forme de tableau associatif
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Vérifier s'il y a des produits
                    if ($products) {
                        // Parcourir chaque produit et les afficher dans les lignes du tableau
                        foreach ($products as $product) {
                    ?>
                            <tr class="text-center">
                                <td><?php echo $product['id']; ?></td>
                                <td><img src="images/<?php echo $product['image']; ?>" alt="Image du produit" class="img-fluid"></td>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td>
                                    <a href="delete.php?delete=<?php echo $product['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?')"><i class="fa-solid fa-trash-can"></i></a>

                                    <a href="#" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5">Aucun produit trouvé.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>