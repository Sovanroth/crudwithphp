<?php
require '../models/Post.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    $file = isset($_FILES['file']) ? $_FILES['file'] : null;
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode(".", $filename);
    $fileActualExt = strtolower(end($fileExt));

    // if (in_array($fileActualExt, $allow)) {

    if (!$title && !$content && !$file) {
        echo 'Please fill in at least one field or upload a file.';
        exit();
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $fileExtension = isset($file['name']) ? strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) : '';
    $isValidExtension = in_array($fileExtension, $allowedExtensions, true);
    $isFileUploaded = isset($file['tmp_name']) && $file['error'] === UPLOAD_ERR_OK;
    
    if ($file && $isValidExtension && $isFileUploaded) {
        $fileNameNew = uniqid('', true) . '.' . $fileExtension;
        $fileDestination = "uploads/$fileNameNew";
        move_uploaded_file($file['tmp_name'], $fileDestination);
        $photoUrl = "http://localhost:8888/rupp2023ys2/server/$fileDestination";
    }

    if ($title && $content) {
        $query = "UPDATE tb_posts SET title='$title', content='$content'";
        if ($photoUrl) {
            $query .= ", photo='$photoUrl'";
        }
        $query .= " WHERE id='$id'";
    } elseif ($title) {
        $query = "UPDATE tb_posts SET title='$title'";
        if ($photoUrl) {
            $query .= ", photo='$photoUrl'";
        }
        $query .= " WHERE id='$id'";
    } elseif ($content) {
        $query = "UPDATE tb_posts SET content='$content'";
        if ($photoUrl) {
            $query .= ", photo='$photoUrl'";
        }
        $query .= " WHERE id='$id'";
    } else { // Only file uploaded
        $query = "UPDATE tb_posts SET photo='$photoUrl' WHERE id='$id'";
    }

    if (mysqli_query($db, $query)) {
        echo 'Successfully updated.';
        header('Location: ../admin/posts.php');
        exit();
    } else {
        echo 'Error updating post: ' . mysqli_error($db);
    }
}
