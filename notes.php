<?php
session_start();
if (isset($_POST['logout'])){
    session_destroy();
    header("Location: login.php");
    die();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bilješke</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <style>
        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">Moje bilješke</span>
            <div class="navbar" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php"><u>Početna</u></a>
                    </li>
                </ul>
            </div>
            <form method="post" action="notes.php">
                <button class="btn btn-sm btn-primary" type="submit" name="logout">Odjava</button>
            </form>
        </nav>
    </div>
    <?php
    if (isset($_POST['delete'])) {
        $number = $_POST['delete'];
        $xml = simplexml_load_file('users.xml');
        foreach ($xml->user as $user) {
            if ($user->username == $_SESSION['username']) {
                foreach ($user->notes->note as $note) {
                    if ($note['id'] == $number) {
                        $dom = dom_import_simplexml($note);
                        $dom->parentNode->removeChild($dom);
                        break;
                    }
                }
                $xml->asXML('users.xml');
                break;
            }
        }
        header("Refresh:0");
    }
    ?>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-4">
                <form action="notes.php" method="post" name="notes">
                    <label for="content">Nova bilješka</label>
                    <br />
                    <textarea name="content" id="content" rows="4" cols="50"></textarea>
                    <br /><br />
                    <input name="submit" type="submit" value="Pošalji" />
                </form>
                <?php
                $xml = simplexml_load_file('users.xml');
                $count = 0;
                foreach ($xml->user as $user) {
                    if ($user->username == $_SESSION['username']) {
                        foreach ($user->notes->note as $note) {
                            if (!($note['id'])) {
                                $note->addAttribute('id', $count);
                                $xml->asXML('users.xml');
                            }
                            $count++;
                            echo $note->date, '<br/>';
                            echo $note->content, '<br/>';
                            echo '<form action="notes.php" method="post">';
                            echo '<button class="btn btn-sm btn-danger" type="submit" value="' . $note["id"] . '" name="delete"/>Izbriši</button><br/>';
                            echo '</form>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $content = $_POST['content'];
    if ($content != '') {
        $xml = simplexml_load_file('users.xml');
        foreach ($xml->user as $user) {
            if ($user->username == $_SESSION['username']) {
                $note = $user->notes->addChild('note');
                $note->addChild('date', date("H:i:s, d.m.Y"));
                $note->addChild('content', $content);
                $xml->asXML('users.xml');
            }
        }
    }
    header("Refresh:0");
}
?>