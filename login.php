<!-- /**
* Loginsida
* 
* Innehåller formuläret och felmeddelanden från valideringen
*
* @param author Sandra Daubigne miss.daubigne@gmail.com
*/ -->

<!-- Alla headers har include databas/style och session_start. Alla andra sidor har en header -->
<?php
include 'header_hem.php';
?>
<style>
    
    input{
        padding: 0px 20px;
        width: 300px;
        height: 40px;
        font-size: 22px;
    }
    
    button{
        width:200px;
        height: 44px;
        font-size: 20px;
          
    }
    </style>
<h2>Logga in med ditt användarkonto:</h2>
<form action="validate_login.php" method="post">
<input type="text" name="email" placeholder="ange epostadress">
<input type="password" name="Psw" placeholder="ange lösenord">
<button type="submit" name ="submit"> Logga in!  </button>
</form>


<?php
//Hämtar min egen http adress
$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//Om denna adressen dyker upp (fel i validate_sign_up) så skrivs detta ut: 
if(strpos($fullUrl,"login=empty") == true){
    echo "<h2>Du fyllde inte i alla fält. <br> Fyll i dina uppgifter igen!</h2>";
    exit();
}

else if(strpos($fullUrl,"login=error_select") == true){
    echo "<h2> Din email verkar inte finnas.</h2>";
    exit();
}
else if(strpos($fullUrl,"login=error_pass") == true){
    echo "<h2> Ditt lösenord är fel, var god försök igen </h2>";
    exit();
}
else if(strpos($fullUrl,"login=success") == true){
    echo "<h2>Välkommen! <br> Du är nu inloggad!</h2>";
    exit();
}


?>
