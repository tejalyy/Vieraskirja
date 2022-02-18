<?php 
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$nimi=isset($_POST["nimi"]) ? $_POST["nimi"] : "";
$date=ISSET($_POST["date"]) ? $_POST["date"] : "";
$viesti=ISSET($_POST["viesti"]) ? $_POST["viesti"] : "";

if (empty($nimi) || empty($date) || empty($viesti)) {
    header("Location:../php/lista.php");
    exit;
}
try {
    $yhteys=mysqli_connect("db", "root", "password", "kukkuu");
    
}
catch(Exception $e) {
    header("Location:../html/yhteysvirhe.html");
    exit;
}
$sql="update vieraat set nimi=?, date=?, viesti=?";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'sis', $nimi, $date, $viesti);

mysqli_stmt_execute($stmt);

mysqli_close($yhteys);

include "../php/lista.php";
?>