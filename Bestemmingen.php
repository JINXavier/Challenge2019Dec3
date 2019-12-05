<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "test");
if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'               =>     $_GET["id"],
                'item_name'               =>     $_POST["hidden_name"],
                'item_price'          =>     $_POST["hidden_price"],
                'item_quantity'          =>     $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="Bestemmingen.php"</script>';
        }
    }
    else
    {
        $item_array = array(
            'item_id'               =>     $_GET["id"],
            'item_name'               =>     $_POST["hidden_name"],
            'item_price'          =>     $_POST["hidden_price"],
            'item_quantity'          =>     $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}
if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="Bestemmingen.php"</script>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepagina</title>
    <link rel="stylesheet" href="CSS/CSS.css">
</head>
<style>

    /*NAVBAR*/
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
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
<img src="IMG/Banner.png" alt="South Africa" STYLE=" TOP:0px; LEFT:0px; WIDTH:1890px; HEIGHT:420px">
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
    if (mysqlli_num_rows($result) > 0)
    {
    while ($row = mysqli_fetch_array($result))
    {
    ?>
    <div class="col-md-4">
        <form method="post" action="Bestemmingen.php?action=add&id=<?php echo $row["id"]; ?>">
            <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;"
                 align="center">
                <img src="<?php echo $row["image"]; ?>" class="img-responsive"/><br/>
                <h4 class="text-info"><?php echo $row["name"]; ?></h4>
                <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>
                <input type="text" name="quantity" class="form-control" value="1"/>
                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>"/>
                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>"/>
                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success"
                       value="Add to Cart"/>
            </div>
        </form>
    </div>
    <?php
    }
    }
    ?>
    <div style="clear:both"></div>
    <br />
    <h3>Order Details</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
        8
            <?php
            if(!empty($_SESSION["shopping_cart"]))
            {
                $total = 0;
                foreach($_SESSION["shopping_cart"] as $keys => $values)
                {
                    ?>
                    <tr>
                        <td><?php echo $values["item_name"]; ?></td>
                        <td><?php echo $values["item_quantity"]; ?></td>
                        <td>$ <?php echo $values["item_price"]; ?></td>
                        <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                        <td><a href="Bestemmingen.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
                    </tr>
                    <?php
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
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
<br />
</div>
<!--FOOTER-->
<div class="footer">
    <p>Copyright Dehortop 2019</p>
</div>
</body>
</html>