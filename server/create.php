<?php

require_once '../models/Post.php';

// create a new instance of mysqli and connect to the database
$mysqli = new mysqli("localhost", "root", "root", "lab");

// check for errors in connecting to the database
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if (isset($_POST['submit'])) {

    $title  = $_POST['title'];
    $content = $_POST['content'];
    $file = $_FILES['file'];
    $filename = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode(".", $filename);
    $fileActualExt = strtolower(end($fileExt));

    $allow = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allow)) {
        if ($fileError === 0) {

            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = "uploads/" . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);

            $url = "http://localhost:8888/rupp2023ys2/server/" . $fileDestination;

            // prepare a SQL statement for inserting a new post into the database
            $stmt = $mysqli->prepare("INSERT INTO tb_posts (`title`, `content`, `photo`) VALUES (?, ?, ?)");

            // bind the values to the statement
            $stmt->bind_param("sss", $title, $content, $url);

            // execute the statement and check for errors
            if ($stmt->execute()) {
                header("Location: ../admin/posts.php");
                exit();
            } else {
                echo '
                   <script>
                   alert("Error '.$mysqli->error.'");
                   </script>
                   ';
            }
        }
    } else {
        echo '
            <script>
            alert("It is not the type of the allow file.");
            </script>
            ';
    }
}
$mysqli->close();
