<?php
session_start();

if(!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    exit;
}

$loggenInUser = $_SESSION['loggedInUser'];
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
        <a href="GPL_Reserveringen.php"><div id="reserveringen">Reserveringen</div></a>
    </nav>
</header>
<main>
    <section id="Geplaatste_Reserveringen">
    <section id="Reserveringen_Vergaderruimtes">
        <h2>Reserveringen vergaderruimtes</h2>
    <table>
        <?php
            require_once "database.php";

            $query = "SELECT * FROM vergaderruimte_reserveringen";
            $result = mysqli_query($db, $query)
                or die('Error: ' . $query);

            $reserveringen_vergaderruimtes = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $reserveringen_vergaderruimtes[] = $row;
            }

        foreach ($reserveringen_vergaderruimtes as $option) {
            echo '<tr><td>ID: ' . $option['id'] . '</td>';
            echo '<td>Vergaderruimte: ' . $option['vergader_ruimte'] . '</td>';
            echo '<td>Datum: ' . $option['vergader_datum'] . '</td>';
            echo '<td>Tijdslot: ' . $option['vergader_tijdslot'] . '</td>';
            echo '<td><a href="deleteVGR.php?id=' . $option['id'] . '">Delete</a></td></tr>';
        }
        ?>
    </table>
</section>
    <section id="Reserveringen_Werkplek">
        <h2>Reserveringen werkplekken</h2>
        <table>
            <?php
                $query = "SELECT * FROM werkplek_reserveringen";
                $result = mysqli_query($db, $query)
                    or die('Error: '. $query);

                $reserveringen_werkplek = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $reserveringen_werkplek[] = $row;
                }

                foreach ($reserveringen_werkplek as $option) {
                    echo '<tr><td>ID: ' . $option['id'] . '</td>';
                    echo '<td>Datum: ' . $option['werkplek_datum'] . '</td>';
                    echo '<td>Tijdslot: ' . $option['werkplek_tijdslot'] . '</td>';
                    echo '<td><a href="deleteWPR.php?id=' . $option['id'] . '">Delete</a></td></tr>';
            }
            ?>
        </table>
    </section>
    <section id="Reserveringen_Parkeerplaats">
        <h2>Reserveringen parkeerplaatsen</h2>
        <table>
            <?php
                $query = "SELECT * FROM parkeerplaats_reserveringen";
                $result = mysqli_query($db, $query)
                    or die('Error: '. $query);

                $reserveringen_parkeerplaats = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $reserveringen_parkeerplaats[] = $row;
                }

                foreach ($reserveringen_parkeerplaats as $option) {
                    echo '<tr><td>ID: ' . $option['id'] . '</td>';
                    echo '<td>Datum: ' . $option['parkeer_datum'] . '</td>';
                    echo '<td>Tijdslot: ' . $option['parkeer_tijdslot'] . '</td>';
                    echo '<td><a href="deletePPR.php?id=' . $option['id'] . '">Delete</a></td></tr>';
                }

                mysqli_close($db);
            ?>
        </table>
    </section>
    </section>
</main>
</body>
</html>
