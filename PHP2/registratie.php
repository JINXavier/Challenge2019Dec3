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
    echo "Gebruikernaam is al in gebruik";
    }else {
    $reg = "insert into usertable(name, password) values ('$gebruikersnaam', '$ww' )";
    mysqli_query($con, $reg);
    echo "Registratie succesvol";
}
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepagina</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/CSS.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<img class="banner" src="IMG/Banner.png" alt="South Africa">
<!--NAVBAR-->
<ul>
    <li><a  href="../Homepage.html">Home</a></li>
    <li><a href="../PHP/index.php">Bestemmingen</a></li>
    <li><a href="../Contact.html">Contact</a></li>
    <li><a href="registratie.php">Registreer</a></li>
    <li><a href="../PHP1/inlog.php">Inloggen</a></li>
</ul>

<!--REGISTRATIE-->
<div class="containter">
    <div class="login-box">
        <div class="row">
            <div class="col-md-6">
                <h2>Registreren</h2>
                <form action="registreren.php" method="post">
                    <div class="form-group"><!--NAAM-->
                        <label>Naam</label>
                        <input type="text" name="naam" class="form-control" required>
                    </div>

                    <div class="form-group"><!--ACHTERSNAAM-->
                        <label>Achtersnaam</label>
                        <input type="text" name="achternaam" class="form-control" required>
                    </div>

                    <div class="form-group"><!--TUSSENVOESELS-->
                        <label>Tussenvoegsels</label>
                        <input type="text" name="tussevoegsels" class="form-control" required>
                    </div>

                    <div class="form-group"><!--GEBOORTEDATUM-->
                        <label>Geboortedatum</label>
                        <input type="text" name="Geboortedatum" class="form-control" required>
                    </div>

                    <div class="form-group"><!--GESLACHT-->
                        <label>Geslacht</label>
                        <input type="text" name="geslacht" class="form-control" required>
                    </div>

                    <div class="form-group"><!--ADRES-->
                        <label>Adres</label>
                        <input type="text" name="adres" class="form-control" required>
                    </div>

                    <div class="form-group"><!--POSTCODE-->
                        <label>Postcode</label>
                        <input type="text" name="postcode" class="form-control" required>
                    </div>

                    <div class="form-group"><!--TELEFOON NUMMER-->
                        <label>Telefoon nummer</label>
                        <input type="text" name="TelefoonNummer" class="form-control" required>
                    </div>

                    <div class="form-group"><!--Email-->
                        <label>E-mail</label>
                        <input type="text" name="user" class="form-control" required>
                    </div>

                    <div class="form-group"><!--GEBRUIKERSNAAM-->
                        <label>Gebruikersnaam</label>
                        <input type="text" name="user" class="form-control" required>
                    </div>
                    <br><br>

                    <div class="form-group"><!--WACHTWOORD-->
                        <label>Wachtwoord</label>
                        <input type="password" name="wachtwoord" class="form-control" required>
                    </div>

                    <div class="form-group"><!--WACHTWOORD HERHALEN-->
                        <label>Wachtwoord herhalen</label>
                        <input type="password" name="wachtwoord" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registreren</button><!--LOGIN-->
                </form>
            </div>
        </div>
    </div>
</div>
<!--FOOTER-->
</body>
</html>
