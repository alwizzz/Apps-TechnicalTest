<?php 
    $json_file = file_get_contents("./ProductList_data.json");
    $json = json_decode($json_file, true);
    // print_r($json);

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
Product List Page

<div class="container d-flex flex-column">
    <h1>Laptop List</h1>

    <button class="btn btn-primary mt-2 md-2" style="width: 100px">Add</button>

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
        <?php $counter=1; foreach( $json as $key => $array ) :?>
            <tr>
                <th scope="row"><?= $counter++ ?></th>
                <td><?= str_replace("-", " ", $key); ?></td>
                <td><?= $array['processor'] ?></td>
                <td><?= $array['RAM'] ?> GB</td>
                <td><?= "{$array['storageModel']} {$array['storageCapacity']}" ?> GB</td>
                <td><button>test</button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
</body>
</html>