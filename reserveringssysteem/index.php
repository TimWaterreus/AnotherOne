<?php
$Vergaderruimtes = ['Bolwerk', 'De Zwaan', 'Veerhaven', 'Scrumruimte'];
$tijdsloten = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00'];
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
    <section id="overzichtSectie">
        <h1>Overzicht</h1>
        <section id="vergaderuimte">
            <form action="reservering.php" method="post">
            <div>
                <p>Ik wil een <strong>vergaderruimte</strong> reserveren</p>
                <label for="vergaderRuimte">Vergaderruimte:</label>
                <?php
                echo '<select name="vergaderRuimte" id="vergaderRuimte" required>';
                echo '<option value="" disabled selected>Kies uw vergaderruimte</option>';
                    foreach ($Vergaderruimtes as $option) {
                        echo '<option value="' . $option . '">' . $option . '</option>';
                    }
                echo '</select>';
                ?>
                <label for="vergaderDatum">Datum:</label>
                <input type="date" id="vergaderDatum" name="vergaderDatum" required>
                <label for="vergaderTijdslot">Tijdslot:</label>
                <?php
                echo '<select name="vergaderTijdslot" id="vergaderTijdslot" required>';
                echo '<option value="" disabled selected>Kies uw tijdslot</option>';
                    foreach ($tijdsloten as $option) {
                        echo '<option value="' . $option . '">' . $option . '</option>';
                    }
                echo '</select>';
                ?>
                <a>
                    <button type="submit">Bevestigen</button>
                </a>
            </div>
            </form>
        </section>
            <section id="werkplek">
                <form action="reservering.php" method="post">
            <div>
                <p>Ik wil een <strong>werkplek</strong> reserveren</p>
                <label for="werkDatum">Datum:</label>
                <input type="date" id="werkDatum" name="werkDatum" required>
                <label for="werkTijdslot">Tijdslot:</label>
                <?php
                echo '<select name="werkTijdslot" id="werkTijdslot" required>';
                echo '<option value="" disabled selected>Kies uw tijdslot</option>';
                    foreach ($tijdsloten as $option) {
                        echo '<option value="' . $option . '">' . $option . '</option>';
                    }
                echo '</select>';
                ?>
                <a>
                    <button type="submit">Bevestigen</button>
                </a>
            </div>
                </form>
            </section>
            <section id="parkeren">
                <form action="reservering.php" method="post">
                <div>
                    <p>Ik wil een <strong>parkeerplaats</strong> reserveren</p>
                    <label for="parkeerDatum">Datum:</label>
                    <input type="date" id="parkeerDatum" name="parkeerDatum" required>
                    <label for="parkeerTijdslot">Tijdslot:</label>
                    <?php
                    echo '<select name="parkeerTijdslot" id="parkeerTijdslot" required>';
                    echo '<option value="" disabled selected>Kies uw tijdslot</option>';
                        foreach ($tijdsloten as $option) {
                            echo '<option value="' . $option . '">' . $option . '</option>';
                        }
                    echo '</select>';
                    ?>
                    <a>
                      <button type="submit">Bevestigen</button>
                    </a>
                </div>
                </form>
            </section>
    </section>
</main>

</body>
</html>