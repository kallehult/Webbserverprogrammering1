<!-- /**
* Hör till Admin - 
* 
* Hämtar värden från formulären i admin_inloggning och validerar uppdate/delete/Insert
*
* @param author Sandra Daubigne miss.daubigne@gmail.com
*/ -->

<!-- Denna sida har ingen header då det inte är en synlig sida.-->
<?php
include 'db.php';


// Uppdaterar lagret
if(isset($_POST['uppdatera'])){

    $Id = mysqli_real_escape_string($con, $_POST['Id']);
    $Plagg = mysqli_real_escape_string($con, $_POST['Plagg']);
    $Storlek = mysqli_real_escape_string($con, $_POST['Storlek']);
    $Antal = mysqli_real_escape_string($con, $_POST['Antal']);
    
    //Ställer fråga om uppdatering till databasen
    $sql="UPDATE lager SET 
    Plagg='$_POST[Plagg]', 
    Storlek='$_POST[Storlek]',
    Antal = '$_POST[Antal]'
    WHERE Id ='$_POST[Id]'";
    
    if(mysqli_query($con, $sql)){
        header("Location: admin_inloggad.php?skickat=success");
    }else{
        header("Location: admin_inloggad.php?skickat=error");    
    }


}

// Tar bort i lagret
if(isset($_POST['delete'])){

$Id = mysqli_real_escape_string($con, $_POST['Id']);
 
$sql = "DELETE FROM lager    
        WHERE Id =$Id";
    
    if(mysqli_query($con, $sql)){
        header("Location: admin_inloggad.php?delete=success");
    }else{
        header("Location: admin_inloggad.php?delete=error");    
    }

}

// Lägger till i lagret
if(isset($_POST['insert'])){
    $Plagg = mysqli_real_escape_string($con, $_POST['Plagg']);
    $Storlek = mysqli_real_escape_string($con, $_POST['Storlek']);
    $Antal = mysqli_real_escape_string($con, $_POST['Antal']);

    //Kollar så att inget är tomt..
    if(empty($Plagg) || empty($Storlek) || empty($Antal)){
        header("Location: admin_inloggad.php?insert=empty");  
    }else{

            $sql ="INSERT INTO lager (Plagg, Storlek, Antal ) VALUES ('$Plagg' , '$Storlek' , '$Antal')";  
            if(mysqli_query($con, $sql)){
            header("Location: admin_inloggad.php?insert=success");
            }else{
            header("Location: admin_inloggad.php?insert=error");    
    }

    } 
  


}


?>




