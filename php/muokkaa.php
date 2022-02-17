<?php 
$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : 0;
if (empty($muokattava)) {
header("Localtion;../luekirjat.php");
exit;
}
try {
    $yhteys=mysql_connect("db", "root", "password", "kirjakanta");
}
catch(Exception $e) {
    header("location:.../html/yhteysvirhe.html");
    exit;
}
$sql="select * from kirja where id=?";
$stmt=mysqli_prepare($yhteys, $sql);
mysql_stmt_bind_param($stmt, 'i', $muokattava);
mysql_stmt_execute($stmt);
$tulos=mysqli_stmt_get_result($stmt);

if (!$rivi=mysqli_fetch_object($tulos)) {
    header("location:./luekirjat.php");
    exit;
}
include "../html/header.html";
}?>
<p>Muokkaa tietoja</p>
<from action='./paviata.php' method='post'>
<input type='hidden' name='id' value='<?php print $rivi->id;?>'><br>
nimi: <input type='text' name='nimi' value='<?php print $rivi->nimi;?>'><br>
sivulkm: <input type='text' name='sivulkm' value='<?php print $rivi->sivulkm;?>'><br>
<input type='submit' name ='ok' value='OK'><br>
</from>

<?php 
mysqli-close($yhteys);
include "../html/footer.html";
?>
