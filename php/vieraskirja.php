<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$vieras=isset($_POST["vieras"]) ? $_POST["vieras"] : "";
$teksti=isset($_POST["teksti"]) ? $_POST["teksti"] : "";
$date=isset($_POST["date"]) ? $_POST["date"] : "";
/*print $date;*/

if (empty($vieras) || empty ($teksti) || empty ($date)){
    header("Location:../html/vieraslomake.html");
    exit;
}

try{
    $yhteys=mysqli_connect("db", "root", "password", "kukkuu");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

$sql="insert into vieraat (vieras, teksti, date) values(?, ?, ?)";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'sss', $vieras, $teksti, $date);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
header("Location:./lista.php");

?>
<?php
//Hakemisto, johon on tarkoitus tallentaa. Luo hakemisto valmiiksi.
$target_dir = "./uploads/";

//Tarkistuksia/ohjelman ohjausta varten muuttuja
$uploadOk = 1;

//Luodaan finfo tyyppinen olio, jota voidaan käyttää tutkittaessa tiedoston MIME-tyyppiä
$finfo = new finfo(FILEINFO_MIME_TYPE);

//Luodaan taulukko, jossa on lueteltu kaikki mahdolliset kuvatiedostojen MIME-tyypit
$mimearray=array('jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
                'txt' => 'text/plain',
                'pdf' => 'application/pdf',
);

/*
 * Tutkitaan, löytyy uploadatun tiedoston mime-tyyppi taulukosta
 * Metodi palauttaa indeksin (tässä jpg, png tai gif), jos löytyy, muutoin false.
 */
$mimeindeksi=array_search($finfo->file($_FILES['fileToUpload']['tmp_name']), $mimearray, true);

if ($mimeindeksi==false){
	print "Väärä mime-tyyppi<br>";
	$uploadOk = 0;
}
else{
	print "Oikea mime-tyyppi $mimeindeksi<br>";
}


//Tiedoson koko nimi
$filename=basename($_FILES["fileToUpload"]["name"]);

//Poimitaan tiedoston nimi ilman tarkennetta
$imageFileNameWithoutExtension = strtolower(pathinfo($filename,PATHINFO_FILENAME));

//Rakennetaan tiedostolle nimi polusta, varsinaisesta nimestä ja oikeasta tarkenteesta
$target_file=$target_dir.$imageFileNameWithoutExtension.".".$mimeindeksi;


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
        echo "The file ". $target_file. " has been uploaded.<br>";
        print "<img src='".$target_file."' width='300'>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>


<?php 
//Muun lomakkeen käsittely

print "<h3>".$_POST["nimi"]."</h3>";

?>

