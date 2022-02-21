<?php
$json=isset($_POST["user"]) ? $_POST["user"] : "";

if (!($user=tarkistaJson($json))){
    print "T�yt� kaikki kent�t";
    exit;
}
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "pena", "kukkuu", "kalakanta");
}
catch(Exception $e){
    print "Yhteysvirhe";
    exit;
}
$sql="insert into kayttaja (tunnus, salasana) values(?, SHA2(?, 256))";
try{
    $stmt=mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $user->tunnus, $user->salasana);
    mysqli_stmt_execute($stmt);
    mysqli_close($yhteys);
    print $json;
}
catch(Exception $e){
    print "Tunnus jo olemassa tai muu virhe!";
}
?>


<?php
function tarkistaJson($json){
    if (empty($json)){
        return false;
    }
    $user=json_decode($json, false);
    if (empty($user->tunnus) || empty($user->salasana)){
        return false;
    }
    return $user;
}
?>
