<?php
include_once 'dbMovies.inc.php';
    
    //mysqli_real_escape_string() is a function to read the inputs from the user as only text to avoid SQL injection
    //Prepared Statement
    
    // $movie_name = mysqli_real_escape_string($conn,$_POST['movie_name']);
    // $movie_rating = mysqli_real_escape_string($conn,$_POST['movie_rating']);
    // $movie_releaseYear = mysqli_real_escape_string($conn,$_POST['movie_releaseYear']);
    // $movie_length = mysqli_real_escape_string($conn,$_POST['movie_length']);
    // $movie_ratingOne = mysqli_real_escape_string($conn,$_POST['movie_ratingOne']);
    // $movie_ratingTwo = mysqli_real_escape_string($conn,$_POST['movie_ratingTwo']);
    // $movie_ratingThree = mysqli_real_escape_string($conn,$_POST['movie_ratingThree']);
    
    // $sql = "INSERT INTO movies (movie_name, movie_rating, movie_releaseYear, movie_length, movie_ratingOne, movie_ratingTwo, movie_ratingThree) 
    //             VALUES (?, ?, ?, ?, ?, ?, ?);";
    // $stmt = mysqli_stmt_init($conn);
    
    // if(!mysqli_stmt_prepare($stmt, $sql)){
    //     echo "SQL error";
    // } else {
    //     mysqli_stmt_bind_param($stmt, "sssssss", $movie_name, $movie_rating, $movie_releaseYear, $movie_length, $movie_ratingOne, $movie_ratingTwo, $movie_ratingThree);
        
    //     mysqli_stmt_execute($stmt);
    // }

    
    
    header("Location: ../index.php?movieAdded=success");
?>