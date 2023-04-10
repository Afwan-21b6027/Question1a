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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bruneian Car Plate</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
        <label for="carplate">Bruneian Car Plate</label><br>
        <input type="text" name="carplate" id="carplate">
        <input type="submit" value="submit">
        <span></span>

        
    </form>
</body>
</html>