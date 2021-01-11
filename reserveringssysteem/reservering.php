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
<section id="bevestigingSectie">
<?php
$Vergaderruimtes = ['Bolwerk', 'De Zwaan', 'Veerhaven', 'Scrumruimte'];
$tijdsloten = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00'];

require_once "database.php";
/* @var $db */
if (isset($_POST['vergaderDatum'], $_POST['vergaderRuimte'], $_POST["vergaderTijdslot"])) {
    if (in_array($_POST['vergaderRuimte'], $Vergaderruimtes)) {
        if (in_array($_POST['vergaderTijdslot'], $tijdsloten)) {
            $datumTekst = date('d-m-y', strtotime($_POST['vergaderDatum']));
            $vergaderRuimte = $_POST["vergaderRuimte"];
            $vergaderTijd = $_POST["vergaderTijdslot"];

            $query = "INSERT INTO vergaderruimte_reserveringen (vergader_ruimte, vergader_datum, vergader_tijdslot)
              VALUES ('$vergaderRuimte', '$datumTekst', '$vergaderTijd')";
            $result = mysqli_query($db, $query) or die('Error: ' . $query);

            // Connectie afsluiten
            mysqli_close($db);

            echo '<h2>Reservering geplaatst</h2>';
            echo 'Soort reservering: <strong>vergaderruimte</strong> <br>';
            echo 'Gekozen vergaderruimte: ' . $_POST['vergaderRuimte'] . '<br>';
            echo 'Datum: ' . $datumTekst . '<br>';
            echo 'Tijdslot: ' . $vergaderTijd . '<br>';
        }
        else {
            echo '<h2>Reservering niet geplaatst</h2>';
            echo 'Het gekozen tijdslot komt niet overeen met de beschikbare tijdsloten.';
            echo '<a href="index.php"><div id="overzicht">Terug naar het overzicht</div></a>';
        }
    }
    else {
        echo '<h2>Reservering niet geplaatst</h2>';
        echo 'De gekozen vergaderruimte komt niet overeen met de beschikbare vergaderruimtes.';
        echo '<a href="index.php"><div id="overzicht">Terug naar het overzicht</div></a>';
    }
}

else if (isset($_POST['werkDatum'], $_POST["werkTijdslot"])) {
    if (in_array($_POST['werkTijdslot'], $tijdsloten)) {
        $datumTekst = date('d-m-y', strtotime($_POST['werkDatum']));
        $werktijd = $_POST["werkTijdslot"];

        $query = "INSERT INTO werkplek_reserveringen (werkplek_datum, werkplek_tijdslot) 
              VALUES ('$datumTekst', '$werktijd')";
        $result = mysqli_query($db, $query) or die('Error: ' . $query);

        // Connectie afsluiten
        mysqli_close($db);

        echo '<h2>Reservering geplaatst</h2>';
        echo 'Soort reservering: <strong>Werkplek</strong> <br>';
        echo 'Datum: ' . $datumTekst . '<br>';
        echo 'Tijdslot: ' . $werktijd . '<br>';
    }
    else {
        echo '<h2>Reservering niet geplaatst</h2>';
        echo 'Het gekozen tijdslot komt niet overeen met de beschikbare tijdsloten.';
        echo '<a href="index.php"><div id="overzicht">Terug naar het overzicht</div></a>';
    }
}

else if (isset($_POST['parkeerDatum'], $_POST["parkeerTijdslot"])) {
    if (in_array($_POST['parkeerTijdslot'], $tijdsloten)) {
        $datumTekst = date('d-m-y', strtotime($_POST['parkeerDatum']));
        $parkeertijd = $_POST["parkeerTijdslot"];

        $query = "INSERT INTO parkeerplaats_reserveringen (parkeer_datum, parkeer_tijdslot)
              VALUES ('$datumTekst', '$parkeertijd')";
        $result = mysqli_query($db, $query) or die('Error: ' . $query);

        // Connectie afsluiten
        mysqli_close($db);

        echo '<h2>Reservering geplaatst</h2>';
        echo 'Soort reservering: <strong>Parkeerplaats</strong> <br>';
        echo 'Datum: ' . $datumTekst . '<br>';
        echo 'Tijdslot: ' . $parkeertijd . '<br>';
    }
    else {
        echo '<h2>Reservering niet geplaatst</h2>';
        echo 'Het gekozen tijdslot komt niet overeen met de beschikbare tijdsloten.';
        echo '<a href="index.php"><div id="overzicht">Terug naar het overzicht</div></a>';
    }
}

else {
    echo '<h2>Reservering niet geplaatst</h2>';
    echo '<a href="index.php"><div id="overzicht">Terug naar het overzicht</div></a>';
}
?>
</section>
</body>
</html>
