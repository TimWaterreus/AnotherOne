<?php
require_once "database.php";

$query = "DELETE FROM werkplek_reserveringen WHERE id = " . mysqli_escape_string($db, $_GET['id']);
mysqli_query($db, $query) or die ('Error: ' . mysqli_error($db));

mysqli_close($db);

header("location:GPL_Reserveringen.php");
exit;
