<!-- /**
* Här är du inloggad som gäst
* 
* Du kan handla och betala
*
* @param author Sandra Daubigne miss.daubigne@gmail.com
*/ -->

<!-- Alla headers har include databas/style och session_start. Alla andra sidor har en header -->
<?php
include 'header_inloggad_gast.php';
?>

<!-- Funktion som hämtar värdet på varan och skickar den till varukorgen -->
<script>
function buyThis(id){
window.top.location = 'order.php?productId='+id;
}
</script>

<!-- Inloggad-session -->
 <?php 
    if(isset($_SESSION['u_id'])){
        echo "Du är inloggad!!!!!!!!!!!!";
     ?>
   <?php
    
        //Hämtar användarens namn från inloggningen: 
        $u_id = $_SESSION['u_id'];
        $result = mysqli_query($con,"SELECT * FROM User WHERE userId = '$u_id'");
        $data = mysqli_fetch_array($result);
        $firstname = $data['firstName'];
        $surname = $data['surName'];
        
        echo "Välkommen tillbaka " . ucfirst($firstname) . " " . ucfirst($surname);
   
?> 

<div class="article-container">
        <h2>Produkter</h2>
        <p>Nedan ser du produkter som finns att köpa i webbshoppen</p>
    <?php
        //hämtar produkter från tabellen product /innehåller en Foreign Key!
        //                             hämtar från    tabell genom    annan tabell/ 1:a tabell+rad =2:a tabell+rad  / sorterat efter: 
        $products = mysqli_query($con,"SELECT * FROM color INNER JOIN product ON color.color_Id = product.color_Id ORDER BY color");

        // Hämtar produkterna och skriver ut antal
        echo "Just nu: " .$amount = mysqli_num_rows($products) . " produkter!";
    ?>
        <div class='tblProducts'>
    <?php
            //Loopar ut produkterna
            if($amount > 0){
                while($dataProducts = mysqli_fetch_array($products)){
    ?>
            <div class="rows" onclick="buyThis('<?php echo $dataProducts['productId'] ?>')">
                <div class="cols"><?php echo $dataProducts['productName']?></div>
                <div class="cols"><?php echo $dataProducts['color']?></div>
                <div class="cols"><?php echo $dataProducts['productPrice']?></div>
                <div class="cols"><?php echo $dataProducts['productInfo']?></div>
            </div>
        </div>
        
        
                <?php
            }
        
        }
        ?>
</div>
   <?php                 
 }
