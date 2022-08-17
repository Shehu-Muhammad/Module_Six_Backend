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
    <title>Edit Movie Form</title>
</head>
<body>
    <h1>Update Movie Details</h1>
    <?php
        if(!isset($_GET['id'])) {
            header("Location: index.php");
        }
        
        $id = $_GET['id'];
        $title = $_SESSION['editMovieDetails['.$id.']']['title'];
        $titleId = $_SESSION['editMovieDetails['.$id.']']['titleId'];
        $hours = $_SESSION['editMovieDetails['.$id.']']['hours'];
        $minutes = $_SESSION['editMovieDetails['.$id.']']['minutes'];
        $releaseYear = $_SESSION['editMovieDetails['.$id.']']['releaseYear'];
        $rating = $_SESSION['editMovieDetails['.$id.']']['rating'];
        $ratingId = $_SESSION['editMovieDetails['.$id.']']['ratingId'];
        $genre_Ids = $_SESSION['editMovieDetails['.$id.']']['genreIds'];
        $_POST['id'] = $id;
    ?>
    <!-- includes/updateMovie.inc.php -->
    <form action="<?php echo("includes/updateMovie.inc.php?id=".urlencode($id)."&titleId=".urlencode($titleId))?>" method="POST">
        <label>
            Title
            <input type="text" name="title" id="title" placeholder="Enter a movie title" value="<?php echo($title);?>"required><br><br>
        </label>
        <label>
            Hour(s)
            <input type="number" name="hour" id="hour" min="0" max="50" placeholder="0" value="<?php echo($hours);?>"required><br><br>
        </label>
        <label>
            Minutes
            <input type="number" name="minutes" id="minutes" min="0" max="59" placeholder="0" value="<?php echo($minutes);?>"required><br><br>
        </label>
        <label>
            Rating
            <select name="rating" id="rating">
                <option value="-1" disabled>Please Select A Rating</option>
            <?php
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
                            <input type="checkbox" name="genre[]" id="genre" value="<?php echo ($currentGenre["id"]); ?>"<?php if(in_array($currentGenre["id"], $genre_Ids)){echo("checked");} ?>>
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
            <option value="<?php echo( $currentYear ); ?>"<?php if($currentYear == $releaseYear) {echo ("selected");}?>><?php echo( $currentYear ); ?></option>
<?php
                } 
?>
            </select><br><br>
        </label>
        <input type="submit" value="Update Movie">
    </form>
</body>
</html>