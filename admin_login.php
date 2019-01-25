<!-- /**
* Hit kommer du när du trycker på submit i logga in som admin
* 
* Denna sida tar emot och validerar dina inskrivna värden. 
Om du är godkänd som admin skickas du här vidare till admin_inloggad.php
*
* @param author Sandra Daubigne miss.daubigne@gmail.com
*/ -->

<!-- Inkluderar headern som databaskopplingen/menyknapparna och stylingen finns i -->
<?php
include 'header.php';
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

<!-- Formulär för att fylla i -->
<h2>Logga in med ditt adminkonto:</h2>

<form action="admin_login.php" method="POST">
<button type="text"><a href="index.php">Hem</a></button>
<input type="text" name="username" placeholder="ange epostadress">
<input type="password" name="password" placeholder="ange lösenord">
<button type="submit" name ="admin_submit"> Logga in!  </button>
</form>

<?php

//Hämtar min egen http adress
$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//Om det är nåt som inte finns i databasen
if(strpos($fullUrl,"login=error") == true){
    echo "<h2>Oj! Nåt gick fel, försök igen!</h2>";
    exit();
}
?>

<!-- Kollar att användarnamn och lösenord finns i databasen -->
<?php
if(isset($_POST['admin_submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql ="SELECT * FROM admin2 WHERE username='$username' AND  password='$password'";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck < 1){
        header("Location: admin_login.php?login=error");
    }else{
        if($row = mysqli_fetch_assoc($result)){
          
         $_SESSION['userId'] = $row['userId'];
         $_SESSION['username'] = $row['username'];
         $_SESSION['password'] = $row['password']; 
        
        header('Location: admin_inloggad.php');  
        }
        }

    }

?>
