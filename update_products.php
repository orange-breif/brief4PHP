<?php
include('config.php');
$id = $_GET['updateid'];
$msg_img = $msg_name = $msg_price = $msg_status = $msg_cate = $msg_brand = $msg_desc =  "";

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





    //product name Validation  
    if (empty($_POST["name"])) {
        $msg_name = "Name is required";
        $bool = false;
    } else {
        $name = input_data($_POST["name"]);
    }




    // price validation
    if (empty($_POST["price"])) {
        $msg_price = "price is required";
        $bool = false;
    } else {
        $price = input_data($_POST["price"]);
    }


    //category Validation  
    if (empty($_POST["dropdowncate"])) {
        $msg_cate = "category is required";
        $bool = false;
    } else {
        $categories = input_data($_POST["dropdowncate"]);
    }



    //status Validation  
    if (empty($_POST["dropdownbrand"])) {
        $msg_brand = "brand is required";
        $bool = false;
    } else {
        $brand = input_data($_POST["dropdownbrand"]);
    }


    //status Validation  
    if (empty($_POST["dropdownstatus"])) {
        $msg_status = "status is required";
        $bool = false;
    } else {
        $status = input_data($_POST["dropdownstatus"]);
    }

    //status Validation  
    if (empty($_POST["description"])) {
        $msg_desc = "description is required";
        $bool = false;
    } else {
        $description = input_data($_POST["description"]);
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

        $name = $_POST['name'];
        $price = $_POST['price'];
        $img = $_FILES['profileimage'];
        $status = $_POST['dropdownstatus'];
        $brand = $_POST['dropdownbrand'];
        $categories = $_POST['dropdowncate'];
        $description = $_POST['description'];

        $brand_result = mysqli_query($conn, "SELECT `brand_id` FROM `tb_brand` WHERE `brand_name`='$brand'");
        $categories_result = mysqli_query($conn, "SELECT `cat_id` FROM `tb_categories` WHERE `cat_name`='$categories'");
        $status_result = mysqli_query($conn, "SELECT `stat_id` FROM `tb_status` WHERE `stat_name`='$status'");



        $target_dir = "img/";
        $profileImageName = basename($_FILES["profileimage"]["name"]);
        $target_file = $target_dir . $profileImageName;

        // Remove duplicated addresss and usernames
        if (move_uploaded_file($_FILES["profileimage"]["tmp_name"], $target_file)) {
            // Image upload successful

            $sql = "UPDATE `tb_products` SET `prd_name`='$name',`prd_img`='$profileImageName',`prd_price`='$price',
            `prd_categories`='$categories_result',`prd_description`='$description',`prd_status`='$status_result',`prd_brand`='$brand_result' WHERE `prd_id` = $id";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo '<script> alert("Data updated successfully!") </script>';
                header('Location: admin_products.php');
                exit;
            } else {
                echo '<script> alert("Update failed!") </script>';
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            $sql = "UPDATE `tb_products` SET `prd_name`='$name',`prd_price`='$price',
            `prd_categories`='$categories_result',`prd_description`='$description',`prd_status`='$status_result',`prd_brand`='$brand_result' WHERE `prd_id` = $id";
            $result = mysqli_query($conn, $sql);


            if ($result) {
                echo '<script> alert("Data updated successfully!") </script>';
                header('Location: admin_products.php');
                exit;
            } else {
                echo '<script> alert("Update failed!") </script>';
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}
if (isset($_POST['back'])) {
    header('Location: admin_products.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>update</title>
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

        /* product image css */
        #profiledisplay {
            width: 400px;
            height: 300px;
            margin: 20px auto;
            display: block;
            border-radius: 5px;
        }
    </style>
    </style>

</head>

<body>
    <div class="container my-5">
        <form method="post" enctype="multipart/form-data">
            <?php
            $sql = "SELECT * FROM `tb_products` WHERE prd_id  = $id ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $brand_result =  $row['prd_brand'];
            $categories_result = $row['prd_categories'];
            $status_result = $row['prd_status'];


            ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3 text-center">
                <img id="profiledisplay" onclick="triggerClick()" src="<?php echo 'img/' . $row['prd_img'] ?>" alt="Preview profile image">
                <label class="form-label">Profile Image</label>
                <input type="file" placeholder="Choose your profile image" style="display: none;" class="form-control" name="profileimage" id="profileimage" onchange="displayImage(this)">
                <p class="note"><?php echo $msg_img; ?></p>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" placeholder="Enter name" class="form-control" name="name" id="name" value="<?php echo $row['prd_name']; ?>">
                <p class='note'> <?php echo $msg_name; ?> </p>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" placeholder="Enter Price" class="form-control" name="price" id="price" value="<?php echo $row['prd_price']; ?>">
                <p class='note'> <?php echo $msg_price; ?> </p>
            </div>
            <div class="form-group">
                <label class="form-label">Categories</label>
                <?php
                $sql = "SELECT cat_id, cat_name FROM tb_categories";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Check if the query was successful
                if ($result) {
                    echo '<select name="dropdowncate" class="form-control">';
                    $selectedCategory = ""; // Variable to store the selected category

                    while ($row = mysqli_fetch_assoc($result)) {
                        $catId = $row['cat_id'];
                        $catName = $row['cat_name'];

                        if ($catId == $categories_result) {
                            $selectedCategory = $catId;
                            echo '<option value="' . $catId . '" selected>' . $catName . '</option>';
                        } else {
                            echo '<option value="' . $catId . '">' . $catName . '</option>';
                        }
                    }

                    echo '</select>';

                    if (empty($selectedCategory)) {
                        echo '<p class="note">' . $msg_cate . '</p>';
                    }
                } else {
                    echo 'Error: ' . mysqli_error($conn);
                }
                ?>
            </div>


            <!-- ... existing code ... -->

            <div class="form-group">
                <label class="form-label">Status</label>
                <?php
                $sql = "SELECT stat_name FROM tb_status";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Check if the query was successful
                if ($result) {
                    echo '<select name="dropdownstatus" class="form-control">';
                    $selectedStatus = ""; // Variable to store the selected status

                    while ($row = mysqli_fetch_assoc($result)) {
                        $statusName = $row['stat_name'];

                        if ($statusName == $status_result) {
                            $selectedStatus = $statusName;
                            echo '<option value="' . $statusName . '" selected>' . $statusName . '</option>';
                        } else {
                            echo '<option value="' . $statusName . '">' . $statusName . '</option>';
                        }
                    }

                    echo '</select>';

                    if (empty($selectedStatus)) {
                        echo '<p class="note">' . $msg_status . '</p>';
                    }
                } else {
                    echo 'Error: ' . mysqli_error($conn);
                }
                ?>
            </div>

            <!-- ... existing code ... -->

            <div class="form-group">
                <label class="form-label">Brand</label>
                <?php
                $sql = "SELECT brand_name FROM tb_brand";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Check if the query was successful
                if ($result) {
                    echo '<select name="dropdownbrand" class="form-control">';
                    $selectedBrand = ""; // Variable to store the selected brand

                    while ($row = mysqli_fetch_assoc($result)) {
                        $brandName = $row['brand_name'];

                        if ($brandName == $brand_result) {
                            $selectedBrand = $brandName;
                            echo '<option value="' . $brandName . '" selected>' . $brandName . '</option>';
                        } else {
                            echo '<option value="' . $brandName . '">' . $brandName . '</option>';
                        }
                    }

                    echo '</select>';

                    if (empty($selectedBrand)) {
                        echo '<p class="note">' . $msg_brand . '</p>';
                    }
                } else {
                    echo 'Error: ' . mysqli_error($conn);
                }
                ?>
            </div>

            <?php
            $sql = "SELECT * FROM `tb_products` WHERE prd_id  = $id ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" placeholder="Enter Description" class="form-control" name="description" id="description" value="<?php echo $row['prd_description']; ?>">
                <p class='note'> <?php echo $msg_desc; ?> </p>
            </div>
            <div class="buttons">
                <button type="submit" class="btn btn-primary" name="submit"> update</button>
                <button type="submit" class="btn btn-primary" name="back">back to dashboard</button>
            </div>


        </form>
    </div>

    <script src="js/profileimg.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>