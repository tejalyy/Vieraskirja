<?php
session_start();
unset($_SESSION["kayttaja"]);
header("Location:../html/kirjautuminen.html");
?>