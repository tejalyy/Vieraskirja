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
echo "<div style=\"margin-top:-5.8%\">";
?>
<link rel='stylesheet' type='text/css' href='../ css/tyyli.css'>
<div class="col-3">
<p>Muokkaa tietoja</p>
<form action='./paivita.php' method='post'>
<input type='hidden' name='id' value='<?php print $rivi->id;?>'><br>
Date: <input type='date' name='date' value='<?php print $rivi->date;?>'><br>
Nimi: <input type='text' name='vieras' value='<?php print $rivi->vieras;?>'><br>
Teksti: <textarea name='teksti' <?php print $rivi->teksti;?>'></textarea><br>
<input type='submit' name ='ok' value='Tallenna'><br></form>
</div>

<?php 
mysqli_close($yhteys);

include "../html/footer.html";
?>
