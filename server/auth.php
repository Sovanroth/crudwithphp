<?php
require '../models/Post.php';

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cofirm = $_POST['confirmPassword'];

    $query = "SELECT * from user_table WHERE email = '$email'";
    $d = mysqli_query($db, $query);
    if (mysqli_num_rows($d) > 0) {
        echo '
        <script>
        alert("Try another email, this email is used");
        </script>
       ';
    } else {
        if ($password == $cofirm) {
            $q = "INSERT INTO user_table(`name` ,`email`,`password`) VALUES('$name' , '$email' , '$password')";

            if (mysqli_query($db, $q)) {

                echo '
                <script>
                alert("Register Succesfully");
                </script>
                ';
                session_start();
                $_SESSION['auth'] = $_POST['email'];
                header("Location: ../index.php");
                exit();
            } else {
                echo '
               <script>
               alert("Error".mysqli_error($db));
               </script>
               ';
            }
        } else {
            echo '
             <script>
             alert("Your password and confirm password is incorrect");
             </script>
            ';
        }
    }
}
