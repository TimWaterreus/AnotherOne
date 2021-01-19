<?php
session_start();

$gebruiker = '';
$wachtwoord = '';

if (isset($_SESSION['loggedInUser'])) {
    header('Location: GPL_Reserveringen.php');
    exit;
}

if (isset($_POST['submit'])) {

    require_once "database.php";
    $gebruiker = mysqli_escape_string($db, $_POST['gebruiker']);
    $wachtwoord = $_POST['wachtwoord'];

    $errors = [];

    if ($gebruiker == '') {
        $errors['gebruiker'] = 'Gebruikersnaam kan niet leeg zijn.';
    }

    if ($wachtwoord == '') {
        $errors['wachtwoord'] = 'Wachtwoord kan niet leeg zijn.';
    }

    if (empty($errors)) {
        $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

        $query = "INSERT INTO gebruikers (gebruikersnaam, wachtwoord) VALUES('$gebruiker', '$wachtwoord')";
        $result = mysqli_query($db, $query) or die('Error: ' . $query);

        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors['db'] = 'Iets is fout gegaan met de database query: ' . mysqli_error($db);
        }

        mysqli_close($db);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Concordia De Keizer reserveringen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <hr>
    <h1>Concordia De Keizer reserveringen</h1>
    <nav>
        <a href="https://www.concordiadekeizer.nl/"><div id="homepagina">Homepagina</div></a>
        <a href="index.php"><div id="overzicht">Overzicht</div></a>
    </nav>
</header>
<section id="registreren">
    <h2>Nieuwe gebruiker registeren</h2>
    <span class="errors"><?= isset($errors['db']) ? $errors['db'] : ''; ?></span>
    <form action="" method="post">
        <div class="data-field">
            <label for="email">Gebruikersnaam</label>
            <input id="gebruiker" type="text" name="gebruiker" value="<?= htmlentities($gebruiker); ?>"/>
            <span class="errors"><?= isset($errors['gebruiker']) ? $errors['gebruiker'] : ''; ?></span>
        </div>
        <div class="data-field">
            <label for="wachtwoord">Wachtwoord</label>
            <input id="wachtwoord" type="password" name="wachtwoord"/>
            <span class="errors"><?= isset($errors['wachtwoord']) ? $errors['wachtwoord'] : ''; ?></span>
        </div>
        <div class="data-submit">
            <input type="submit" name="submit" value="Registeer"/>
        </div>
    </form>
</section>
</body>
</html>
