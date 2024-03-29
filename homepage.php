<?php 
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Početna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
        crossorigin="anonymous"></script>
    <style>
        img {
            width: 35%;
            padding: 10px;
        }

        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">Dobrodošli u qNotes</span>
            <div class="navbar" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php 
                        if (isset($_SESSION['username'])){
                        echo '<a class="nav-link" href="notes.php"><u>Moje bilješke</u></a>';
                    }
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-2">
                    <a href="login.php"><img src="img/login.png" /></a>
                    <a href="register.php"><img src="img/account.png" /></a>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-2">
                    <a href="login.php"><button type="button" class="btn btn-primary">Login</button></a>
                    <a href="register.php"><button type="button" class="btn btn-danger">Register</button></a>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
</body>

</html>