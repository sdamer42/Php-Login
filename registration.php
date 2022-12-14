<?php

session_start();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Signup</title>
    <?php  include 'links/links.php' ?>
</head>

<body class="container ">

    <?php include 'dbconnection.php'  ?>
    <?php
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $mobile =  $_POST['mobile'];
        $password = $_POST['password'];
        $cpassword =  $_POST['cpassword'];

        $pass = password_hash($password, PASSWORD_BCRYPT);
        $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

        $token = bin2hex(random_bytes(15));

        $emailquery = "SELECT * FROM `registration` WHERE email='$email' ";
        $query = mysqli_query($conn, $emailquery);

        $emailCount = mysqli_num_rows($query);

        if($emailCount > 0){
            ?>
    <script>
    alert("email already exists");
    </script>
    <?php
        } else {
            if($password === $cpassword){

                // $insertquery = "insert into registration(username, email, mobile, password, cpassword) values('$username', '$email', '$mobile', '$pass', '$cpass')";

                $insertquery = "INSERT INTO `registration` (`username`, `email`, `mobile`, `password`, `cpassword`, `token`, `status`) VALUES ('$username', '$email', '$mobile', '$pass', '$cpass', '$token', 'inactive')";

                $iquery = mysqli_query($conn, $insertquery);

                if($iquery){
                
                $subject = "Email Activation";
                $body = "Hi, $username. Click here to activate your account                 
                http://localhost/emailverification/activate.php?token=$token ";
                $headers = "From: syedtest1212@gmail.com";

                if(mail($email, $subject, $body, $headers)){
                    $_SESSION['msg'] = "Check your mail to activate your account $email";
                    header('location: login.php');
                } else{
                    echo "Email sending failed...";
                }


                } else{
                    ?>
                        <script>
                        alert("No Inserted");
                        </script>
                    <?php
                }

            }else {
                ?>
    <script>
    alert("password are not matching");
    </script>
    <?php

            }
        }

    }

    ?>



    <h2 class="text-center">Create Account</h2>

    <div class="d-flex justify-content-center align-items-center" ">
        <form action=" <?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST"
        class=" border px-4 py-1 border-3 rounded rounded-3 border-warning">
        <h3>User Login</h3>
        <div class="mt-1">
            <button class="btn btn-warning w-100">Login via Gmail</button>
        </div>
        <div class="mt-1">
            <button class="btn btn-warning w-100">Login via facebook</button>
        </div>
        <div class="mt-1">
            <label class="form-label" for="username">User Name</label>
            <div>
                <input class="form-control" type="text" name="username" required>
            </div>
        </div>
        <div class="mt-1">
            <label class="form-label" for="email">Email adress</label>
            <div>
                <input class="form-control" type="email" name="email" required>
            </div>
        </div>
        <div class="mt-1">
            <label class="form-label" for="mobile">Phone number</label>
            <div>
                <input class="form-control" type="text" name="mobile" required>
            </div>
        </div>
        <div class="mt-1">
            <label class="form-label" for="password">Create Password</label>
            <div>
                <input class="form-control" type="password" name="password" required>
            </div>
        </div>
        <div class="mt-1">
            <label class="form-label" for="cpassword">Repeat Password</label>
            <div>
                <input class="form-control" type="password" name="cpassword" required>
            </div>
        </div>
        <div class="mt-2">
            <button type="submit" name="submit" class="btn btn-warning w-100">Create Account</button>
        </div>
        <p class="">Have an account? <a href="login.php">Log In</a></p>
        </form>
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>


</body>

</html>