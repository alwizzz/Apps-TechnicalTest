<?php 
    if( !file_exists("./Sorting_data.json") ){
        if( !file_exists("./default_data.json") ){
            die("Important files are missing!");
        }

        $file = fopen("Sorting_data.json", "w") or die("Unable to open file!");
        fclose($file);

        $json_default = file_get_contents("./default_data.json");
        file_put_contents("./Sorting_data.json", $json_default); 
    }

    $json_file = file_get_contents("./Sorting_data.json");
    $jsonArr = json_decode($json_file, true);

    if( isset( $_POST['sort'])){
        usort($jsonArr, function($a, $b){
            if( $a['harga'] < $b['harga'] ){
                return -1;
            } elseif ( $a['harga'] > $b['harga'] ){
                return 1;
            } else {
                if( $a['rating'] > $b['rating'] ){
                    return -1;
                } elseif ( $a['rating'] < $b['rating'] ){
                    return 1;
                } else {
                    if( $a['likes'] > $b['likes'] ){
                        return -1;
                    } elseif ( $a['likes'] < $b['likes'] ){
                        return 1;
                    } else {
                        return 0;
                    }
                }
            }
        });

        $jsonEncode = json_encode($jsonArr, 128); //JSON_PRETTY_PRINT
        file_put_contents("./Sorting_data.json", $jsonEncode);
        unset( $_POST['sort']);
    }

    if( isset( $_POST['rand'])){
        shuffle($jsonArr);
        $jsonEncode = json_encode($jsonArr, 128); //JSON_PRETTY_PRINT
        file_put_contents("./Sorting_data.json", $jsonEncode);
        unset( $_POST['rand']);
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-3 d-flex flex-column">
    <h1>Sort Item</h1>

    <form action="<?= $_SERVER["PHP_SELF"]; ?>" method="post">
        <input type="submit" class="btn btn-success" name="sort" value="Sort">
        <input type="submit" class="btn btn-warning" name="rand" value="Randomize">
    </form>

    <table class="table table-stripped table-hover">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Rating</th>
            <th scope="col">Likes</th>
        </tr>
    </thead>
    <tbody>
        <?php for($i=0; $i < count($jsonArr); $i++) :?>
            <tr>
                <td><?= $jsonArr[$i]['nama'] ?></td>
                <td><?= $jsonArr[$i]['harga']?></td>
                <td><?= $jsonArr[$i]['rating'] ?></td>
                <td><?= $jsonArr[$i]['likes'] ?></td>
            </tr>
        <?php endfor; ?>
    </tbody>
    </table>
</div>
</body>
</html>