<?php
    require_once('scripts/config.php');
    require_once('scripts/connect.php');
    //confirm_logged_in();

    $tbl = 'tbl_genre';

    //DRY way of doing getting all information from all genres

    $movie_categories = getAll($tbl);
    $category = array();

    if(filter_has_var(INPUT_POST, 'submit')) {
        $cover = $_FILES['cover'];
        $title = $_POST['title'];
        $year = $_POST['year'];
        $run = $_POST['run'];
        $story = $_POST['story'];
        $trailer = $_POST['trailer'];
        $release = $_POST['release'];
        $genre = $_POST['genList'];
        $result = addMovie($cover, $title, $year, $run, $story, $trailer, $release, $genre);
        $message = $result;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Movie</title>
</head>
<body>
    <?php if(!empty($message)):?>
        <p><?php echo $message;?></p>
    <?php endif ?>
    <form action="admin_addmovie.php" method="post" enctype="multipart/form-data">
        <label>Cover Image:</label>
        <input type="file" name="cover" id="cover" value=""><br>
        <label>Movie Title:</label>
        <input type="text" name="title" id="cover" value=""><br>
        <label>Movie Year:</label>
        <input type="text" name="year" id="year" value=""><br>
        <label>Movie Runtime:</label>
        <input type="text" name="run" id="run" value=""><br>
        <label>Movie Storyline:</label>
        <textarea name="story" id="story" value=""></textarea><br><br>
        <label for="trailer">Movie Trailer:</label>
        <input type="text" name="trailer" id="trailer" value=""><br><br>
        <label for="release">Movie Release:</label>
        <input type="text" name="release" id="release" value=""><br><br>
        <label for="genList">Genre List:</label>
        <select name="genList" id="genList">
            <option>Please select a movie genre...</option>
            <?php
                //Need to do while loop with fetch if you want more than the first row, Need to do fetch because we needed multiple objects rather than one with the getSingle function
                while($category = $movie_categories->fetch(PDO::FETCH_ASSOC)):
            ?>
                <option value="<?php echo $category['genre_id'];?>"><?php echo $category['genre_name'];?></option>
             <?php endwhile;?>
        </select>
        <br><br>
        <button type="submit" name="submit">Add Movie</button>
    </form>
</body>
</html>