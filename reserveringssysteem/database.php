<?php
 $host= "localhost";
 $user= "root";
 $password= "";
 $database= "cle2_reserveringen";
 $db= mysqli_connect($host, $user, $password, $database)or die ("ERROR: " . mysqli_connect_error());