<?php
    include('config.php');
    if (isset($_GET['deleteid'])) {
        $id = $_GET['deleteid'];
        $sql = "DELETE FROM `tb_categories` WHERE user_id  = $id";
        $result = mysqli_query($conn,$sql);
        if ($result) {
            header('location: categories.php');
        } else {
            echo "Error deleting data";
        }
    }
?>