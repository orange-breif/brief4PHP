<?php
include('config.php');

$msg_name ="";
$bool = true;

if (isset($_POST['submit'])) {
    if ($bool == true) {
        $name = $_POST['category'];

            $sql = "INSERT INTO `tb_categories`(`cat_name`) VALUES ('$name')";
            if (mysqli_query($conn, $sql)) {
                echo '<script> alert("data inserted successfully!") </script>';
                header('Location: categories.php');
                exit;
            } else {
                echo '<script> alert("registered failed!") </script>';
                echo "Error: " . mysqli_error($conn);
            }
    }
}
if (isset($_POST['back'])) {
    header('Location: categories.php');
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link to bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- link to css -->
    <link rel="stylesheet" href="css/create.css">
    <title>create</title>

</head>

<body>
    <div class="container my-5">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">category name</label>
                <input type="text" placeholder="Enter category name" class="form-control" name="category" id="category" value="<?php if (isset($_POST['category'])) echo $_POST['category']; ?>">
                <p class='note'> <?php echo $msg_name; ?> </p>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">insert category</button>
            <button type="submit" class="btn btn-primary" name="back">back to dashboard</button>
        </form>
    </div>



    <!-- link to bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <!-- <script src="/5-5-2023 (login-signup + admin page)/js/signup.js"></script> -->

    <!-- link to js for the image -->
    <script src="js/profileimg.js"></script>





</body>

</html>