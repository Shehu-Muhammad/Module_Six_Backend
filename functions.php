<?php
function checkId($conn, $id) {
    $sql = "SELECT * FROM details WHERE id= ".$id;
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 0) {
        header("Location: index.php?Failure=StopTryingToHackMe");
    }
}
?>