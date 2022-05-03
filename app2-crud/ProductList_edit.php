<?php 

    if( !file_exists("./ProductList_data.json") ){
        die(
            'ProductList_data.json is missing <br>
            <a href="ProductList_index.php">Back to Home</a>'
        );
    }

    $json_file = file_get_contents("./ProductList_data.json");
    $jsonArr = json_decode($json_file, true);
    $data = $jsonArr[$_GET['key']];

    $success = false;
    $dupes =  false;

    function previousValue($key, $data){
        if (isset($_POST[$key])){
            return htmlspecialchars( $_POST[$key] );
        } else {
            return $data[$key];
        }
    }

    function isDuplicate($arr, $newSlug, $currentSlug){
        foreach($arr as $key => $value){
            if($key != $currentSlug && strcasecmp($key,$newSlug) == 0){
                return true;
            }
        }
        return false;
    }

    if( isset($_POST['submit']))
    {
        $currentSlug = str_replace(" ", "-", $data['name'] );
        $newSlug = str_replace(" ", "-", $_POST['name'] );
        
        // If name not changed
        if( isDuplicate($jsonArr, $newSlug, $currentSlug )){
            $dupes = true;
        } else {
            
            $edditedProduct = array (
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
    
            $jsonArr[$newSlug] = $edditedProduct;
            if( $newSlug != $currentSlug){
                unset($jsonArr[$currentSlug]);
            }
            
            $jsonEncode = json_encode($jsonArr, 128); //JSON_PRETTY_PRINT
            file_put_contents("./ProductList_data.json", $jsonEncode); 
            $success = true;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-3 mb-3">
    <h1>Edit Product</h1>

    <?php if( $success ) :?>
        <div class="alert alert-success" role="alert">
            Product has been edited!
        </div>
    <?php $success = false; endif; ?>
    <?php if( $dupes ) :?>
        <div class="alert alert-danger" role="alert">
            Name has been used by other product! Choose other name!
        </div>
    <?php $dupes = false; endif; ?>

    <a href="ProductList_index.php" class="btn btn-primary my-2">Back to Home</a>
    

    <form action="" method="post">
        <label for="name">Name</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" value="<?= previousValue("name", $data)?>">
        </div>
        
        <label for="launch">Launch Date</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="launch" 
            placeholder="e.g. January 2020" value="<?= previousValue("launch", $data)?>">
        </div>

        <label for="producer">Producer</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="producer" value="<?= previousValue("producer", $data)?>">
        </div>
        
        <label for="processor">Processor</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="processor" value="<?= previousValue("processor", $data)?>">
        </div>
        
        <label for="RAM">RAM</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" min="1" class="form-control" name="RAM" value="<?= previousValue("RAM", $data)?>">
            <div class="input-group-append">
                <span class="input-group-text"> GB</span>
            </div>
        </div>

        <label for="displaySize">Display Size</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" step="any" min="1" class="form-control" name="displaySize" value="<?= previousValue("displaySize", $data)?>">
            <div class="input-group-append">
                <span class="input-group-text"> inch</span>
            </div>
        </div>

        <label for="displayResolution">Display Resolution</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" min="1" class="form-control" name="displayResolution" value="<?= previousValue("displayResolution", $data)?>">
            <div class="input-group-append">
                <span class="input-group-text">p</span>
            </div>
        </div>

        <label for="storageModel">Storage Model</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="storageModel" value="<?= previousValue("storageModel", $data)?>">
        </div>

        <label for="storageCapacity">Storage Capacity</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" min="1" class="form-control" name="storageCapacity" value="<?= previousValue("storageCapacity", $data)?>">
            <div class="input-group-append">
                <span class="input-group-text">GB</span>
            </div>
        </div>

        <label for="weight">Weight</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" step="any" min="1" class="form-control" name="weight" value="<?= previousValue("weight", $data)?>">
            <div class="input-group-append">
                <span class="input-group-text"> Kg</span>
            </div>
        </div>

        <label for="height">Height</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" step="any" min="1" class="form-control" name="height" value="<?= previousValue("height", $data)?>">
            <div class="input-group-append">
                <span class="input-group-text"> Cm</span>
            </div>
        </div>

        <label for="width">Width</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" step="any" min="1" class="form-control" name="width" value="<?= previousValue("width", $data)?>">
            <div class="input-group-append">
                <span class="input-group-text"> Cm</span>
            </div>
        </div>

        <label for="thickness">Thickness</label>
        <div class="input-group mb-3" style="width:200px">
            <input type="number" step="any" min="1" class="form-control" name="thickness" value="<?= previousValue("thickness", $data)?>">
            <div class="input-group-append">
                <span class="input-group-text"> Cm</span>
            </div>
        </div>

        <input type="submit" class="btn btn-success" name="submit">
    </form>
</div>

</body>
</html>