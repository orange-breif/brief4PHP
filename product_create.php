<?php
include('config.php');

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
    
        if ($brand_row = mysqli_fetch_assoc($brand_result)) {
            $brand_id = $brand_row['brand_id'];
        }
    
        if ($categories_row = mysqli_fetch_assoc($categories_result)) {
            $categories_id = $categories_row['cat_id'];
        }
    
        if ($status_row = mysqli_fetch_assoc($status_result)) {
            $status_id = $status_row['stat_id'];
        }
    
        $target_dir = "img/";
        $profileImageName = basename($_FILES["profileimage"]["name"]);
        $target_file = $target_dir . $profileImageName;
    
        // remove duplicated address, username
        if (move_uploaded_file($_FILES["profileimage"]["tmp_name"], $target_file)) {
            // Image upload successful
            $sql = "INSERT INTO tb_products (prd_name, prd_img, prd_price, prd_categories, prd_description, prd_status, prd_brand) VALUES 
                                            ('$name', '$profileImageName', '$price', '$categories_id', '$description', '$status_id', '$brand_id')";
            if (mysqli_query($conn, $sql)) {
                echo '<script> alert("Product inserted successfully!") </script>';
                header('Location: admin_products.php');
                exit;
            } else {
                echo '<script> alert("Product insertion failed!") </script>';
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo '<script> alert("Choose product image!") </script>';
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
    <!-- link to bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- link to css -->
    <link rel="stylesheet" href="css/create.css">
    <title>create</title>
    <style>
        /* product image css */
        #profiledisplay {
            width: 400px;
            height: 300px;
            margin: 20px auto;
            display: block;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <div class="container my-5">
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3 text-center">
                <img id="profiledisplay" onclick="triggerClick()" src="img/product_img.PNG" alt="Preview product image">
                <label class="form-label">Product Image</label>
                <input type="file" placeholder="Choose your product image" style="display: none;" class="form-control" name="profileimage" id="profileimage" onchange="displayImage(this)">
                <p class="note"><?php echo $msg_img; ?></p>
            </div>
            <div class="form-group">
                <label class="form-label">Product Name</label>
                <input type="text" placeholder="Enter name" class="form-control" name="name" id="name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
                <p class='note'> <?php echo $msg_name; ?> </p>
            </div>
            <div class="form-group">
                <label class="form-label">Price</label>
                <input type="number" placeholder="Enter Price" class="form-control" name="price" id="price" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>">
                <p class='note'> <?php echo $msg_price; ?> </p>
            </div>
            <div class="form-group">
                <label class="form-label">Categories</label>
                <?php
                $sql = "SELECT cat_name FROM tb_categories";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Check if the query was successful
                if ($result) {
                    echo '<select name="dropdowncate" class="form-control">';
                    echo '<option value="">Select an option</option>';

                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['cat_name'];
                        echo '<option value="' . $name . '">' . $name . '</option>';
                    }

                    echo '</select>';
                } else {
                    echo 'Error: ' . mysqli_error($conn);
                }
                ?>
                <p class='note'> <?php echo $msg_cate; ?> </p>
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
                    echo '<option value="">Select an option</option>';

                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['stat_name'];
                        echo '<option value="' . $name . '">' . $name . '</option>';
                    }

                    echo '</select>';
                } else {
                    echo 'Error: ' . mysqli_error($conn);
                }
                ?>
                <p class='note'> <?php echo $msg_status; ?> </p>
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
                    echo '<option value="">Select an option</option>';

                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['brand_name'];
                        echo '<option value="' . $name . '">' . $name . '</option>';
                    }

                    echo '</select>';
                } else {
                    echo 'Error: ' . mysqli_error($conn);
                }
                ?>
                <p class='note'> <?php echo $msg_brand; ?> </p>
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <input type="text" placeholder="Enter Description" class="form-control" name="description" id="description" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>">
                <p class='note'> <?php echo $msg_desc; ?> </p>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">insert product</button>
            <button type="submit" class="btn btn-primary" name="back">back to dashboard</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- <script src="/5-5-2023 (login-signup + admin page)/js/signup.js"></script> -->

    <script src="js/profileimg.js"></script>





</body>

</html>