<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <style>
        html,
        body {
            height: 100%;
        }

        .error {
            color: #ff0000;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">Login</span>
            <div class="navbar" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php"><u>Početna</u></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-2">
                <form action="login.php" method="post" name="login">
                    <label for="username">Korisničko ime</label>
                    <br />
                    <input name="username" type="text" id="username" />
                    <br />
                    <label for="password">Lozinka</label>
                    <br />
                    <input name="password" type="password" id="password" />
                    <br /><br />
                    <input name="submit" type="submit" value="Pošalji" />
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $("form[name='register']").validate({
                rules: {
                    username: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                },
                messages: {
                    username: {
                        required: "Korisničko ime ne smije biti prazno",
                    },
                    password: {
                        required: "Lozinka ne smije biti prazna",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>

<?php
session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $count = 0;
    if ($password != '') {
        $xml = simplexml_load_file('users.xml');
        foreach ($xml->user as $user) {
            if ($user->username == $username) {
                $count++;
                if (password_verify($password, $user->password)) {
                    echo '<center>Dobrodošli ', $username, '</br><a href="notes.php">Moje bilješke</a></center>';
                    $_SESSION['username'] = $username;
                } else {
                    echo "<center>Pogrešna lozinka</center>";
                }
            }
        }
        if (!($count)) {
            echo "<center>Pogrešno korisničko ime</center>";
        }
    }
}
?>