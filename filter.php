<?php 
require "conn.php";
$value=$_GET['value'];

//filter products 
if(isset($_POST['price_range']) && isset($_POST['Brand_range'])) {
    $price_range = explode('-', $_POST['price_range']);
    $min_price = $price_range[0];
    $max_price = isset($price_range[1]) && !empty($price_range[1]) ? $price_range[1] : PHP_INT_MAX;
    $brand = $_POST['Brand_range'];

    if ($brand == 'all') {
        $query = "SELECT * FROM tb_products WHERE `prd_price` BETWEEN '$min_price' AND '$max_price'";
    } else {
        $query= "SELECT * FROM tb_products WHERE `prd_Brand`='$brand' AND `prd_price` BETWEEN '$min_price' AND '$max_price'";
    }
} else if(isset($_POST['price_range'])) {
    $price_range = explode('-', $_POST['price_range']);
    $min_price = $price_range[0];
    $max_price = isset($price_range[1]) && !empty($price_range[1]) ? $price_range[1] : PHP_INT_MAX;
    $query = "SELECT * FROM tb_products WHERE `prd_price`  BETWEEN '$min_price' AND '$max_price'";
} else if (isset($_POST['Brand_range'])) {
    $brand = $_POST['Brand_range'];
    if ($brand == 'all') {
        $query = "SELECT * FROM tb_products";
    } else {
        $query= "SELECT * FROM tb_products WHERE `prd_Brand`='$brand'";
    }
} else {
    $query = "SELECT * FROM tb_products WHERE 1 LIMIT 10";
}

$result = mysqli_query($conn, $query);

if (!$result) {
    // handle query error
    echo "Error: " . mysqli_error($conn);
    exit;
}

?>


<!-- filter html-->
<!DOCTYPE html>
<html>
<head>
<title>Products</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="style.css">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- font awesome -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
    <?php
    include "navbar.php";
    ?>
<div class="container">

<span class="material-symbols-outlined mt-5 ms-5">
filter_alt
</span>
    <label class="text-danger ms-5"><h3 >Filter by</h3></label>
    <br><br>
<form method="post"  class="d-flex ms-5">
  <label class="m-2" for="">Price:</label>
  <div class="custom-select">
    <select name="price_range" class="me-2" onchange="this.form.submit()">
    <option value="all" name="all_products" <?php if(!isset($_POST['price_range']) || $_POST['price_range'] == 'all') echo 'selected'; ?>>All items</option>
      <option value="0-100" <?php if(isset($_POST['price_range']) && $_POST['price_range']=='0-100') echo 'selected'; ?>>0.00-100.00$</option>
      <option value="100-200" <?php if(isset($_POST['price_range']) && $_POST['price_range']=='100-200') echo 'selected'; ?>>100.00-200.00$</option>
      <option value="200-300" <?php if(isset($_POST['price_range']) && $_POST['price_range']=='200-300') echo 'selected'; ?>>200.00-300.00$</option>
    </select>
  </div>
  
  <div class="custom-select">
  <label class="m-2" for="">Brand:</label>
    <select name="Brand_range" onchange="this.form.submit()" >
    <option value="all" name="all_products"  <?php if(!isset($_POST['Brand_range']) || $_POST['price_range'] == 'all') echo 'selected'; ?>>All items</option>
      <option value="Apple" <?php if(isset($_POST['Brand_range']) && $_POST['Brand_range']=='Apple' ) echo 'selected'; ?>>Apple</option>
      <option value="Samsung"<?php if(isset($_POST['Brand_range'])&& $_POST['Brand_range']=='Samsung') echo 'selected'; ?>>Samsung</option>
      <option value="Huawei" <?php if(isset($_POST['Brand_range'])&& $_POST['Brand_range']=='Huawei') echo 'selected'; ?>>Huawei</option>
    </select>
  </div>
</form>

<section class="product"> 
                <div class="product_container_cat">
                <?php

        while($row = mysqli_fetch_array($result)){  
            ?>
                    <div class="product-card mb-5">
                        <div class="product-image">
                        <img src="<?php echo 'images/'.$row['prd_img'];?>" class="product-thumb" alt="">
                            <button class="card-btn">add to cart</button>
                        </div>
                        <div class="product-info">
                        <h2 class="product-brand"><?php echo $row['prd_brand']; ?></h2>
                            <p class="product-short-description"><?php echo $row['prd_description']; ?></p>
                            <span class="price">$<?php echo $row['prd_price']; ?> </span><span><button type="button" class="btn btn-secondary ms-2">View <?php $row['prd_id']; ?></button></span>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </section>
</div>
<br>
<footer>
    <?php
    include "footer.html";
    ?>
</footer>
    <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>  
</body>
</html>