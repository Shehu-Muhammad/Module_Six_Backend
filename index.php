<?php 
include_once 'includes/dbMovies.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
</head>
<body>
    <nav>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="addMovie.php">Add Movie</a>
            </li>
        </ul>
    </nav>
<?php
    // Query - SQL statement
    // $sql = "SELECT * FROM ";
    // mysqli_query($conn, $sql);
    // mysqli_fetch_assoc( $ )
    $sql = "SELECT * FROM details";
    // echo($sql);
    $query = mysqli_query($conn, $sql);
    // echo("<pre>");
    // var_dump($query);
    // echo("</pre>");
    echo("<ol>");
    while($currentData = mysqli_fetch_assoc($query)) {
        // print_r ($currentData);
        echo("<li>");
        $id = $currentData['id'];
        $titleId = $currentData['movie_id'];
        $genreIds = $currentData['genre_ids'];
        $ratingId = $currentData['rating_id'];
        $releaseYear = $currentData['release_year'];
        $seconds = $currentData['run_time'];


        $movieSQL = "SELECT * FROM movies";
        $movieQuery = mysqli_query($conn, $movieSQL);
        while($currentMovie = mysqli_fetch_assoc($movieQuery)) {
            if( $currentMovie['id'] == $titleId ) {
                $title = $currentMovie['title'];
            }
        }

        $ratingSQL = "SELECT * FROM ratings";
        $ratingQuery = mysqli_query($conn, $ratingSQL);
        while($currentRating = mysqli_fetch_assoc($ratingQuery)) {
            if( $currentRating['id'] == $ratingId ) {
                $rating = $currentRating['rating'];
            }
        }

        // $genre_Ids = $allDetails['genre_ids'];
        $genre_Ids = explode(",", $genreIds);
        $genre_Ids_string = "";
        for( $currentGenreIdIndex = 0; $currentGenreIdIndex < count( $genre_Ids ) ; $currentGenreIdIndex++  ) {
            if( $currentGenreIdIndex == count( $genre_Ids ) - 2 ) { 
                $genre_Ids_string .= $genre_Ids[ $currentGenreIdIndex ];
            } else if(trim($genre_Ids[$currentGenreIdIndex]) == "") {
                continue;
            } else {
                $genre_Ids_string .= $genre_Ids[ $currentGenreIdIndex ] . ", ";
            }
        }
        // echo($genre_Ids_string);
        // exit();

        $sqlGenres = "SELECT * from genre where id in";
        $sqlGenres .= " (";
        $sqlGenres .= "$genre_Ids_string";
        $sqlGenres .= ")";
        $sqlGetGenresList = mysqli_query($conn, $sqlGenres);
        $genres = "";
        while($result = mysqli_fetch_assoc($sqlGetGenresList)) {
            // echo(ucfirst($result['name']." "));
            $genres .= ucfirst($result['name']." ");
        }
        // echo $genres;
        // exit();

        echo("Title: ".$title);
        echo ("<br>");
        echo("Hours: ".intDiv($seconds, 3600));
        echo ("<br>");
        echo("Minutes: ".$seconds/60%60);
        echo ("<br>");
        echo("Release Year: ".$releaseYear);
        echo ("<br>");
        echo("Rating: ".$rating);
        echo ("<br>");
        echo("Genre(s): ".$genres);
        echo("</li>");
        echo ("<br>");
    }
    echo("</ol>");
    exit();
?>
<?php
// Hard coded for now to not get errors to undefined variables
            $title = "Dog";
            $hours = 1;
            $minutes = 41;
            $releaseYear = 2022;
            $rating = "PG-13";
            $genres = "Comedy Drama";
?>
    <ol>
        <li>
            Title: <?php echo ($title); ?><br>
            Hour(s): <?php echo ($hours); ?><br>
            Minute(s): <?php echo ($minutes); ?><br>
            Release Year: <?php echo ($releaseYear); ?><br>
            Rating: <?php echo($rating); ?><br>
            Genre: <?php echo ($genres); ?><br>
            <a href="<?php echo("index.php?movieEditId=" . urlencode( $currentMovie['id'] )); ?>">Edit</a> 
            <a href="<?php echo("index.php?movieDeleteId=" . urlencode( $currentMovie['id'] )); ?>">Delete</a>
        </li>
    </ol>

                
</body>
</html>