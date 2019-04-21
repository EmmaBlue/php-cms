<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require_once 'scripts/config.php';
confirm_logged_in();
require_once 'scripts/connect.php';

// Get product ID from when user clicks on specific product in product settings table
if (isset($_GET['product'])) {
  $id = $_GET['product'];
}

//Get post data from product_edit form
if (isset($_POST['product_edit'])) {
  $cover = $_FILES['cover'];
  $title = trim($_POST['title']);
  $id = $_POST['product'];
  $desc = trim($_POST['desc']);
  $price = trim($_POST['price']);
  $category = trim($_POST['category']);
  $result = editProduct($cover, $title, $desc, $price, $category);
  $message = $result;
}

$tb1 = "tbl_product";
$col = "product_id";
// Get product info
$found_product = getSingle($tb1, $col, $id);
// Get categories
$tbl = "tbl_category";
$product_categories = getAll($tbl);
// Get prod category info
$get_product_query = "SELECT category_id FROM tbl_product_category WHERE product_id = :id";
$prod_category = $pdo->prepare($get_product_query);
$prod_category->execute(
  array(
    ':id' => $id,
  )
);
$get_product_category = $prod_category->fetch(PDO::FETCH_ASSOC);
$prod_cat = $get_product_category['category_id'];
// Get prod_at_name
$col2 = "category_id";
$get_single_category = getSingle($tbl, $col2, $prod_cat);
$product_category_name = $get_single_category->fetch(PDO::FETCH_ASSOC);
// var_dump($prod_cat_name);
if (is_string($found_product)) {
  $message = "Failed to get the user info!";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Product</title>
</head>

<body>
  <?php if (!empty($message)) : ?>
    <p><?php echo $message ?></p>
  <?php endif; ?>
  <br>
  <div class="container">
    <a href="./index.php" role="button"> Admin Dashboard</a>
    <br><br>
    <h1>Edit Product</h1>
    <?php if ($product = $found_product->fetch(PDO::FETCH_ASSOC)) : ?>
      <form action="admin_editproductdetails.php" method="post" enctype="multipart/form-data">
        <label for="product">Product ID:</label>
        <input type="product" name="product" id="product" value="<?php echo $product['product_id']; ?>">
            <img style="width: 120px;" src="../images/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name'] ?>">
          <label for="cover">Product Image:</label>
          <input type="file" name="cover" id="cover" value="" required>
          <label for="title">Product Title:</label>
          <input required type="text" name="title" id="title" value="<?php echo $product['product_name']?>">
          <label for="desc">Product Description:</label>
          <textarea required name="desc" id="desc"><?php echo $product['product_description'] ?></textarea>
          <label for="price">Product Price:</label>
          <input required  type="text" name="price" id="price" value="<?php echo $product['product_price'] ?>">
          <label for="category">Product Category</label>
          <select id="category" name="category">
            <option>--Select a Category--</option>
            <?php while ($product = $product_categories->fetch(PDO::FETCH_ASSOC)) : ?>
              <option value="<?php echo $product['category_id'] ?>"><?php echo $product['category_name'] ?></option>
            <?php endwhile ?>
          </select>
        <button  type="submit" name="product_edit">Edit Product</button>
      </form>
    </div>
  <?php endif; ?>
</body>

</html>

