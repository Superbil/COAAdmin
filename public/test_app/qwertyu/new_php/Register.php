<?php
    $con = mysqli_connect("140.112.76.152", "eales", "eales3488", "test_for_app");
    if(! $con ){
        die('連線失敗: ' . mysqli_error($con));
    }
    mysqli_set_charset($con,"utf8");
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $statement = mysqli_prepare($con, "INSERT INTO user_info ( name, phone, email, password) VALUES (?, ?, ?, ?)");

    mysqli_stmt_bind_param($statement, "ssss", $name, $phone, $email, $password);
    
    $response = array();
    if (mysqli_stmt_execute($statement)){
        $response["success"] = true;
    }else{
    	$response["success"] = false;
    }
   
    
    echo json_encode($response);
    $con->close();
    
?>

