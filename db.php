<!-- /**
* Databaskoppling. 
* 
* Här kan du byta databas enkelt på ett och samma ställe.
*
* @param author Sandra Daubigne miss.daubigne@gmail.com.
*/ -->

<!-- Databaskopplingen i variabler-->
<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "webbshop2";
$con = mysqli_connect($server, $username,$password,$dbname) or die("Tyvärr kan vi inte hämta databasen just nu.");

mysqli_set_charset($con,"utf8");