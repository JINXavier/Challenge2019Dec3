<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "southafrica");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepagina</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/CSS.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<style>

</style>
<body>
<!--NAVBAR-->
<img class="banner" src="../IMG/Banner.png" alt="South Africa">
<ul>
    <li><a href="../Homepage.html">Home</a></li>
    <li><a class="active" href="index.php">Bestemmingen</a></li>
    <li><a href="../Contact.html">Contact</a></li>
    <li><a href="../PHP2/registratie.php">Registreer</a></li>
    <li><a href="../PHP1/inlog.php">Inloggen</a></li>
</ul>
<div class="page"> <!--Center page opening-->

    <?php
    $query = "SELECT * FROM reizen ORDER BY id ASC";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            ?>
    <div class ="bestemmingen">
        <form method="post" action="Bestemmingen.php?action=add&id=<?php echo $row["id"]; ?>">
        <div style="border: 1px solid #eaeaec; margin: -1px 19px 3px -1px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 10px;" align="center">
            <img src="../IMG/<?php echo $row["image"]; ?>" class="img-responsive">
            <h5 class="text-info"><?php echo $row ["p_name"]; ?></h5>
            <h5 class="text-danger">$ <?php echo $row["price"]; ?></h5>
            <input type="text" name="quantity" class="form-control" value="1">
            <input type="hidden" name="hidden_name" value="<?php echo $row["p_name"]; ?>">
            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
            <input type="submit" name="add" style="margin-top:5px;" class="btn btn-default" value="Voeg to aan winkelmandje.">
        </div>
        </form>
    </div>
    <?php
        }
    }
    ?>

    <div style="clear:both"></div>
    <h2>Mijn winkel mandje</h2>
    <div class="table table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="20%">Stad</th>
                <th width="10%">Personen</th>
                <th width="20%">Prijs</th>
                <th width="15%">Totaal bedrag</th>
                <th width="5%">Verwijderen</th>
            </tr>
            <?php
            if (!empty($_SESSION["cart"])) {
                $total = 0;
                foreach ($_SESSION["cart"] as $keys => $values) {
                    ?>
                    <tr>
                        <td><?php echo $values["item_name"]; ?></td>
                        <td><?php echo $values["item_quantity"]; ?></td>
                        <td>$ <?php echo $values["product_price"]; ?></td>
                        <td>$ <?php echo number_format($values["item_quantity"] * $values["product_price"], 2); ?></td>
                        <td><a href="Bestemmingen.php?action=delete&id=<?php echo $values["product_id"]; ?>"><span class="text-danger">X</span></a></td>
                    </tr>
                    <?php
                    $total = $total + ($values["item_quantity"] * $values["product_price"]);
                }
                ?>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">$ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    </div>
<!--FOOTER-->
<div class="footer">
    <p>Copyright Dehortop 2019</p>
</div>
</body>
</html>