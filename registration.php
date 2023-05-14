<?php
include('function.php');


$register = new Register();
$msg_img = $msg_fname = $msg_lname = $msg_email = $msg_mobile = $msg_pass = $msg_cpass = "";
$bool = true;

//Input fields validation  
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //image validation
    $profileImageName = time() . '-' . $_FILES["profileimage"]["name"];
    // For image upload
    $target_dir = "img/";
    $target_file = $target_dir . basename($profileImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if ($_FILES['profileimage']['size'] > 1000000) {
        $msg_img = "Image size should not be greated than 1000Kb";
    }
    // check if file exists
    if (file_exists($target_file)) {
        $msg_img = "File already exists";
    }
    // Upload image only if no errors




    //full name Validation four parts  
    if (empty($_POST["fname"])) {
        $msg_fname = "First Name is required";
        $bool = false;
    } else {
        $fname = input_data($_POST["fname"]);
    }

    if (empty($_POST["lname"])) {
        $msg_lname = "Last Name is required";
        $bool = false;
    } else {
        $lname = input_data($_POST["lname"]);
    }


    // email validation
    if (empty($_POST["email"])) {
        $msg_email = "email is required";
        $bool = false;
    } else {
        $email = input_data($_POST["email"]);
        if (!preg_match('/^[\w.-]+@(gmail|yahoo|hotmail).com$/', $email)) {
            $msg_email = "Invalid email format";
        }
    }

    //mobile Validation  
    if (empty($_POST["mobile"])) {
        $msg_mobile = "mobile is required";
        $bool = false;
    } else {
        $mobile = input_data($_POST["mobile"]);
        if (!preg_match('/^07\d{8}$/', $mobile)) {
            $msg_mobile = "Invalid mobile number";
        }
    }



    //passworrd Validation  
    if (empty($_POST["password"])) {
        $msg_pass = "passsword is required";
        $bool = false;
    } else {
        $password = input_data($_POST["password"]);
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{6,}$/', $password)) {
            $msg_pass = "password should contain at least one special character, one lower case, one upper case, and one number.";
        }
    }

    //confirm passworrd Validation  
    if (empty($_POST["cpassword"])) {
        $msg_cpass = "passsword is required";
        $bool = false;
    } else {
        $cpassword = input_data($_POST["cpassword"]);
        if ($cpassword != $password) {
            $msg_cpass = "doesn't match the password";
        }
    }
}
function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_POST['submit'])) {
    if ($bool == true) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $img = $_FILES['profileimage'];
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];

        $cpassword = $_POST['cpassword'];   

        $target_dir = "img/";
        $profileImageName = basename($_FILES["profileimage"]["name"]);
        $target_file = $target_dir . $profileImageName;

        // remove duplicated addresss, user name
        if (move_uploaded_file($_FILES["profileimage"]["tmp_name"], $target_file)) {
            $result = $register->registration($fname, $lname, $email, $password, $mobile, $profileImageName, $cpassword);

            if ($result == 1) {
                // echo "<script> alert('Registration Successful'); </script>";
            } elseif ($result == 10) {
                $error = "Username or Email Has Already Taken";
            } elseif ($result == 100) {
                $error = "Password Does Not Match";
            }
        } else {
            echo '<script> alert("choose profile img") </script>';
        }
    }
}
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
    <!-- link to bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- link to css -->
    <link rel="stylesheet" href="registration.css">
    <title>signup</title>
    <link rel="stylesheet" href="style.css">
    <!-- style for the img -->
    <link rel="stylesheet" href="css/create.css">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- font awesome -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>

<body>
    <?php include "header.php"; ?>
    <div class="container my-5">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3 text-center">
                <img id="profiledisplay" onclick="triggerClick()" src="img/profile.PNG" alt="Preview profile image">
                <label class="form-label">Profile Image</label>
                <input type="file" placeholder="Choose your profile image" style="display: none;" class="form-control" name="profileimage" id="profileimage" onchange="displayImage(this)">
                <p class="note"><?php echo $msg_img; ?></p>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">First Name</label>
                    <input type="text" placeholder="Enter first name" class="form-control" name="fname" id="fname" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>">
                    <p class='note'> <?php echo $msg_fname; ?> </p>
                </div>
                <div class="col">
                    <label class="form-label">Last Name</label>
                    <input type="text" placeholder="Enter last name" class="form-control" name="lname" id="lname" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>">
                    <p class='note'> <?php echo $msg_lname; ?> </p>
                </div>

            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" placeholder="Enter email" class="form-control" name="email" id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                <p class='note'> <?php echo $msg_email; ?> </p>
            </div>
            <div class="mb-3">
                <label class="form-label">Mobile phone</label>
                <input type="text" placeholder="Enter Mobile phone" class="form-control" name="mobile" id="mobile" value="<?php if (isset($_POST['mobile'])) echo $_POST['mobile']; ?>">
                <p class='note'> <?php echo $msg_mobile; ?> </p>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" placeholder="Enter Passsword" class="form-control" name="password" id="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
                <p class='note'> <?php echo $msg_pass; ?> </p>
            </div>
            <div class="mb-3">
                <label class="form-label">Password Confarmation</label>
                <input type="text" placeholder="Enter Passsword Confarmation" class="form-control" name="cpassword" id="cpassword" value="<?php if (isset($_POST['cpassword'])) echo $_POST['cpassword']; ?>">
                <p class='note'> <?php echo $msg_cpass; ?> </p>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">signup</button>
            <button type="submit" class="btn btn-primary" name="back">back to dashboard</button>
        </form>
    </div>



    <!-- link to bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <!-- <script src="/5-5-2023 (login-signup + admin page)/js/signup.js"></script> -->

    <!-- link to js for the image -->
    <script src="js/profileimg.js"></script>



    <footer>
        <?php include "footer.php" ?>
    </footer>

</body>

</html>