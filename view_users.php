<?php
include("config.php");

$id = $_GET['viewid'];


if (isset($_POST['back'])) {
    header('Location: admin_users.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>view</title>
    <style>
        .note {
            color: red;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            gap: 20px;
            justify-content: center;
            align-items: center;
            width: 600px;
            margin: auto;
            box-shadow: 0 0 10px #4886fa71;
            border-radius: 20px;
            padding-top: 20px;
            padding-bottom: 10px;
        }

        form {
            width: 90%;
        }

        button:hover {
            box-shadow: 0 0 10px #4887fa;
            cursor: pointer;
        }

        .buttons {
            display: flex;
            gap: 20px;
        }
        form input{
            pointer-events: none;
        }
    </style>

</head>

<body>
<div class="container my-5">
        <form method="post" enctype="multipart/form-data">
            <?php
            $sql = "SELECT * FROM `tb_users` WHERE user_id = $id ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3 text-center">
                <img id="profiledisplay" onclick="triggerClick()" src="<?php echo 'img/' . $row['user_img'] ?>" alt="Preview profile image" style="border-radius: 100px; width: 200px; height: 200px; margin: 20px auto; display: block;">
                <label class="form-label">Profile Image</label>
                <input type="file" placeholder="Choose your profile image" style="display: none;" class="form-control" name="profileimage" id="profileimage" onchange="displayImage(this)">
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">First Name</label>
                    <input type="text" placeholder="Enter first name" class="form-control" name="fname" id="fname" value="<?php echo $row['user_fname']; ?>">
                </div>
                <div class="col">
                    <label class="form-label">Last Name</label>
                    <input type="text" placeholder="Enter last name" class="form-control" name="lname" id="lname" value="<?php echo $row['user_lname']; ?>">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" placeholder="Enter email" class="form-control" name="email" id="email" value="<?php  echo $row['user_email']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Mobile phone</label>
                <input type="text" placeholder="Enter Mobile phone" class="form-control" name="mobile" id="mobile" value="<?php echo $row['user_phone']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" placeholder="Enter Passsword" class="form-control" name="password" id="password" value="<?php echo $row['user_password']; ?>">
            </div>
            <div class="buttons">
                <button type="submit" class="btn btn-primary" name="back">back to dashboard</button>
            </div>


        </form>
    </div>

    <script src="js/profileimg.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>