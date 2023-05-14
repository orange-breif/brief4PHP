<?php
include "conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- font awesome -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>

<body>
    <?php
    include "navbar.php";
    ?>

    <div class="container mt-5">
        <section class="container-fluid ">
            <div id="carouselExampleDark" class="carousel carousel-dark slide " data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="img/slider3" class="d-block w-100 slider">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>NexGen-Tech</h5>
                            <p>discover our new offers.</p>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="img/slider1" class="d-block w-100 slider" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>Second slide label</h5>
                                <p>Some representative placeholder content for the second slide.</p> -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/slider2" class="d-block w-100 slider" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>Third slide label</h5>
                                <p>Some representative placeholder content for the third slide.</p> -->
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </section>
        <hr>
        <section class="product">
            <h2 class="product-category">New Products</h2>
            <button class="pre-btn"><img src="img/arrow.png" alt=""></button>
            <button class="nxt-btn"><img src="img/arrow.png" alt=""></button>
            <div class="product-container">
                <?php
                $sql = "SELECT * FROM `tb_products` WHERE prd_status = 2";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $brand_id = $row['prd_brand'];
                    $brand_result = mysqli_query($conn, "SELECT `brand_name` FROM `tb_brand` WHERE `brand_id`='$brand_id'");
                    $brand_name = mysqli_fetch_assoc($brand_result)['brand_name'];
                ?>
                    <div class="product-card">
                        <div class="product-image">
                            <span class="discount-tag">New</span>
                            <img src="<?php echo 'img/' . $row['prd_img']; ?>" class="product-thumb" alt="">
                            <button class="card-btn">add to cart</button>
                        </div>
                        <div class="product-info">
                            <h2 class="product-brand"><?php echo $brand_name; ?></h2>
                            <p class="product-short-description"><?php echo $row['prd_description']; ?></p>
                            <span class="price">$<?php echo $row['prd_price']; ?></span>
                            <span><button type="button" class="btn btn-secondary ms-2"><a href="view_product_page.php?viewid=<?= $row['prd_id'] ?>" class="text-light">View</a></button></span>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        </section>
        <hr>
        <section class="product">
            <h2 class="product-category">Best Selling</h2>
            <button class="pre-btn"><img src="img/arrow.png" alt=""></button>
            <button class="nxt-btn"><img src="img/arrow.png" alt=""></button>
            <div class="product-container">
                <?php
                $sql = "SELECT * FROM `tb_products` WHERE prd_status = 3";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $after_descount = $row['prd_price'] / 2;
                    $brand_id = $row['prd_brand'];
                    $brand_result = mysqli_query($conn, "SELECT `brand_name` FROM `tb_brand` WHERE `brand_id`='$brand_id'");
                    $brand_name = mysqli_fetch_assoc($brand_result)['brand_name'];

                ?>
                    <div class="product-card">
                        <div class="product-image">
                            <span class="discount-tag">50% off</span>
                            <img src="<?php echo 'img/' . $row['prd_img']; ?>" class="product-thumb" alt="">
                            <button class="card-btn">add to cart</button>

                        </div>
                        <div class="product-info">
                            <h2 class="product-brand"><?php echo $brand_name; ?></h2>
                            <p class="product-short-description"><?php echo $row['prd_description']; ?></p>
                            <span class="price">$<?php echo $after_descount; ?></span><span class="actual-price">$<?php echo $row['prd_price']; ?></span>
                            <span><button type="button" class="btn btn-secondary ms-2"><a href="view_product_page.php?viewid=<?= $row['prd_id'] ?>" class="text-light">View </a></button></span>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
        <hr>
        <section class="product">
            <h2 class="product-category">Top Seller</h2>
            <button class="pre-btn"><img src="img/arrow.png" alt=""></button>
            <button class="nxt-btn"><img src="img/arrow.png" alt=""></button>
            <div class="product-container">
                <?php
                $sql = "SELECT * FROM `tb_products` WHERE prd_status = 4";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $brand_id = $row['prd_brand'];
                    $brand_result = mysqli_query($conn, "SELECT `brand_name` FROM `tb_brand` WHERE `brand_id`='$brand_id'");
                    $brand_name = mysqli_fetch_assoc($brand_result)['brand_name'];
                ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?php echo 'img/' . $row['prd_img']; ?>" class="product-thumb" alt="">
                            <button class="card-btn">add to cart</button>
                        </div>
                        <div class="product-info">
                            <h2 class="product-brand"><?php echo $brand_name; ?></h2>
                            <p class="product-short-description"><?php echo $row['prd_description']; ?></p>
                            <span class="price">$<?php echo $row['prd_price']; ?> </span><span><button type="button" class="btn btn-secondary ms-2"><a href="view_product_page.php?viewid=<?= $row['prd_id'] ?>" class="text-light">View </a></button></span>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
        <hr>
    </div>
    <footer>
        <?php
        include "footer.html";
        ?>
    </footer>


    <script src="js/script.js"></script>

    <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>