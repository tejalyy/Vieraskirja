<?php
session_start();
if (!isset($_SESSION["kayttaja"])){
    header("Location:../html/kirjautuminen.html");
    exit;
}
include "../html/header.html";
print "<h2>Tervetuloa, ".$_SESSION["kayttaja"]."!</h2>";
?>
<a href='kirjauduulos.php'>Kirjaudu ulos</a>
<?php
include "../html/footer.html";
?>