<?php
include("config.php");

$name = $_POST['name'];

$sql = "SELECT * FROM tb_products WHERE user_fname LIKE '$name%' OR user_id  LIKE '$name%' OR user_lname LIKE '$name%'";
$query = mysqli_query($conn, $sql);
$data = '';
if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
        $data .= '<tr>
                    <td>' . $row['id'] . '</td>
                    <td><img src="img/' . $row["img"] . '" width="90" height="90" alt=""></td>
                    <td>' . $row["name"] . '</td>
                    <td>' . $row["days_off"] . '</td>
                    <td>' . $row["salary"] . '</td>
                    <td class="buttons">
                        <button class="btn btn-warning"><a href="view.php?viewid=' . $row["id"] . '" class="text-light">View</a></button>
                        <button class="btn btn-primary"><a href="update.php?updateid=' . $row["id"] . '" class="text-light">Update</a></button>
                        <button class="btn btn-danger"><a href="delete.php?deleteid=' . $row["id"] . '" class="text-light">Delete</a></button>
                    </td>
                </tr>';
    }
    echo $data;
} else {
    echo '<tr><td colspan="6">No Record Found</td></tr>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
