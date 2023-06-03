<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password == $password2 && $password != '') {
        $xml = simplexml_load_file('users.xml');
        $count = 0;
        foreach ($xml->user as $user) {
            if ($user->username == $username) {
                $count++;
            }
        }
        if (!($count)) {
            $hashed_password = password_hash($password, CRYPT_BLOWFISH);
            $user = $xml->addChild('user');
            $user->addChild('username', $username);
            $user->addChild('password', $hashed_password);
            $notes = $user->addChild('notes');
            $notes->addChild('note', ' ');
            $xml->asXML('users.xml');
            echo "Kreiran novi korisnik";
        } else {
            echo "Korisničko ime se već koristi";
        }
    } else {
        echo "Lozinke se ne podudaraju ili nisu upisane";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <meta charset="utf-8" />
</head>

<body>

    <form action="register.php" method="post">
        <label for="username">Korisničko ime</label>
        <br />
        <input name="username" type="text" />
        <br />
        <label for="password">Lozinka</label>
        <br />
        <input name="password" type="password" />
        <br />
        <label for="password2">Ponovi lozinku</label>
        <br />
        <input name="password2" type="password" />
        <br />
        <input name="submit" type="submit" value="Pošalji" />
    </form>

</body>

</html>