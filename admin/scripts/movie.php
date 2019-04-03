<?php


function addMovie($cover, $title, $year, $run, $story, $trailer, $release, $genre){
    //if any error happen in process, whole process stopped
    try{

        //1. Build DB connection
        include('connect.php');
        //2. Validate file
        $file_type = pathinfo($cover['name'], PATHINFO_EXTENSION);
        $accepted_types = array('gif','jpg','jpe','jpeg','png');
        if(!in_array($file_type,$accepted_types)){
            throw new Exception('Wrong file type!');
        }
        //3. Move file around
        //change path name and path itself to be descriptive
        $target_path = '../images/'.$cover['name'];
        if(!move_uploaded_file($cover['tmp_name'], $target_path)) {
            throw new Exception('Failed to move uploaded file, check permission!');

        }
        //Find out how to generate small thumbnail rather than huge image that comes directly from user online
        $th_copy = '../images/TH_'.$cover['name'];
        if(!copy($target_path, $th_copy)){

            throw new Exception('Failed to move copy file, check permission!');
        }

        //4. Add entries to database (both tbl_movies and tbl_mov_genre)

        $create_movie_query = 'INSERT INTO tbl_movies(movies_cover, movies_title, movies_year, movies_runtime, movies_storyline, movies_trailer, movies_release) VALUES(:cover, :title, :year, :run, :story, :trailer, :release)';
        $create_movie_set = $pdo->prepare($create_movie_query);
        $create_movie_set->execute(
            array(
                ':cover'=>$cover['name'],
                ':title'=>$title,
                ':year' => $year,
                ':run'=>$run,
                ':story'=>$story,
                ':trailer'=>$trailer,
                ':release'=>$release
            )
        );

        //grab new movie id
        $new_movie = $pdo->lastInsertId();

        $create_movie_link_query = 'INSERT INTO tbl_mov_genre(movies_id, genre_id) VALUES(:movie, :genre)';
        $create_movie_link_set = $pdo->prepare($create_movie_link_query);
        $create_movie_link_set->execute(
            array(
                ':movie'=>$new_movie,
                ':genre'=>$genre
            )
        );

        if(!$create_movie_link_set->rowCount()){
            throw new Exception('Failed to see Genre!');
        }

        //5. If all above works, redirect user to index.php
        redirect_to('index.php');


    }catch(Exception $e){

        $error = $e->getMessage();
        return $error;

    }
}