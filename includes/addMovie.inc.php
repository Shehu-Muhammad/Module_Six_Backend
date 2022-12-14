<?php
include_once 'dbMovies.inc.php';
    if(!isset($_POST['id'])) {
        header("Location: ../index.php");
    }

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $minutes = mysqli_real_escape_string($conn, $_POST['minutes']);
    $hour = $_POST['hour'];
    $seconds = $hour*60*60 + $minutes*60;  
    $run_time = mysqli_real_escape_string($conn, $seconds);
    $rating_id = mysqli_real_escape_string($conn, $_POST['rating']);
    $genre_ids = mysqli_real_escape_string($conn, implode("",$_POST['genre']));
    $release_year = mysqli_real_escape_string($conn, $_POST['releaseYear']);
    
    $movie_table_sql = "INSERT INTO movies ";
    $movie_table_sql .= "(title) ";
    $movie_table_sql .= "VALUES (";
    $movie_table_sql .= "'" . $title . "'";
    $movie_table_sql .= ")";

    $movieInserted = mysqli_query($conn, $movie_table_sql);

    if( $movieInserted ) {
        $lastMovieIdInserted = mysqli_insert_id($conn);

        $movie_details_sql = "INSERT INTO details ";
        $movie_details_sql .= "(movie_id, genre_ids, rating_id, release_year, run_time)";
        $movie_details_sql .= "VALUES (";
        $movie_details_sql .= "'" . $lastMovieIdInserted . "', ";
        $movie_details_sql .= "'" . $genre_ids . "', ";
        $movie_details_sql .= "'" . $rating_id . "', ";
        $movie_details_sql .= "'" . $release_year . "', ";
        $movie_details_sql .= "'" . $run_time . "'";
        $movie_details_sql .= ")";
        
        $movieDetailsInserted = mysqli_query($conn, $movie_details_sql);
        if( $movieDetailsInserted ) {
            header("Location: ../index.php?movieAdded=success");
        } else {
            /* Displays errors */
            echo mysqli_error($conn);
            
            /* If there's a connection, close the connection */
            if($conn){ 
                mysqli_close($conn);
            }

            /* Make sure nothing else runs */
            exit();
        }
    } else {
        /* Displays errors */
        echo mysqli_error($conn);
            
        /* If there's a connection, close the connection */
        if($conn){ 
            mysqli_close($conn);
        }

        /* Make sure nothing else runs */
        exit();
    }
?>