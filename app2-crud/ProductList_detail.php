<?php 
    if( !isset( $_GET['key']) ){
        // redirect to home
        echo '
        <script>
            window.location.href="ProductList_index.php";
        </script>';
    } 

    if( !file_exists("./ProductList_data.json") ){
        echo '
        <script>
            alert("A file is missing!");
            window.location.href="ProductList_index.php";
        </script>';
    }

    $json_file = file_get_contents("./ProductList_data.json");
    $jsonArr = json_decode($json_file, true);
    if( !array_key_exists($_GET['key'], $jsonArr) ){
        die("slug does not exist");
    }

    $data = $jsonArr[$_GET['key']];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-3">
    <div class="col">
        <div class="row">
            <div class="col-md-10 col-12">
                <h1>Detail of <?= $data['name']; ?></h1>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Launch Date:</b> <?= $data['launch']; ?></li>
                    <li class="list-group-item"><b>Producer:</b> <?= $data['producer']; ?></li>
                    <li class="list-group-item"><b>Processor:</b> <?= $data['processor']; ?></li>
                    <li class="list-group-item"><b>RAM:</b> <?= $data['RAM']; ?> GB</li>
                    <li class="list-group-item"><b>Display Size:</b> <?= $data['displaySize']?> inch</li>
                    <li class="list-group-item"><b>Display Resolution:</b> <?= $data['displayResolution']?>p</li>
                    <li class="list-group-item"><b>Storage:</b> <?= "{$data['storageModel']} {$data['storageCapacity']}" ?> GB</li>
                    <li class="list-group-item"><b>Weight:</b> <?= $data['weight']?> Kg</li>
                    <li class="list-group-item"><b>Width:</b> <?= $data['width']?> Cm</li>
                    <li class="list-group-item"><b>Height:</b> <?= $data['height']?> Cm</li>
                    <li class="list-group-item"><b>Thickness:</b> <?= $data['thickness']?> Cm</li>
                </ul>
                <br>
                <a href="ProductList_index.php" class="btn btn-primary mx-2 mb-3">Back to Home</a>

            </div>
        </div>
    </div>
</div>

</body>
</html>