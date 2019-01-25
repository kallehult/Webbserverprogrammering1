<!-- /**
* Betalsidan
* 
* Alla formulär och felmeddelanden till dessa finns
*
* @param author Sandra Daubigne miss.daubigne@gmail.com
*/ -->

<!-- Alla headers har include databas/style och session_start. Alla andra sidor har en header -->

<?php
include 'header_default.php';
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

<?php



//hämtar produkt att köpa
if(isset($_GET['amount']) && $_GET['amount'] != '' && isset($_GET['payment']) && $_GET['payment'] != '')
{
    $amount = $_GET['amount'];
    $_SESSION['amount'] = $amount; //sparar till senare användning 

    $payment = $_GET['payment'];
    $_SESSION['payment'] = $payment; //sparar till senare användning

   


    if($payment == 'card')
    {
?>
            <h2>Steg 3</h2>
            <p>Fyll i nödvändiga uppgifter!</p>


        <form action="reciept.php" method="POST">
                Kortnr: <input type="text" name="cardnumber" placeholder="Fyll i kortnr 16 siffror"><br><br>
                utgångsdatum: <br><br>
                Månad: <input type="number" name="month" min="01" max="12" step="1" value="01"><br><br>
                År: <input type="number" name="year" min="1900" max="2099" step="1" value="2016"><br><br>
                CVC-kod <input type="text" name="cvc" placeholder="CVC 3 siffror"><br><br>
                Kortinnehavare: <input type="text" name="cardholder" placeholder="Kortinnehavare"><br><br>
                <input type="submit" name="submit" value="BETALA">
        </form>
<?php

                            //Hämtar min egen http adress
                            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                            if(strpos($fullUrl,"amount=1&payment=card&submit=empty") == true){
                                echo "<h2> Du behöver fylla i alla fält! <br> Prova igen!</h2>";
                                exit();
                            }
                            else if(strpos($fullUrl,"amount=1&payment=card&submit=card_number_error") == true){
                                echo "<h2>Ditt kortnummer behöver vara 16 tecken långt</h2>";
                                exit();
                            }
                            else if(strpos($fullUrl,"amount=1&payment=card&submit=no_database") == true){
                                echo "<h2>Kunde inte koppla dig till databasen</h2>";
                                exit();
                            
                            }
                            else if(strpos($fullUrl,"amount=1&payment=card&submit=cvc_number_error") == true){
                                echo "<h2>Ditt CVC nummer behöver vara 3 tecken långt.</h2>";
                                exit();
                            
                            }

                            
                            
}else if($payment == 'invoice'){

?>
        <h2>Steg 3</h2>
            <p>Fyll i ditt personnummer med 10 siffor!</p>

        <form action="reciept.php" method="POST">
                Personnummer: <input type="text" name="persnr" placeholder="Personnummer"><br />
                <input type="submit" name="submit" value="SKICKA">
        </form>

<?php


                //Hämtar min egen http adress
                $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                if(strpos($fullUrl,"amount=1&payment=invoice&submit=empty_persnr") == true){
                    echo "<h2> Du behöver fylla i alla fält! <br> Prova igen!</h2>";
                
                }else if (strpos($fullUrl,"amount=1&payment=invoice&submit=persnr_error") == true){
                    echo "<h2>Ditt personnummer behöver vara 10 tecken långt</h2>";
                    exit();
                }


    }
   
}else{
    header("Location: order.php?productId=1 ");
}
