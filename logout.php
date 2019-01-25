<!-- /**
* Utloggningen
* 
* Loggar ut dig från sessionen
*
* @param author Sandra Daubigne miss.daubigne@gmail.com
*/ -->
<?php
session_start();
session_destroy();
header('location:index.php');