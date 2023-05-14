<!-- You will create a landing page for our CRUD application that contains a data grid showing 
the records from the employee’s database table. It also has actions for each record displayed in 
the grid, you may choose to view its details, update, or delete.
You'll also add a create button on the top of the data grid that can be used for 
creating new records in the employee’s table. The file will be called "index.php"  -->
<?php
include('config.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- link to bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- link to jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- link to css -->
    <link rel="stylesheet" href="css/admin_dashboard.css">

    <title>dashboard</title>
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>products table</h3>
                        <div class="search">
                            <div class="input-group mb-4 mt-3">
                                <div class="form-outline">
                                    <label for="search">search:</label>
                                    <input type="text" id="getName" name="getName" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-warning mt-3"><a href="cate_create.php" class="text-light" style="text-decoration: none;">Insert to table</a></button>
                            <button class="btn btn-primary mt-3"><a href="admin_products.php" class="text-light" style="text-decoration: none;">products Dashboard</a></button>
                        </div>
                    </div>
                    <div class="container text-center mb-3 mt-3 ">
                        <div class="row align-items-start">
                            <div class="col">
                                <?php
                                $query = "SELECT COUNT(*) AS rowCount FROM tb_categories";
                                $result = mysqli_query($conn, $query);
                                
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $rowCount = $row['rowCount'];
                                    echo "Number of categories: " . $rowCount;
                                } else {
                                    echo "No data available";
                                }                                
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>category name</th>
                                    <th>operations</th>
                                </tr>
                            </thead>
                            <tbody id="showdata">
                                <?php
                                $query = "SELECT * FROM tb_categories";
                                $result = mysqli_query($conn, $query);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><?= $row['cat_id']; ?></td>
                                            <td><?= $row['cat_name']; ?></td>
                                            <td class="buttons">
                                                <button class="btn btn-warning"><a href="cate_view.php?viewid=<?= $row['cat_id'] ?>" class="text-light">View</a></button>
                                                <button class="btn btn-primary"><a href="cate_update.php?updateid=<?= $row['cat_id'] ?>" class="text-light">Update</a></button>
                                                <button class="btn btn-danger"><a href="cate_delete.php?deleteid=<?= $row['cat_id'] ?>" class="text-light">Delete</a></button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="5">No Record Found</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#getName').on("keyup", function() {
                var getName = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: 'cate_search.php',
                    data: {
                        name: getName
                    },
                    success: function(response) {
                        $("tbody").html(response);
                    }
                });
            });
        });
    </script>


    <!-- link to bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>


