<?php 
    $success = false;
    $dupes =  false;

    if( !file_exists("./ProductList_data.json") ){
        die(
            'ProductList_data.json is missing <br>
            <a href="ProductList_index.php">Back to Home</a>'
        );
    }

    $json_file = file_get_contents("./ProductList_data.json");
    $jsonArr = json_decode($json_file, true);


    function previousValue($key, $default = ""){
        if (isset($_POST[$key])){
            return htmlspecialchars( $_POST[$key] );
        } else {
            return $default;
        }
    }

    function isDuplicate($arr, $slug){
        foreach($arr as $key => $value){
            if(strcasecmp($key,$slug) == 0){
                return true;
            }
        }

        return false;
    }

    if( isset($_POST['submit']))
    {
        $slug = str_replace(" ", "-", $_POST['name'] );
        
        if( !isDuplicate($jsonArr, $slug)){
            
            $newProduct = array (
                "name" => $_POST['name'],
                "producer" => $_POST['producer'],
                "processor" => $_POST['processor'],
                "RAM" => $_POST['RAM'],
                "displaySize" => $_POST['displaySize'],
                "displayResolution" => $_POST['displayResolution'],
                "storageCapacity" => $_POST['storageCapacity'],
                "storageModel" => $_POST['storageModel'],
                "launch" => $_POST['launch'],
                "weight" => $_POST['weight'],
                "height" => $_POST['height'],
                "width" => $_POST['width'],
                "thickness" => $_POST['thickness'],
            );
            
            $jsonArr[$slug] = $newProduct;
            $jsonEncode = json_encode($jsonArr, 128); //JSON_PRETTY_PRINT
            file_put_contents("./ProductList_data.json", $jsonEncode); 
            $success = true;
        }
        else {
            $dupes = true;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-3 mb-3">
    <h1>Add Product</h1>

    <?php if( $success ) :?>
        <div class="alert alert-success" role="alert">
            Product has been added!
        </div>
    <?php $success = false; endif; ?>
    <?php if( $dupes ) :?>
        <div class="alert alert-danger" role="alert">
            Name has been used! Choose other name!
        </div>
    <?php $dupes = false; endif; ?>

    <a href="ProductList_index.php" class="btn btn-primary my-2">Back to Home</a>

    <form action="" method="post">
        <label for="name">Name</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" value="<?= previousValue("name")?>">
        </div>
        
        <label for="launch">Launch Date</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="launch" 
            placeholder="e.g. January 2020" value="<?= previousValue("launch")?>">
        </div>

        <label for="producer">Producer</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="producer" value="<?= previousValue("producer")?>">
        </div>
        
        <label for="processor">Processor</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="processor" value="<?= previousValue("processor")?>">
        </div>
        
        <label for="RAM">RAM</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" min="1" class="form-control" name="RAM" value="<?= previousValue("RAM")?>">
            <div class="input-group-append">
                <span class="input-group-text"> GB</span>
            </div>
        </div>

        <label for="displaySize">Display Size</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" step="any" min="1" class="form-control" name="displaySize" value="<?= previousValue("displaySize")?>">
            <div class="input-group-append">
                <span class="input-group-text"> inch</span>
            </div>
        </div>

        <label for="displayResolution">Display Resolution</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" min="1" class="form-control" name="displayResolution" value="<?= previousValue("displayResolution")?>">
            <div class="input-group-append">
                <span class="input-group-text">p</span>
            </div>
        </div>

        <label for="storageModel">Storage Model</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="storageModel" value="<?= previousValue("storageModel")?>">
        </div>

        <label for="storageCapacity">Storage Capacity</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" min="1" class="form-control" name="storageCapacity" value="<?= previousValue("storageCapacity")?>">
            <div class="input-group-append">
                <span class="input-group-text">GB</span>
            </div>
        </div>

        <label for="weight">Weight</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" step="any" min="1" class="form-control" name="weight" value="<?= previousValue("weight")?>">
            <div class="input-group-append">
                <span class="input-group-text"> Kg</span>
            </div>
        </div>

        <label for="height">Height</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" step="any" min="1" class="form-control" name="height" value="<?= previousValue("height")?>">
            <div class="input-group-append">
                <span class="input-group-text"> Cm</span>
            </div>
        </div>

        <label for="width">Width</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" step="any" min="1" class="form-control" name="width" value="<?= previousValue("width")?>">
            <div class="input-group-append">
                <span class="input-group-text"> Cm</span>
            </div>
        </div>

        <label for="thickness">Thickness</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" step="any" min="1" class="form-control" name="thickness" value="<?= previousValue("thickness")?>">
            <div class="input-group-append">
                <span class="input-group-text"> Cm</span>
            </div>
        </div>

        <input type="submit" class="btn btn-success" name="submit">
    </form>
</div>

</body>
</html>