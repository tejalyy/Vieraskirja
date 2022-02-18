<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "kukkuu");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

include "../html/header.html";
echo "<div style=\"text-align:center\">";
$tulos=mysqli_query($yhteys, "select * from vieraat");
while ($rivi=mysqli_fetch_object($tulos)){
    print "<p>$rivi->vieras $rivi->teksti $rivi->date <a href='./poista.php?poistettava=$rivi->id'>Poista</a></p>". 
    "<a href='./muokkaa.php?muokattava=$rivi->id'>Muokkaa</a>";
}
mysqli_close($yhteys);
echo "</div>";
?>

<br>
<a href='../html/vieraslomake.html'><center>Kirjoita uusi viesti</center></a>

<?php
include "../html/footer.html";

?>
