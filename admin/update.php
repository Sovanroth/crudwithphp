<?php
require_once '../models/Post.php';

$id = $_GET['id'];
// var_dump($id);

$qa = "SELECT * FROM tb_posts WHERE id = '$id'";

$posts = mysqli_query($db, $qa)->fetch_assoc();
// $data = mysqli_query($db, $q);

// Query all posts from table
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Clean Blog - Register</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Main Content-->
    <main class="mb-4 mt-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <h2>Update</h2>
                    <div class="my-5">
                        <form action="../server/edit.php" method="POST" enctype="multipart/form-data">
                            <?php
                            // echo "Old title:";
                            // echo '' . $posts['title'] . '';


                            ?>
                            <input type="hidden" name="from" value="frmRegister" />
                            <div class="form-floating">
                                <input name="id" type="hidden" value = "<?= $posts['id'] ?>" placeholder="Enter your email..." />

                            </div>
                            <div class="form-floating">
                                <input class="form-control" name="title" type="text" placeholder="Enter your email..." />
                                <label for="email">title</label>
                            </div>
                            <?php
                            // echo "Old Content:";
                            // echo '' . $posts['content'] . '';


                            ?>
                            <div class="form-floating">
                                <input class="form-control" name="content" type="text" placeholder="Enter password..." />
                                <label for="password">content</label>
                            </div>
                            <?php
                            // echo "Old Content:";
                            // echo '<img class = "w-25" src="' . $posts['photo'] . '" />';


                            ?>
                            <div class="form-floating">
                                <input class="form-control" name="file" type="file" placeholder="Photo..." />
                                <label for="confirmPassword">Enter file</label>
                            </div>
                            <br />

                            <button class="btn btn-primary text-uppercase" name="submit" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>