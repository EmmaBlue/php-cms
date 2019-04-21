<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    require_once('scripts/config.php');
    confirm_logged_in();

    $tbl = 'tbl_product';

    //DRY way of doing getting all information from all users

    $get_product = getAll($tbl);
    $product = array();


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Delete Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h2>Change Product Settings</h2>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php  //Need to do while loop with fetch if you want more than the first row, Need to do fetch because we needed multiple objects rather than one with the getSingle function
                while($product = $get_product->fetch(PDO::FETCH_ASSOC)):
            ?>
            <tr>
                <td><?php echo $product['product_id'];?></td>
                <td><?php echo $product['product_name'];?></td>
                <td><?php echo $product['product_description'];?></td>
                <td><?php echo $product['product_image'];?></td>
                <td><?php echo $product['product_price'];?></td>
                <td><a href="admin_editproductdetails.php?product=<?php echo $product['product_id'];?>">Edit Product</a></td>
                <td><a href="scripts/caller.php?caller_id=deleteproduct&id=<?php echo $product['product_id']; ?>">Delete Product</a></td>
            </tr>
            <?php endwhile;?>
        </tbody>
    </table>

</body>
</html>