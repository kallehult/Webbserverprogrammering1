KALLE: Vi vill undvika att blanda in flera lager i samma fil. Här kan du fundera över ifall det går att dela upp så att 
buisiness locig ligger i ett eget lager, och view logic i ett annat. Alltså, att rita upp en html för sig, att hämta data för sig, 
och att style ligger för sig. 




<!-- /**
* Hitt kommer admin när de har loggat in
* 
* Här kan du uppdatera lagret.
*
* @param author Sandra Daubigne miss.daubigne@gmail.com
*/ -->


<!-- Inkluderar headern som databaskopplingen/menyknapparna och stylingen finns i -->
<?php
include 'header_admin.php';
?>
<style>
input{
    padding: 0px 20px;
    width: 200px;
    height: 40px;
    font-size: 22px;
}

</style>

<?php
        // Loggar in admin
       if(isset($_SESSION['username'])){
           
       echo "<h2>Välkommen! Du är inloggad som Admin!</h2>";


// Hämtar tabell lager från databas webbshop
$sql= "SELECT * FROM lager";
$lager = mysqli_query($con, $sql);

// Skapar en tabell till lagret samt hämtar varorna i en while loop
?>    
<table>
<tr>
<th>Plagg</th>
<th>Storlek</th>
<th>Antal</th>
</tr>
<?php
while($row = mysqli_fetch_array($lager)){
    echo"<tr><form action=uppdatera.php method=post>";
    echo"<td><input type=text name=Plagg value='".$row['Plagg']."'</td>";
    echo"<td><input type=text name=Storlek value='".$row['Storlek']."'</td>";
    echo"<td><input type=text name=Antal value='".$row['Antal']."'</td>";
    echo"<input type=hidden name=Id value='".$row['Id']."'</td>";
    echo"<td><input type=submit name=uppdatera value=Uppdatera></td>";
    echo"<td><input type=submit name=delete value=Delete></td>";
    echo"</form></tr>";
}
?>
</table>


<h2>Lägg till en ny storlek: </h2>
<!-- Infogar ny storlek -->
    <table>
            <tr>
            <th>Plagg</th>
            <th>Storlek</th>
            <th>Antal</th>
            </tr>
          
            <tr><form action="uppdatera.php" method="post">
                <td><input type=text name=Plagg ></td>
                <td><input type=text name=Storlek ></td>
                <td><input type=text name=Antal></td>
                <td><input type=submit name=insert value="Skicka in"></td>
            </form></tr>
    </table>
<?php

         
            //Hämtar min egen http adress
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            //Rätt-meddelande: 
            if(strpos($fullUrl,"skickat=success") == true){
            echo "<h2>Dina ändringar har gjorts!</h2>";
            exit();
            }//Fel-meddelande:
            else if(strpos($fullUrl,"skickat=error") == true){
            echo "<h2> Din data har inte skickats!</h2>";
            exit();
            }//Rätt-meddelande: 
            else if(strpos($fullUrl,"delete=success") == true){
            echo "<h2> Din data har tagits bort!</h2>";
            exit();
            }//Fel-meddelande:
            else if(strpos($fullUrl,"delete=error") == true){
            echo "<h2> Det gick inte att ta bort detta!</h2>";
            exit();
            }//Fel-meddelande:
            else if(strpos($fullUrl,"insert=empty") == true){
            echo "<h2>Du har inte fyllt i alla fält! <br> Din data har inte skickats. <br> Var god försök igen.</h2>";
            exit();
            }//Rätt-meddelande: 
            else if(strpos($fullUrl,"insert=success") == true){
            echo "<h2> Din data har skickats!</h2>";
            exit();
            }//Fel-meddelande:
            else if(strpos($fullUrl,"insert=error") == true){
            echo "<h2> Din data har inte!</h2>";
            exit();
            }

//Om admin inte är inloggad men ändå går in på sidan genom url.
    }else{
        echo "Du är inte inloggad!!!!!!!!!!!!";
    }

?>
