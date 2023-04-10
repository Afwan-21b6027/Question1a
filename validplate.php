<?php
    require("db.php");
    $carplate = '';
    $initials_err = $numbers_err =  '';
    
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // ! Initials Checking
        if(empty(trim($_POST["initials"]))){

            $initials_err = 'Please enter car initials!';

        } elseif (!substr($_POST["initials"], 0, 1) === "B" or !substr($_POST["initials"], 0, 1) === "K"){

            $initials_err = "This car is not Bruneian Registered";

        } elseif (!preg_match('/^[a-zA-Z_]+$/', trim($_POST["initials"]))){

            $initials_err = "Car initials should not contain any special characters nor numbers!";

        }

        // ! Numbers Checking
        if (empty(trim($_POST["numbers"]))){

            $numbers_err = 'Please enter car number!';

        } elseif (!is_numeric(trim($_POST["numbers"]))){
            
            $numbers_err = 'Please enter only numbers!';

        } elseif(trim($_POST["numbers"] > 9999)){

            $numbers_err = 'Number is beyond the registered range! Please try again!';

        }
        
        // ! Insert into database
        if (empty($initials_err) && empty($numbers_err)){
            $sql = "INSERT INTO bruneicarplate (carplate) VALUE (?)";

            if($stmt = mysqli_prepare($conn, $sql)){
                // ! Concat both Variables
                $carplate = $_POST["initials"].$_POST["numbers"];

                mysqli_stmt_bind_param($stmt, "s", $param_carplate);
                $param_carplate = $carplate;

                if(mysqli_stmt_execute($stmt)){
                    echo "Car plate registiration successful!" ;
                } else{
                    echo "There is something wrong!";
                }
            }
        }
    }
        mysqli_close($conn);

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
        
        <label for="carplate">Bruneian Car: Initials</label><br>
        <input type="text" name="initials" id="initials">
        <span><?php echo $initials_err?></span><br>

        <label for="carplate">Bruneian Car: Numbers</label><br>
        <input type="number" name="numbers" id="numbers">
        <span><?php echo $numbers_err?></span><br>
        <input type="submit" value="submit">

        
    </form>
</body>
</html>