<?php
session_start();

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

$s = "select * from usertable where name = '$gebruikersnaam' && wachtwoord = '$ww'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    $_SESSION['gebruikersnaam'] = gebruikersnaam;
    header('location:homepage.php');
}else{
    header('location:inlog.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepagina</title>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/CSS.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<img class="banner" src="IMG/Banner.png" alt="South Africa">
<!--NAVBAR-->
<ul>
    <li><a href="../Homepage.html">Home</a></li>
    <li><a href="../PHP/index.php">Bestemmingen</a></li>
    <li><a href="../Contact.html">Contact</a></li>
    <li><a href="../PHP2/registratie.php">Registreer</a></li>
    <li><a href="inlog.php">Inloggen</a></li>
</ul>

<!--LOGIN-->
<div class="containter">
    <div class="login-box">
        <div class="row">
            <div class="col-md-6">
                <h2>Aanmelden</h2>
                <form action="validation.php" method="post">
                    <div class="form-group"><!--WACHTWOORD-->
                        <label>Wachtwoord</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group"><!--GEBRUIKERSNAAM-->
                        <label>Gebruikersnaam</label>
                        <input type="text" name="user" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button><!--LOGIN-->
                </form>
            </div>
        </div>
    </div>
</div>

<!--FOOTER-->

</body>
</html>
