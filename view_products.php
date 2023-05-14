<?php
include("config.php");

$id = $_GET['viewid'];


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
            <?php
            $sql = "SELECT * FROM `tb_products` WHERE prd_id = $id ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3 text-center">
                <img id="profiledisplay"  src="<?php echo 'img/' . $row['prd_img'] ?>" alt="Preview profile image" >
                <label class="form-label">Profile Image</label>
                <input type="file" placeholder="Choose your profile image" style="display: none;" class="form-control" name="profileimage" id="profileimage">
            </div>
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" placeholder="Enter name" class="form-control" name="name" id="name" value="<?php echo $row['prd_name']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" placeholder="Enter Price" class="form-control" name="price" id="price" value="<?php echo $row['prd_price']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">categories ID</label>
                <input type="text" placeholder="Enter categories ID" class="form-control" name="categories" id="categories" value="<?php echo $row['prd_categories']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" placeholder="Enter Status" class="form-control" name="status" id="status" value="<?php echo $row['prd_status']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Brand</label>
                <input type="text" placeholder="Enter brand" class="form-control" name="brand" id="brand" value="<?php echo $row['prd_brand']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" placeholder="Enter Description" class="form-control" name="description" id="description" value="<?php echo $row['prd_description']; ?>">
            </div>
            <div class="buttons">
                <button type="submit" class="btn btn-primary" name="back">back to dashboard</button>
            </div>


        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>