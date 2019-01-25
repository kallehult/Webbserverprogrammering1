<!-- /**
* Validerar Login
* 
* Validerar inkommande värde från login.php
*
* @param author Sandra Daubigne miss.daubigne@gmail.com
*/ -->

<!-- //Denna sida har ingen header, den är ingen synlig sida -->
<?php
include 'db.php';
session_start();

if(isset($_POST['submit'])){

    $Psw = mysqli_real_escape_string($con, $_POST['Psw']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    //Kollar så att allt är ifyllt
    if(empty($email) || empty($Psw))
    {
        //Om det inte är det så sys detta
        header("Location: login.php?login=empty");
        exit();   

    }else{//Annars sker sökningen efter email
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1){
            header("Location: login.php?login=error_select");
            exit();  
        }else{ //Hittas den så söker den efter lösenord
            if($row = mysqli_fetch_assoc($result)){
                //Av-krypterar lösenordet
                $hashedPwdCheck = password_verify(Psw, $row['pass']);
                if($hashedPwdCheck  == false){
                    header("Location: login.php?login=error_pass");
                    exit(); 
                }elseif($hashedPwdCheck  == true){
                    //Låser in användaren i en session om allt är godkänt
                    $_SESSION['u_id']  =$row['userId'];
                    $_SESSION['u_first']  =$row['firstName'];
                    $_SESSION['u_last']  =$row['surName'];
                    $_SESSION['u_email']  =$row['email'];
                    $_SESSION['u_pass']  =$row['pass'];
                    header("Location: inloggad.php?login=success");
                    exit(); 

                }

            }
        }

    }
    

    }else
    {
        header("Location: inloggad.php?login=error");
        exit();
    }        
?>