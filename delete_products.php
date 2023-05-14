<?php
    include('config.php');
    if (isset($_GET['deleteid'])) {
        $id = $_GET['deleteid'];
        $sql = "DELETE FROM `tb_products` WHERE prd_id = $id";
        $result = mysqli_query($conn,$sql);
        if ($result) {
            header('location: admin_products.php');
        } else {
            echo "Error deleting data";
        }
    }
?>