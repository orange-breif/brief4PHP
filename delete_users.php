<?php
    include('config.php');
    if (isset($_GET['deleteid'])) {
        $id = $_GET['deleteid'];
        $sql = "DELETE FROM `tb_users` WHERE user_id  = $id";
        $result = mysqli_query($conn,$sql);
        if ($result) {
            header('location: admin_users.php');
        } else {
            echo "Error deleting data";
        }
    }
?>