<?php 
require "function.php";

$massgerror = '';

if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $object = new Login ();
  $result = $object->login($email ,$password);

  if($result == 1){
    echo "<script> alert('Login Successful'); </script>";
    $_SESSION['email']= $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    header("location: profile.php");
    exit();
  } else if($result == 10){
    $massgerror = "Username or Email Has Already Taken";
  } else {
    $massgerror = "Invalid Email or Password";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="css/style.css">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- font awesome -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
<?php include "header.php";?>
<form method="POST" >
  <div class="container">
    <label for="uname"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password">
    
    <p class="error1" style="color:#f44336"><?php echo $massgerror; ?></p>
    
    <button name="submit" type="submit" class="btn btn-danger">Login</button>
  </div>
</form>
<footer>
    <?php include "footer.php" ?>
  </footer>
</body>
</html>
