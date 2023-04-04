<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- CSS -->
    <link rel="stylesheet" href="inc/css/style.css">
    <!-- Fontawesome kit -->
    <script src="https://kit.fontawesome.com/a05ac89949.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- JS -->
    <script src="inc/js/auth.js"></script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</head>

<body>


    <div class="wrapper">

        <?php include 'inc/header.php'; ?>

        <main class="container">

            <h1>Admin</h1>
            <div class="admin">
                <a href="" id="users">
                    <h3>MEMBER MANAGEMENT</h3>
                </a>
                <a href="" id="products">
                    <h3>PRODUCT MANAGEMENT</h3>
                </a>
                <a href="" id="categories">
                    <h3>CATEGORY MANAGEMENT</h3>
                </a>
            </div>
            <section id="display"></section>
            <section id="gestion"></section>

    </div> <!-- /container -->

    </main>

    <div class="push"></div>

    </div> <!-- /wrapper -->

    <?php include 'inc/footer.php'; ?>

    <!-- Bootstrap js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>