<?php 
    if( !isset( $_POST['remove']) ){
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
    if( !array_key_exists($_POST['key'], $jsonArr) ){
        echo '
        <script>
            alert("Slug does not exist!");
            window.location.href="ProductList_index.php";
        </script>';
    }

    foreach($jsonArr as $key => $array){
        if( $key == $_POST['key'] ){
            unset($jsonArr[$_POST['key']]);
            $jsonEncode = json_encode($jsonArr, 128); //JSON_PRETTY_PRINT
            file_put_contents("./ProductList_data.json", $jsonEncode); 

            echo '
            <script>
                alert("Product has been deleted!");
                window.location.href="ProductList_index.php";
            </script>';
        }
    }
?>