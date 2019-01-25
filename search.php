<!-- /**
* Söksidan
* 
* Denna sida söker i databasen webbshop efter produktnamn och produktinfo
*
* @param author Sandra Daubigne miss.daubigne@gmail.com
*/ -->

<!-- Alla headers har include databas/style och session_start. Alla andra sidor har en header -->
<?php
include 'header_default.php';
?>

<h1>Dina sökresultat gav följande träffar: </h1>

<div class="article-container">
<?php
    if(isset($_POST['submit-search'])){
        $search = mysqli_real_escape_string($con, $_POST['search']);
        $sql= "
        SELECT * 
        FROM product 
        WHERE productName LIKE '%$search%' 
        OR productInfo LIKE '%$search%'";

        $result= mysqli_query($con,$sql );
        $queryResult =mysqli_num_rows($result);

        if($queryResult > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<a href ='order.php?productId=".$row['productId']."&productName=".$row['productName']."&productInfo=".$row['productInfo']."&productPrice=".$row['productPrice']."'><div class = 'article-box'>
                    <h3>".$row['productName']."</h3>
                    <p>".$row['productInfo']."</p>
                    <p>".$row['productPrice']."</p>
                </div></a>";
            }
        }else{
         echo  "<h1> Det finns inga matchningar som passar din sökning.Prova med ett annat ord. </h1>";
         header("Locations: inloggad.php?search=error");
        }
    }
?>
</div>
