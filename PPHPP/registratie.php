<?php

session_start();
header('location:inlog.php');
$con = mysqli_connect('localhost', 'root', '');

mysqli_select_db($con, 'inloggebruikersnaam');

$voornaam = $_POST['naam'];
$anaam = $_POST['achternaam'];
$tvoegsel = $_POST['tu ssenvoegsel'];
$gbd = $_POST['geboortedatum'];
$MV = $_POST['geslacht'];
$adres = $_POST['adres'];
$postcode = $_POST['postcode'];
$tn = $_POST['telefoon nummer'];
$email = $_POST['E-mail'];
$gebruikersnaam = $_POST['gebruikersnaam'];
$ww = $_POST['wachtwoord'];

$s = "select * from usertable where name = '$gebruikersnaam'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    echo "Gebruikernaam is al in gebruik"
    }else{
    $reg = "insert into usertable(name, password) values ('$gebruikersnaam', '$ww' )";
    mysqli_query($con, $reg);
    echo "Registratie succesvol";
    ?>