<?php 
include_once 'includes/dbMovies.inc.php';
session_start();
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
    $sql = "SELECT * FROM details";
    $query = mysqli_query($conn, $sql);

    echo("<ol>");
    while($currentData = mysqli_fetch_assoc($query)) {
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

        $sqlGenres = "SELECT * from genre where id in";
        $sqlGenres .= " (";
        $sqlGenres .= "$genre_Ids_string";
        $sqlGenres .= ")";
        $sqlGetGenresList = mysqli_query($conn, $sqlGenres);
        $genres = "";
        while($result = mysqli_fetch_assoc($sqlGetGenresList)) {
            $genres .= ucfirst($result['name']." ");
        }

        echo("Title: ".htmlspecialchars($title));
        echo ("<br>");
        echo("Hours: ".htmlspecialchars(intDiv($seconds, 3600)));
        echo ("<br>");
        echo("Minutes: ".htmlspecialchars($seconds/60%60));
        echo ("<br>");
        echo("Release Year: ".htmlspecialchars($releaseYear));
        echo ("<br>");
        echo("Rating: ".htmlspecialchars($rating));
        echo ("<br>");
        echo("Genre(s): ".htmlspecialchars($genres));
        echo("</li>");
        
        $editMovieDetails[$id] = [];
        $editMovieDetails[$id]['id'] = $id;
        $editMovieDetails[$id]['title'] = $title;
        $editMovieDetails[$id]['titleId'] = $titleId;
        $editMovieDetails[$id]['hours'] = intDiv($seconds, 3600);
        $editMovieDetails[$id]['minutes'] = $seconds/60%60;
        $editMovieDetails[$id]['releaseYear'] = $releaseYear;
        $editMovieDetails[$id]['ratingId'] = $ratingId;
        $editMovieDetails[$id]['rating'] = $rating;
        $editMovieDetails[$id]['genreIds'] = $genre_Ids;
        $_SESSION['editMovieDetails['.$id.']'] = $editMovieDetails[$id];
        ?>
        <a href="<?php echo("updateMovie.php?id=" . htmlspecialchars(urlencode( $id ))); ?>">Edit</a> 
        <a href="<?php echo("index.php?movieDeleteId=" . htmlspecialchars(urlencode( $id )). "&titleId=" . htmlspecialchars(urlencode( $titleId ))); ?>">Delete</a><br><br>
        <?php  
    }
    echo("</ol>");
?>
<?php
// Delete from database
if( isset( $_GET['movieDeleteId']) && isset( $_GET['titleId']) ) {
    $movieDeletedId = mysqli_real_escape_string($conn, $_GET['movieDeleteId']);
    $titleId = mysqli_real_escape_string($conn, $_GET['titleId']);

    $deleteMovieData = "DELETE FROM details ";
    $deleteMovieData .= "WHERE id ='". $movieDeletedId . "' ";
    $deleteMovieData .= "LIMIT 1";
    $deleteMovieData = mysqli_query($conn, $deleteMovieData);

    $deleteMovieTitle = "DELETE FROM movies ";
    $deleteMovieTitle .= "WHERE id ='". $titleId . "' ";
    $deleteMovieTitle .= "LIMIT 1";
    $deleteMovieTitle = mysqli_query($conn, $deleteMovieTitle);

    $movieDeletionSuccessful = $deleteMovieTitle;

    if( $movieDeletionSuccessful ) {
        header("Location: index.php");
        exit();
    } else {
        echo(mysqli_error($conn));
        
        if($conn) {
            mysqli_close($conn);
        }
        
        exit();
    }
}
?>
</body>
</html>