<?php
session_start();

require_once "database.php";

if (isset($_SESSION['loggedInUser'])) {
    header("Location: GPL_Reserveringen.php");
    exit;
}

if (isset($_POST['submit'])) {
    $gebruiker = mysqli_escape_string($db, $_POST['gebruiker']);
    $wachtwoord = $_POST['wachtwoord'];

    $query = "SELECT * FROM gebruikers WHERE gebruikersnaam = '$gebruiker'";
    $result = mysqli_query($db, $query) or die ('Error: ' . $query);
    $gebruiker = mysqli_fetch_assoc($result);

    $errors = [];
    if ($gebruiker) {
        if (password_verify($wachtwoord, $gebruiker['wachtwoord'])) {
            $_SESSION['loggedInUser'] = [
                'name' => $gebruiker['name'],
                'id' => $gebruiker['id']
            ];

            header("Location: GPL_Reserveringen.php");
            exit;
        } else {
            $errors[] = 'Uw logingegevens zijn onjuist.';
        }
    } else {
        $errors[] = 'Uw logingegevens zijn onjuist.';
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
<main>
<section id="loginsectie">
    <h1>Login</h1>
    <section id="login">
    <?php if (isset($errors) && !empty($errors)) { ?>
        <ul class="errors">
            <?php for ($i = 0; $i < count($errors); $i++) { ?>
                <li><?= $errors[$i]; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <form id="login" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
        <div>
            <label for="gebruiker">Gebruikersnaam</label>
            <input type="text" name="gebruiker" id="gebruiker" value="<?= (isset($gebruiker) ? $gebruiker : ''); ?>"/>
        </div>
        <div>
            <label for="wachtwoord">Wachtwoord</label>
            <input type="password" name="wachtwoord" id="wachtwoord"/>
        </div>
        <div>
            <button type="submit" name="submit" value="Login">Inloggen</button>
        </div>
    </form>
</section>
</section>
</main>
</body>
</html>
