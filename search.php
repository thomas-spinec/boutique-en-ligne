<?php

require_once './inc/class/Product.php';
$product = new Product();

/* $search =  htmlspecialchars($_GET['search']) . "%";

$query = $this->bdd->prepare("SELECT title FROM product WHERE title LIKE :search LIMIT 0,20;");
$query->execute([':search' => $search]);
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$title = "Search : " . htmlspecialchars($_GET['search']); */

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script type="text/javascript" src="inc/js/search.js"></script>

</head>
<body>
    
    <div class="wrapper">
        
        <?php include 'inc/header.php'; ?>

        <main class="container min-vh-100 justify-content-center align-items-center">
            <section class="row ">

                <div class="col-md-6 m-auto">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col text-white">Your search :</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                            // récupérer les résultats de la recherche depuis la méthode searchProducts()
                            $search = $_GET['search'];
                            $results = $product->searchProducts($search);

                            // afficher les résultats dans une liste HTML
                            ?>
                            <tr>
                                <td>
                                    <ul>
                                        <li>
                                            <?php foreach ($results as $result): ?>
                                                <a href="product.php?id=<?= $result['id_product'] ?>"> <?=$result['title'] ?></a>
                                            <?php endforeach; ?>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </section>
        </main>

    </div> <!-- /wrapper -->

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>