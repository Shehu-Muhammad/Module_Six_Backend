<?php
    include_once 'includes/dbMovies.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie Form</title>
</head>
<body>
    <h1>Update Movie Details</h1>
    <?php
        if(!isset($_GET['editMovieDetails'])) {
            header("Location: index.php");
        } 

        echo("<pre>");
        var_dump($editMovieDetails);
        echo("</pre>");
    ?>
    <!-- includes/updateMovie.inc.php -->
    <form action="includes/updateMovie.inc.php" method="POST">
        <label>
            Title
            <input type="text" name="title" id="title" placeholder="Enter a movie title" required><br><br>
        </label>
        <label>
            Hour(s)
            <input type="number" name="hour" id="hour" min="0" max="50" placeholder="0" required><br><br>
        </label>
        <label>
            Minutes
            <input type="number" name="minutes" id="minutes" min="0" max="59" placeholder="0" required><br><br>
        </label>
        <label>
            Rating
            <select name="rating" id="rating">
                <option value="-1" disabled>Please Select A Rating</option>
            <?php
                $ratingId = 2;
                $sql = "Select * from ratings";
                $allRatings = mysqli_query($conn, $sql);
                while( $currentRating = mysqli_fetch_assoc($allRatings)) {        
            ?>
            <option value="<?php echo( $currentRating["id"] ); ?>" <?php  $selected = ($currentRating['id']==$ratingId) ? 'selected' : '';  echo($selected)?> ><?php echo( $currentRating["rating"] ); ?></option>
<?php
                } 
?>
            </select><br><br>
        </label>
        <label for="genre">Genre</label><br><br>
<?php
                $sql = "Select * from genre order by name ASC";
                $allGenres = mysqli_query($conn, $sql);
?>
                <table border="1">
<?php
                while( $currentGenre = mysqli_fetch_assoc($allGenres)) {
?>
                    <tr>
<?php
?>
                        <td>
<?php
                            echo (ucfirst($currentGenre["name"]));
?>
                        </td>
                        <td>
                            <input type="checkbox" name="genre[]" id="genre" value="<?php echo ($currentGenre["id"].","); ?>">
                        </td>
                    </tr>
<?php   
                }
?>
                </table>
            <br><br>
        <label>
            Release Year
            <select name="releaseYear" id="releaseYear">
<?php
                for($currentYear = 2022; $currentYear >= 1905; $currentYear--) {        
?>
            <option value="<?php echo( $currentYear ); ?>"><?php echo( $currentYear ); ?></option>
<?php
                } 
?>
            </select><br><br>
        </label>
        <input type="submit" value="Update Movie">
    </form>
</body>
</html>