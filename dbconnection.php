<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "emailverification";

$conn = mysqli_connect($server, $user, $password, $database);

if($conn){
    ?>
        <script>
            alert("Connection Successfull");
        </script>
    <?php
} else{
    ?>
        <script>
            alert("No Connection");
        </script>
    <?php
}

?>