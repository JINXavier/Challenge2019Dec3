<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "southafrica");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepagina</title>
    <link rel="stylesheet" href="../CSS/CSS.css">
</head>
<style>

    /*NAVBAR*/
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #000000;
        position: -webkit-sticky; /* Safari */
        position: sticky;
        top: 0;
        width: 1890px;
    }

    li {
        float: left;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover {
        background-color: #111;
    }

    .active {
        background-color: #4CAF50;
    }
</style>
<body>
<!--NAVBAR-->
<img src="../IMG/Banner.png" alt="South Africa" STYLE=" TOP:0px; LEFT:0px; WIDTH:1890px; HEIGHT:420px">
<ul>
    <li><a class="active" href="#home">Home</a></li>
    <li><a href="#news">Bestemmingen</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#contact">Registreer</a></li>
    <li><a href="#contact">Inloggen</a></li>
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
    <div class="col-ad-4">
        <form method="post" action"index.php?action=ad&id=<?php echo $row["id"]; ?>">
        <div style="border: 1px solid #eaeaec; margin: -1px 19px 3px -1px; box-shadow: 0 1px 2px rgba(0,0,0,0,05); padding: 10px;" align="center">
            <img src="<?php echo $row["image"]; ?>" class="img-responsive">
            <h5 class="text-info"><?php echo $row ["p_name"]; ?></h5>
            <input type="text" name="quantity" class="form-control" value="1">
            <input type="hidden" name="hidden_name" value="<?php echo $row["p_name"]; ?>">
            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
            <input type="submit" name="add" style="margin-top:5px" class="btn btn-default" value="Add to bag">
        </div>
        </form>
    </div>
    <?php
        }
    }
    ?>

    <div style="clear: both"></div>
    <h2>My shopping bag</h2>
    <div class="table table-bordered">
        <table class="table table-bordered">
            <tr>
                <th width="40%">Product Name</th>
                <th width="10%">Quantity</th>
                <th width="20%">Price Details</th>
                <th width="15%">Order Total</th>
                <th width="5%">Action</th>
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
                        <td><a href="index.php?action=delete$id=<?php echo $values ["product_id"]; ?>"><span
                                        class="text-danger"></span></a></td>
                    </tr>
                    <?php
                    $total = $total + ($values["item_quantity"] + $values["product_price"]);
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