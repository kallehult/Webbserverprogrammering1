<!-- /**
* Registreringssidan
* 
* Registreringsformuläret och dess felmeddelanden finns här-
Om inga fel hittas skickas du till valideringen
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
<h2>Fyll i nedanstående fält, fält med * är obligatoriska</h2>
<h3>Ditt lösenord behöver vara 10 tecken långt</h3>

<form action="validate_signup.php" method="post">
Förnamn*: <input type="text" name="firstname" placeholder="Fyll i ditt förnamn"><br/>
Efternamn*: <input type="text" name="surname" placeholder="Fyll i ditt efternamn"><br/>
Email*: <input type="text" name="email" placeholder="Fyll i din email"><br/>
Adress*: <input type="text" name="adress" placeholder="Fyll i ditt adress"><br/>
Postnr*: <input type="text" name="postnr" placeholder="Fyll i ditt postnummer"><br/>
Ort*: <input type="text" name="ort" placeholder="Fyll i din ort"><br/>
Lösenord*: <input type="password" name="Psw" placeholder="Fyll i ditt lösenord"><br/>
<input type="submit" name="submit" value ="Skapa mitt konto nu!">
</form>


<?php

//Hämtar min egen http adress
$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//Om denna adressen dyker upp (fel i validate_sign_up) så skrivs detta ut: 
if(strpos($fullUrl,"signup=empty") == true){
    echo "<h2>Du fyllde inte i alla fält. <br> Du har inte blivit registrerad, fyll i dina uppgifter igen!!</h2>";
    exit();
}

else if(strpos($fullUrl,"signup=invalid") == true){
    echo "<h2> Ditt för och efternamn får bara innehålla bokstäverna a-ö. <br> Du har inte blivit registrerad, fyll i dina uppgifter igen!</h2>";
    exit();
}
else if(strpos($fullUrl,"signup=email") == true){
    echo "<h2>Din email adress känns inte igen som en email.<br> Du har inte blivit registrerad, fyll i dina uppgifter igen!</h2>";
    exit();
}
else if(strpos($fullUrl,"signup=sucess") == true){
    echo "<h2>Välkommen <br> Du är registrerad! <br> Logga in för att handla</h2>";
    exit();
}
else if(strpos($fullUrl,"signup=postnr") == true){
    echo "<h2>Fel postnummer <br> Postnummret behöver ha 5 siffror. </h2>";
    exit();
}
else if(strpos($fullUrl,"signup=pass") == true){
    echo "<h2>Ditt lösenord behöver ha 10 tecken, var god försök igen. </h2>";
    exit();
}







?>
