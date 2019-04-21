<!--Put PHP logic at the top before HTML -->

<?php require_once('admin/scripts/config.php');
if(isset($_GET['id'])){

    $tbl = 'tbl_product';
    $col = 'product_id';
    $value = $_GET['id'];
    $results = getSingle($tbl, $col, $value);

} else {

    $results = getAll('tbl_product');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Movie Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <?php include('templates/header.html'); ?>
    <h1>This is a details page.</h1>
    <section>
        <?php
            //using endwhile keeps php code cleaner
            while($row = $results->fetch(PDO::FETCH_ASSOC)):?>
            <?php //TODO::  use the following syntax to display at least 3 more columns from the database?>
                <li><?php echo $row['product_title'];?></li>
            <?php endwhile;?>
    </section>
    <?php include('templates/footer.php'); ?>
</body>
</html>