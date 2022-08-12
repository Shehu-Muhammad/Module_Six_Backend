<?php
    include_once 'includes/dbMovies.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie Form</title>
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

    <form action="includes/addMovie.inc.php" method="POST">
        <label>
            Title
            <input type="text" name="" id="" placeholder="Enter a movie title"><br><br>
        </label>
        <label>
            Hour(s)
            <input type="number" name="" id="" min="0" max="50" placeholder="0"><br><br>
        </label>
        <label>
            Minutes
            <input type="number" name="" id="" min="0" max="59" placeholder="0"><br><br>
        </label>
        <label>
            Rating
            <select name="" id="">
            <?php
                $sql = "Select * from ratings";
                $allRatings = mysqli_query($conn, $sql);
                while( $currentRating = mysqli_fetch_assoc($allRatings)) {        
            ?>
            <option value=""><?php echo( $currentRating["rating"] ); ?></option>
            <?php
                } 
            ?>
            </select><br><br>
        </label>
        <label for="genre"></label>
            <!-- Genre -->
<?php
                $sql = "Select * from genre order by name ASC";
                $allGenres= mysqli_query($conn, $sql);
                // $currentGenreNumber = 0;
?>
                <table border="1">
<?php
                while( $currentGenre = mysqli_fetch_assoc($allGenres)) {
?>
                    <tr>
<?php
                        // $currentGenreNumber++;
                        // if($currentGenreNumber % 6 == 0) {
                        //     echo("<br>");
                        // }
                    
?>
                        <td>
<?php
                            echo (ucfirst($currentGenre["name"]));
?>
                        </td>
                        <td>
                            <input type="checkbox" name="" id="">
                        </td>
                    </tr>
<?php   
                }
?>

                </table>
            <br><br>
        <label>
            Release Year
            <select name="" id="">
<?php
                for($currentYear = 2022; $currentYear >= 1905; $currentYear--) {        
?>
            <option value=""><?php echo( $currentYear ); ?></option>
            <?php
                } 
            ?>
            </select><br><br>
        </label>
        <input type="submit" value="Add Movie">
    </form>
</body>
</html>