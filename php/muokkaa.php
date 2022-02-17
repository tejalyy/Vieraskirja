<?php 
$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : 0;
if (empty($muokattava)) {
header("Location;../lista.php");
exit;
}
try {
    $yhteys=mysqli_connect("db", "root", "password", "vieraskirja");
}
catch(Exception $e) {
    header("location:.../html/yhteysvirhe.html");
    exit;
}
$sql="select * from vieraat where id=?";
$stmt=mysqli_prepare($yhteys, $sql);
mysql_stmt_bind_param($stmt, 'i', $muokattava);
mysql_stmt_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);

if (!$rivi=mysqli_fetch_object($tulos)) {
    header("location:./lista.php");
    exit;
}
include "../html/header.html";
?>
<p>Muokkaa tietoja</p>
<form action='vieraskirja.php' method='post'>
<input type='hidden' name='id' value='<?php print $rivi->id;?>'><br>
P‰iv‰m‰‰r‰: <input type='date' name='date' value='<?php print $rivi->p‰iv‰m‰‰r‰;?>'><br>
Nimi: <input type='text' name='vieras' value='<?php print $rivi->nimi;?>'><br>
Viesti: <textarea type='text' name='teksti' value='<?php print $rivi->viesti;?>'></textarea><br>
<input type='submit' name ='ok' value='L‰het‰'><br>
</from>

<?php 
mysqli-close($yhteys);
include "../html/footer.html";
?>
