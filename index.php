<?php require_once('admin/scripts/config.php');
if(isset($_GET['filter'])){

    $tbl = 'tbl_movies';
    $tbl2 = 'tbl_genre';
    $tbl3 = 'tbl_mov_genre';
    $col = 'movies_id';
    $col2 = 'genre_id';
    $col3 = 'genre_name';
    $filter = $_GET['filter'];
    $results = filterResults($tbl, $tbl2, $tbl3, $col, $col2, $col3, $filter);

} else {

    $results = getAll('tbl_movies');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Movie Review</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="https://www.bootstrapcdn.com" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script src="main.js"></script>
</head>
<body>
    <?php include('templates/header.php'); ?>
    <h1>This is a movie website.</h1>
    <section>
    <ul>
    <?php

        //using endwhile keeps php code cleaner
        while($row = $results->fetch(PDO::FETCH_ASSOC)):?>
        <?php //TODO::  use the following syntax to display at least 3 more columns from the database?>
            <li><?php echo $row['movies_title'];?></li>
            <p><?php echo $row['movies_year'];?></p>
            <p><?php echo $row['movies_storyline'];?></p>
            <img src="images/<?php echo $row['movies_cover'];?>" alt="">
            <a href="details.php?id=<?php echo $row['movies_id'];?>">Read More</a>
        <?php endwhile;?>
    </ul>
    </section>
    <script src="js/encrypt.js"></script>
    <?php include('templates/footer.php'); ?>
</body>
</html>