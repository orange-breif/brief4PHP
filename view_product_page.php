<?php
include('config.php');
$id = $_GET['viewid'];

if (isset($_POST['submit'])) {
    $comment = $_POST['input_comment'];
    $sql = "INSERT INTO tb_comments (prd_id, comment) VALUES ('$id','$comment')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('location: view_product_page.php?viewid='. $id);
    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="css/view_product_page.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- font awesome -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
        #total {
            font-size: 30px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
        <?php 
        include('header.php');
        ?>
    <form id="cart_container" method="POST">
        <div class="container_first">
            <!-- information about the card -->
            <div class="info_cart">
                <?php
                $sql = "SELECT * FROM `tb_products` WHERE prd_id = $id ";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>

                <p class="infor_card"><?php echo $row['prd_name']; ?></p>
                <p class="infor_card">price: <span id="price" class="infor_cart_dait">$<?php echo $row['prd_price']; ?></span></p>
                <p class="infor_card">Description: <span class="infor_cart_dait"><?php echo $row['prd_description']; ?></span></p>
                <button type="button" class="quantity">add to cart:</button>
                <button type="button" id="minus-btn">-</button>
                <span id="quantity" name="quantity">1</span>
                <button type="button" id="plus-btn">+</button>
                <p class="infor_card">Total: <span id="total" class="infor_card"><?php echo $row['prd_price']; ?></span></p>
            </div>

            <!-- image card -->
            <div class="image_div">
                <img class="cart_img" src="<?php echo 'img/' . $row['prd_img']; ?>" alt="">
            </div>
        </div>

        <!-- comment text  -->
        <div class="div_comment_text">
            <div class="comments">
                <p class="comment_text">Comments:</p>
                <?php
                $sql = "SELECT * FROM `tb_comments` WHERE prd_id = '$id'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<p>' . $row['comment'] . '</p>';
                }
                ?>
            </div>
            <p>your comment:</p>
            <input type="text" class="input_comment" name="input_comment">
            <button name="submit">submit</button>
        </div>
    </form>
    <footer>
        <?php 
        include('footer.php');
        ?>
    </footer>
    
    <script>
        const minusBtn = document.getElementById("minus-btn");
        const plusBtn = document.getElementById("plus-btn");
        const quantity = document.getElementById("quantity");
        const price = document.getElementById("price");
        const total = document.getElementById("total");

        minusBtn.addEventListener("click", () => {
            if (parseInt(quantity.textContent) > 1) {
                quantity.textContent = parseInt(quantity.textContent) - 1;
                total.textContent = "$" + (parseInt(price.textContent.slice(1)) * parseInt(quantity.textContent));
            }
        });

        plusBtn.addEventListener("click", () => {
            quantity.textContent = parseInt(quantity.textContent) + 1;
            total.textContent = "$" + (parseInt(price.textContent.slice(1)) * parseInt(quantity.textContent));
        });
    </script>

        <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>