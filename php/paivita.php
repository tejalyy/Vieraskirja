<?php 
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$vieras=isset($_POST["vieras"]) ? $_POST["vieras"] : "";
$date=ISSET($_POST["date"]) ? $_POST["date"] : "";
$teksti=ISSET($_POST["teksti"]) ? $_POST["teksti"] : "";
$id=ISSET($_POST["id"]) ? $_POST["id"] : "";

if (empty($vieras) || empty($date) || empty($teksti)|| empty($id)) {
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
$sql="update vieraat set vieras=?, date=?, teksti=? where id=?";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, 'sssi', $vieras, $date, $teksti, $id);

mysqli_stmt_execute($stmt);

mysqli_close($yhteys);

include "../php/lista.php";
?>