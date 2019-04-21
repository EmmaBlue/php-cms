<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    require_once('scripts/config.php');
    require_once('scripts/connect.php');
    confirm_logged_in();

    $tbl = 'tbl_category';

    //DRY way of doing getting all information from all genres

    $product_categories = getAll($tbl);
    $category = array();

    if(filter_has_var(INPUT_POST, 'submit')) {
        $cover = $_FILES['cover'];
        $title = trim($_POST['title']);
        $desc = trim($_POST['desc']);
        $price = trim($_POST['price']);
        $category = $_POST['productList'];
        $result = addProduct($title, $desc, $cover, $price, $category);
        $message = $result;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
</head>
<body>
    <?php if(!empty($message)):?>
        <p><?php echo $message;?></p>
    <?php endif ?>
    <form action="admin_addproduct.php" method="post" enctype="multipart/form-data">
        <label for="cover">Cover Image:</label>
        <input type="file" name="cover" id="cover" value=""><br>
        <label for="title">Product Title:</label>
        <input type="text" name="title" id="cover" value=""><br>
        <label for="desc">Product Description:</label>
        <textarea name="desc" id="desc" value=""></textarea><br><br>
        <label for="price">Product Price:</label>
        <input type="text" name="price" id="price" value=""><br><br>
        <label for="productList">Product List:</label>
        <select name="productList" id="productList">
            <option>Please select a product category...</option>
            <?php
                //Need to do while loop with fetch if you want more than the first row, Need to do fetch because we needed multiple objects rather than one with the getSingle function
                while($category = $product_categories->fetch(PDO::FETCH_ASSOC)):
            ?>
                <option value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
             <?php endwhile;?>
        </select>
        <br><br>
        <button type="submit" name="submit">Add Product</button>
    </form>
</body>
</html>