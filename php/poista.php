<?php 
$poistettava=$_GET["poistettava"];

try{
    $yhteys=mysqli_connect("db", "root", "password", "vieraskirja");
    
}
catch(exception $e){
    header("location:../html/yhteysvirhe.html");
    exit;
}

mysqli_query($yhteys,"delete from vieraat where id=$poistettava");

mysqli_close($yhteys);

?>