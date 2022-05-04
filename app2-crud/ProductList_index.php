<?php 
    if( !file_exists("./ProductList_data.json") ){
        if( !file_exists("./default_data.json") ){
            die("Important files are missing!");
        }

        // Force Refresh
        $file = fopen("ProductList_data.json", "w") or die("Unable to open file!");
        fclose($file);

        $json_default = file_get_contents("./default_data.json");
        file_put_contents("./ProductList_data.json", $json_default); 
    }

    // Refresh
    if( isset( $_POST['refresh'])){
        if( !file_exists("./default_data.json") ){
            echo '<script>alert("default_data.json file is missing! Refresh failed!");</script>';
        } else {
            $json_default = file_get_contents("./default_data.json");
            file_put_contents("./ProductList_data.json", $json_default); 
        }

        unset( $_POST['refresh']);
    }

    $json_file = file_get_contents("./ProductList_data.json");
    $jsonArr = json_decode($json_file, true);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-3">
    <h1>Product List</h1>

    <div class="container d-flex align-items-start">
        <a href="ProductList_add.php" class="btn btn-success mx-2" >Add</a>
        <form action="<?= $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="submit" class="btn btn-secondary" name="refresh" value="Refresh"
                onclick='return confirm("Are you sure want to refresh the data to default?");'>
        </form>
    </div>

    <table class="table table-stripped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Processor</th>
            <th scope="col">RAM</th>
            <th scope="col">Storage</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $counter=1; foreach( $jsonArr as $key => $array ) :?>
            <tr>
                <th scope="row"><?= $counter++ ?></th>
                <td><?= $array['name'] ?></td>
                <td><?= $array['processor'] ?></td>
                <td><?= $array['RAM'] ?> GB</td>
                <td><?= "{$array['storageModel']} {$array['storageCapacity']}" ?> GB</td>
                <td>
                    <div class="container d-flex">
                        <a class="btn btn-info mx-1" href="ProductList_detail.php?key=<?= $key;?>">Detail</a>
                        <a class="btn btn-warning mx-1" href="ProductList_edit.php?key=<?= $key;?>">Edit</a>
                        <!-- <a class="btn btn-danger" href="ProductList_remove.php?key=<?= $key; ?>"
                                onclick="return confirm('Are you sure you want to remove this product?')">
                            Remove
                        </a> -->
                        <form action="ProductList_remove.php" method="post">
                            <input type="text" value="<?= $key;?>" hidden name="key">
                            <input type="submit" class="btn btn-danger mx-1" value="Remove" name="remove">
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
</body>
</html>