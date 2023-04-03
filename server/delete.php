<?php

require '../models/Post.php';

// Check if post ID is set
if (isset($_GET['id'])) {
    // Sanitize post ID
    $id = $db->real_escape_string($_GET['id']);

    // Prepare delete query
    $deleteQuery = "DELETE FROM tb_posts WHERE id = $id";

    // Execute delete query
    if ($db->query($deleteQuery)) {
        // Redirect to posts page
        header("Location: ../admin/posts.php");
        exit();
    } else {
        // Display error message
        echo '<script>alert("Error: ' . $db->error . '");</script>';
    }
} else {
    // Display error message if post ID is not set
    echo '<script>alert("Error: Post ID not set.");</script>';
}

?>
