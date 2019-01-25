<!-- /**
* Validerar registrering
* 
* Validerar inkommande värde från signup.php
*
* @param author Sandra Daubigne miss.daubigne@gmail.com
*/ -->

<!-- //Denna sida har ingen header, den är ingen synlig sida -->
<?php
include 'db.php';

if(isset($_POST['submit'])){
   

    // mysqli_real_escape_string = så att inget skadligt kommer in i databasen. 
    $firstname =mysqli_real_escape_string($con, $_POST['firstname']);
    $postnr =mysqli_real_escape_string($con, $_POST['postnr']);
    $adress =mysqli_real_escape_string($con, $_POST['adress']);
    $ort =mysqli_real_escape_string($con, $_POST['ort']);
    $surname =mysqli_real_escape_string($con, $_POST['surname']);
    $email =mysqli_real_escape_string($con, $_POST['email']);
    $Psw =mysqli_real_escape_string($con, $_POST['Psw']);
  
    //Kollar så att inget är tomt..
    if(empty($firstname) || empty($surname) || empty($email) || empty($ort) || empty($postnr)|| empty($adress)|| empty($Psw)){
       header("Location: signup.php?signup=empty");   
    //är det inte tomt så kollar den att postnummer är 5 tecken
    }else if(strlen($postnr) != '5'){ 
        header("Location: signup.php?signup=postnr");  
        //Och om lösenordet är 10 tecken
    }else if(strlen($Psw) != '10'){
        header("Location: signup.php?signup=pass");  
     
    }else{
      //Kollar att inget annat förutom bokstäver är i namnen
        if(!preg_match("/^[a-öA-Ö]*$/", $firstname) || !preg_match("/^[a-öA-Ö]*$/", $lastname)){
            header("Location: signup.php?signup=invalid");
                exit();  
        }else{
         //Kollar så att emailen ser ut som en emailadress
            if(filter_var($email, FILTER_VALIDATE-EMAIL)){
                header("Location: signup.php?signup=email");
                exit();   
            }else{ //Kollar om emailen redan finns i databasen: 
                $sql = "SELECT * FROM user WHERE email='$email";
                $result = mysqli_query($con, $sql);
                $resultCheck = mysqli_num_rows($result);
                //Ifall det redan finns en användare ...
                if($resultCheck > 0){
                    header("Location: signup.php?signup=usertaken");
                    exit();  

                }else{
                    //Krypterar lösenordet med hash
                    $hashedPsw = password_hash(Psw, PASSWORD_DEFAULT);
                    //Registrerar
                    $sql ="INSERT INTO user (firstName, surName, email, pass, adress, postnr, ort) VALUES ('$firstname' , '$surname' , '$email' , '$hashedPsw' , '$adress' , '$postnr' , '$ort');";
                    mysqli_query($con, $sql);    
                    header("Location: signup.php?signup=sucess");  
                     
                    exit();             
                
                }
            }
        }
    }

}else{
    header("Location: 'signup.php");

    exit();
}




