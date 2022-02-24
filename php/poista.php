<?php 
$poistettava=$_GET["poistettava"];
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect("db", "root", "password", "kukkuu");
    
}
catch(exception $e){
    header("location:../html/yhteysvirhe.html");
    exit;
}


//mysqli_query($yhteys,"delete from vieraat where id=$poistettava");

mysqli_query($yhteys, "delete from vieraat where id=$poistettava");



$poistettava=isset($_GET["poistettava"]) ? $_GET["poistettava"] : "";

//Jos tieto on annettu, poistetaan kala tietokannasta
if (!empty($poistettava)){
    $sql="delete from vieraat where id=?";
    $stmt=mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttuja sql-lauseeseen
    mysqli_stmt_bind_param($stmt, 'i', $poistettava);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);
}
mysqli_close($yhteys);

header("Location:./lista.php");

?>