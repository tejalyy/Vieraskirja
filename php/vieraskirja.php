<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$vieras=isset($_POST["vieras"]) ? $_POST["vieras"] : "";
$teksti=isset($_POST["teksti"]) ? $_POST["teksti"] : "";
$date=isset($_POST["date"]) ? $_POST["date"] : "";

if (empty($vieras) || empty ($teksti)){
    header("Location:../html/vieraslomake.html");
    exit;
}

try{
    $yhteys=mysqli_connect("db", "root", "password", "vieraskirja");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

$sql="insert into vieraat (vieras, teksti, date) values(?, ?, ?)";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'ssi', $vieras, $teksti, $date);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
header("Location:./lista.php");
?>
