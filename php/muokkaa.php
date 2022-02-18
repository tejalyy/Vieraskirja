<?php 
$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : 0;
if (empty($muokattava)) {
header("Location;../lista.php");
exit;
}
try {
    $yhteys=mysqli_connect("db", "root", "password", "kukkuu");
}
catch(Exception $e) {
    header("location:.../html/yhteysvirhe.html");
    exit;
}
$sql="select * from vieraat where id=?";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'i', $muokattava);
mysqli_stmt_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);

if (!$rivi=mysqli_fetch_object($tulos)) {
    header("location:./lista.php");
    exit;
}
include "../html/header.html";
?>
<style class="area">
<p>Muokkaa tietoja</p>
<form action='./paivita.php' method='post'>
<input type='hidden' name='id' value='<?php print $rivi->id;?>'><br>
Date: <input type='date' name='date' value='<?php print $rivi->date;?>'><br>
Nimi: <input type='text' name='vieras' value='<?php print $rivi->nimi;?>'><br>
Viesti: <textarea type='text' name='teksti' value='<?php print $rivi->viesti;?>'></textarea><br>
<input type='submit' name ='ok' value='Lähetä'><br>
</from>
</style>

<?php 
mysqli-close($yhteys);

include "../html/footer.html";
?>
