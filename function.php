<?php
session_start();

class Connection
{
  public $host = "localhost";
  public $user = "root";
  public $password = "";
  public $db_name = "ecommerce";

  public $conn;

  public function __construct()
  {
    $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
  }
}

class Register extends Connection
{
  public function registration($fname, $lname, $email, $password, $mobile, $profileImageName, $cpassword)
  {
    $duplicate = mysqli_query($this->conn, "SELECT * FROM tb_users WHERE user_email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
      return 10;
      // Username or email has already taken
    } else {
      if ($password == $cpassword) {
        $query = "INSERT INTO `tb_users`(`user_fname`, `user_lname`, `user_email`, `user_phone`, `user_img`, `user_password`) 
        VALUES ('$fname','$lname','$email','$mobile','$profileImageName','$password')";
        mysqli_query($this->conn, $query);
        $_SESSION['user_email'] = $email;
        $_SESSION['user_password'] = $password;
        header("location: index.php");
        return 1;
        // Registration successful
      } else {
        return 100;
        // Password does not match
      }
    }
  }
}

class Login extends Connection
{
    public $id;

    public function login($email, $password)
    {
        $adminQuery = "SELECT `user_id`, `role_id`, `user_fname`, `user_lname`, `user_phone` FROM tb_users WHERE user_email = '$email' AND user_password = '$password' AND role_id = 1";
        $adminResult = mysqli_query($this->conn, $adminQuery);

        $userQuery = "SELECT `user_id`, `role_id`, `user_fname`, `user_lname`, `user_phone`, `user_img`, `user_password` FROM tb_users WHERE user_email = '$email' AND role_id = 2";
        $userResult = mysqli_query($this->conn, $userQuery);

        $adminRow = mysqli_fetch_assoc($adminResult);
        $userRow = mysqli_fetch_assoc($userResult);

        if (mysqli_num_rows($adminResult) > 0) {
          $_SESSION['user_id'] = $adminRow['user_id'];
            $_SESSION['user_email'] = $email;
            $_SESSION['user_password'] = $password;
            header("location: admin_users.php");
            exit();
        } elseif (mysqli_num_rows($userResult) > 0) {
            if (!empty($userRow) && isset($userRow['user_password']) && $password == $userRow['user_password']) {
              $_SESSION['user_id'] = $userRow['user_id'];
              $_SESSION['user_email'] = $email;
              $_SESSION['user_password'] = $password;
                header("location: index.php");
                exit();
            } else {
                return 10;
                // Wrong password
            }
        } else {
            return 11;
            // User not found
        }
    }


  public function idUser()
  {
    return $this->id;
  }
}

class Select extends Connection
{
  public function selectUserById($id)
  {
    $result = mysqli_query($this->conn, "SELECT * FROM tb_users WHERE id = $id");
    return mysqli_fetch_assoc($result);
  }
}
