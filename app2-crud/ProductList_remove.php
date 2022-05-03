<?php 
    if( isset( $_GET['key'])){
        $slug = $_GET['key'];

        if( !file_exists("./ProductList_data.json") ){
            die(
                'ProductList_data.json is missing <br>
                <a href="ProductList_index.php">Back to Home</a>'
            );
        }
        
        $json_file = file_get_contents("./ProductList_data.json");
        $jsonArr = json_decode($json_file, true);

        foreach($jsonArr as $key => $array){
            if( $key == $slug ){
                unset($jsonArr[$slug]);
                $jsonEncode = json_encode($jsonArr, 128); //JSON_PRETTY_PRINT
                file_put_contents("./ProductList_data.json", $jsonEncode); 

                echo '
                <script>
                    window.location.href="ProductList_index.php";
                </script>';
            }
        }
    }
?>