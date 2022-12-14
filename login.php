<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <?php include 'css/style.php' ?>
    <?php include 'links/links.php' ?>

</head>

<body>

    <?php
    include 'dbconnection.php';

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email_search = " select * from registration where email='$email' ";
        $query = mysqli_query($conn, $email_search);

        $email_count = mysqli_num_rows($query);

        if($email_count){
            $email_pass = mysqli_fetch_assoc($query);

            $db_pass = $email_pass['password'];

            $_SESSION['username'] = $email_pass['username'];

            $pass_deccode = password_verify($password, $db_pass);

            if($pass_deccode){
                // echo "Login susseccful";
                // header('location: home.php');

                ?>
                    <script>
                        alert("Login succefull");
                        location.replace("home.php"); 
                    </script>
                <?php
                // echo "Login successful";
            } else{
                ?>
                    <script>
                        alert("Password incorrect")
                    </script>
                <?php
                // echo "password incorrect";
            }
        } else{
            ?>
                <script>
                    alert("Invalid Email")
                </script>
            <?php
            // echo "Invalid Email";
        }
    }

    ?>

    <div class="card bg-light">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <h4 class="card-titile mt-3 text-center">Create Account</h4>
            <p class="text-center">Get startes with your free account</p>
            <p>
                <a href="" class="btn btn-block btn-gmail"><i class="fa fa-google"></i> Login vie Gmail</a>
                <a href="" class="btn btn-block btn-facebook"><i class="fa fa-facebook"></i> Login vie Facebook</a>
            </p>
            <p class="divider-text">
                <span class="bg-light">OR</span>
            </p>
            
            <div>
                <p class="bg-success text-white px-4"> <?php 
                
                    if(isset($_SESSION['msg'])){
                        echo $_SESSION['msg']; 
                    } else{
                        echo $_SESSION['msg'] = "You are logged out. Please login again."; 
                    }
                
                ?> </p>
            </div>

            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" value="">
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-block"> Login </button>
                    <p class="text-center mt-3"> Have an account? <a href="registration.php">Sign Up here</a></p>
                </div>
            </form>
        </article>
    </div>


</body>

</html>