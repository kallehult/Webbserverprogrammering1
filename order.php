<!-- /**
* När du har valt en vara hamnar den här
* 
* HÄr väljer du antal och betalsätt
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
        width: 150px;
        height: 40px;
        font-size: 22px;
    }
    
    button{
        width:100px;
        height: 44px;
        font-size: 20px;
          
    }
   
    </style>

<br>
<h2>Steg 2</h2>
<p>Fyll i antal produkter samt välj betalningssätt!</p>

<?php

//hämtar produkt att köpa
if(isset($_GET['productId']) && $_GET['productId'] != '')
{
    $productId = $_GET['productId'];
    $_SESSION['productID'] = $productId; //sparar till senare användning 
    
    //hämta produktinfo
    
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result = mysqli_query($con,"SELECT productName,productPrice FROM product WHERE productId = $productId");
    $data = mysqli_fetch_array($result);
    echo "Kul att du har beställt " . $data['productName'] . "(".$data['productPrice']." kr/st)";
    
?>
   <!-- Formulär som skickar dig vidare till valt betalsätt  -->
<form method="GET" action="payment.php">
    Ange antal produkter:   
    <input type="number" name="amount" placeholder="ange antal"> <br />
    <br>
    <br>
     Ange betalningssätt:  
     Kort <input type="radio" name="payment" value="card"> 
     Faktura <input type="radio" name="payment" value="invoice">
     <br /><button type="submit" name="submit">Beställ</button>
</form>

<?php
}

//Om det inte är ifyllt så kommer detta upp: 

    //Hämtar min egen http adress
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if(strpos($fullUrl,"order.php?productId=1") == true){
        echo "<h2> Du behöver fylla i alla fält! <br> Prova igen!</h2>";
        exit();
    }


