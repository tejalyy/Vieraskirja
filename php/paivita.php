<?php 
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$nimi=isset($_POST["nimi"]) ? $_POST["nimi"] : "";
$p�iv�m��r�=ISSET($_POST["p�iv�m��r�"]) ? $_POST["p�iv�m��r�"] : "";
$viesti=ISSET($_POST["viesti"]) ? $_POST["viesti"] : "";

if (empty($nimi) || empty($p�iv�m��r�) || empty($viesti)) {
    header("Location:../php/lista.php");
    exit;
}
try {
    $yhteys=mysqli_connect("db", "root", "password", "vieraskirja");
    
}
catch(Exception $e) {
    header("Location:../html/yhteysvirhe.html")
    exit;
}
$sql="update vieraat set nimi=?, p�iv�m��r�=?, viesti=?";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'ssi', $nimi, $p�iv�m��r�, $viesti);
mysqli_stmt_execute($stmt);

mysql_close($yhteys);

include "../php/lista.php";
?>