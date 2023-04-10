<?php
    require("db.php");
    $carplate = $_POST["carplate"];
    $carplat_err = '';
    
    
    if(empty(trim($carplate))){
        
    }

    // SQL Statement
    $sql = "INSERT INTO bruneicarplate(carplate) VALUE ('$carplate')";
    if(mysqli_query($conn, $sql)){
        echo "New Record created successfully";
    }else{
        echo "Error: ".$sql. "</br>".mysqli_error($conn);
    }


?>