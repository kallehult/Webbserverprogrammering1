<!-- /**
* Kvittosidan
* 
* DBetalningen valideras och en bekräftelse skrivs ut
*
* @param author Sandra Daubigne miss.daubigne@gmail.com
*/ -->

<!-- Alla headers har include databas/style och session_start. Alla andra sidor har en header -->
<?php
include 'header_default.php';
?>

<?php

// Om användaren valt kort valideras de inkommande uppgifterna här:
if($_SESSION['payment'] == 'card')
{
    $cardnumber =mysqli_real_escape_string($con, $_POST['cardnumber']);
    $month=mysqli_real_escape_string($con, $_POST['month']);
    $year =mysqli_real_escape_string($con, $_POST['year']);
    $cvc =mysqli_real_escape_string($con, $_POST['cvc']);
    $cardholder =mysqli_real_escape_string($con, $_POST['cardholder']);

   

    // kollar så att inget är tomt
    if(empty($cardnumber) || empty($month) || empty($year) || empty($cvc) || empty($cardholder)) 
    {header("Location: payment.php?amount=1&payment=card&submit=empty"); 

        //Om det inte är tomt så kollar att det är 16 tecken i kortnummret:
    }else if(strlen($cardnumber) != '16'){ 
    header("Location: payment.php?amount=1&payment=card&submit=card_number_error");   
    }else if(strlen($cvc) != '3'){ 
    header("Location: payment.php?amount=1&payment=card&submit=cvc_number_error");   
                           


}else{
                            //om inga fel skriv ut kvitto samt spara till databasen
                            //sparar till db
                            $productId = $_SESSION['productID'];
                            $userId = $_SESSION['u_id'];
                            $amount = $_SESSION['amount'];
                            $orderDate = date("Y-m-d H:i:s");
                            $sql = "INSERT INTO productuser (userId, productId, amount, orderDate)
                            VALUES ('$userId','$productId','$amount','$orderDate')";
                            mysqli_query($con, $sql);


                            //hämta produktinfo
                            $result = mysqli_query($con,"SELECT productName, productPrice FROM product WHERE productId = $productId");
                            $data = mysqli_fetch_array($result);
                            echo "Tack för din beställning av " . $data['productName'];
                            
                            //räkna ut pris och skriv ut
                            $total = $_SESSION['amount'] * $data['productPrice'];
                            echo "<br />Total kostnad: " . $total . " kr inkl. moms";
                            echo "<br/>Ovanstående belopp har dragits från ditt kort";
                              
                            //Hämtar användarens namn och adress från inloggningen:                       
                                    $u_id = $_SESSION['u_id'];
                                    $result = mysqli_query($con,"SELECT * FROM User WHERE userId = '$u_id'");
                                    $data = mysqli_fetch_array($result);
                                    $firstname = $data['firstName'];
                                    $surname = $data['surName'];
                                    $adress = $data['adress'];
                                    $postnr = $data['postnr'];
                                    $ort = $data['ort'];
                                    
                                    echo "</br>Din beställning kommer att skickas till " 
                                    .ucfirst($firstname). " " 
                                    .ucfirst($surname).  " "   
                                    .ucfirst($adress). " " 
                                    .ucfirst($postnr).  " "         
                                    .ucfirst($ort);    
                                                                            exit();
}                          
}else{
        //Om användaren valt faktura:
    $persnr =mysqli_real_escape_string($con, $_POST['persnr']);
        //Kollar så att det inte är tomt: 
    if(empty($persnr))
    {header("Location: payment.php?amount=1&payment=invoice&submit=empty_persnr");
        //Om det inte är tomt, kollar så att personnummer har 10 siffor
    }else if(strlen($persnr) != '10'){
            header("Location: payment.php?amount=1&payment=invoice&submit=persnr_error");
            }else{ 
                            //sparar till db
                            $productId = $_SESSION['productID'];
                            $userId = $_SESSION['u_id'];
                            $amount = $_SESSION['amount'];
                            $orderDate = date("Y-m-d H:i:s");
                            $sql = "INSERT INTO productuser (userId, productId, amount, orderDate)
                            VALUES ('$userId','$productId','$amount','$orderDate')";
                            mysqli_query($con, $sql);

                                //hämta produktinfo
                            $result = mysqli_query($con,"SELECT productName, productPrice FROM product WHERE productId = $productId");
                            $data = mysqli_fetch_array($result);
                            echo "Tack för din beställning av " . $data['productName'];
                            
                            //räkna ut pris och skriv ut
                            $total = $_SESSION['amount'] * $data['productPrice'];
                            echo "<br />Total kostnad: " . $total . " kr inkl. moms";
                            echo "<br/>Ovanstående belopp har dragits från ditt kort";
                                      
                            //Skriver ut adressen: 
                                    $u_id = $_SESSION['u_id'];
                                    $result = mysqli_query($con,"SELECT * FROM User WHERE userId = '$u_id'");
                                    $data = mysqli_fetch_array($result);
                                    $firstname = $data['firstName'];
                                    $surname = $data['surName'];
                                    $adress = $data['adress'];
                                    $postnr = $data['postnr'];
                                    $ort = $data['ort'];
                                    
                                    echo "</br>Din beställning kommer att skickas till " 
                                    .ucfirst($firstname). " " 
                                    .ucfirst($surname).  " "   
                                    .ucfirst($adress). " " 
                                    .ucfirst($postnr).  " "         
                                    .ucfirst($ort);    
                           
                            }
                    }
         
    


