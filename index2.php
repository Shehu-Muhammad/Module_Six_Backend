<?php
        $sql = "SELECT * from movies";
        $sql2 = "SELECT * from details";
        $sql3 = "SELECT * from genre";
        $sql4 = "SELECT * from ratings";
        $allMovies = mysqli_query($conn, $sql);
        $allDetails = mysqli_query($conn, $sql2);
        $allGenres = mysqli_query($conn, $sql3);
        $allRatings = mysqli_query($conn, $sql4);

        function getTitle($allMovies) {
            while ($currentMovie = mysqli_fetch_assoc( $allMovies )) {
                $title = $currentMovie['title'];
                echo("<li>".$title."</li>");
            }
        }

        function getDetails($allDetails) {
            while ($currentDetails = mysqli_fetch_assoc($allDetails)) {
                $hours = intDiv($currentDetails['run_time'], 3600);
                $minutes = $currentDetails['run_time']/60%60;
                $releaseYear = $currentDetails['release_year'];
                echo("<br> hours: ".$hours."<br> minutes: ".$minutes."<br> release-year: ".$releaseYear);
                // while( $currentRating = mysqli_fetch_assoc($allRatings) ) {
                //     if($allDetails['rating_id'] == $currentRating['id']) {
                //         $rating = $currentRating['rating'];
                //         echo("<br> Rating: ".$rating);
                //     }
                // }
            }
        }
        ?>

        <?php
        // exit();
        while ($currentMovie = mysqli_fetch_assoc( $allMovies )) {
?>
        <ol>
           <li>
<?php
                $title = $currentMovie['title'];
                $allDetails = mysqli_fetch_assoc($allDetails);
                $hours = intDiv($allDetails['run_time'], 3600);
                $minutes = $allDetails['run_time']/60%60;
                $releaseYear = $allDetails['release_year'];
                while( $currentRating = mysqli_fetch_assoc($allRatings) ) {
                    if($allDetails['rating_id'] == $currentRating['id']) {
                        $rating = $currentRating['rating'];
                    }
                }
?>
                Title: <?php echo ($title); ?><br>
                Hour(s): <?php echo ($hours); ?><br>
                Minute(s): <?php echo ($minutes); ?><br>
                Release Year: <?php echo ($releaseYear); ?><br>
                Rating: <?php echo($rating); ?><br>
                Genre:
<?php 
                $genre_Ids = $allDetails['genre_ids'];
                $genre_Ids = explode(",", $genre_Ids);
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
                while($result = mysqli_fetch_assoc($sqlGetGenresList)) {
                    echo(ucfirst($result['name']." "));
                }
?>

                <br>
               <a href="<?php echo("index.php?movieEditId=" . urlencode( $currentMovie['id'] )); ?>">Edit</a> 
               <a href="<?php echo("index.php?movieDeleteId=" . urlencode( $currentMovie['id'] )); ?>">Delete</a>
            </li>
        </ol>
<?php
        }
?>
<?php
        if( isset( $_GET['movieEditId'] )) {

        }
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