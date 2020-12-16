<?php
    $mysqli = mysqli_connect("140.112.76.152", "eales", "eales3488", "test_for_app");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    mysqli_set_charset($con,"utf8");
    
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    
    $statement = mysqli_prepare($mysqli, "SELECT * FROM user_info WHERE phone = ? AND password = ?");
    $response = array();

    mysqli_stmt_bind_param($statement, "ss", $phone, $password); 
    mysqli_stmt_execute($statement); 
    mysqli_stmt_store_result($statement) ;
    mysqli_stmt_bind_result($statement,$name, $phone, $email, $password);
    
    if(mysqli_stmt_fetch($statement)){
        $response["success"] = true;
        $response["phone"] = $phone;
    }else{
        $response["success"] = false;
    }

    echo json_encode($response);
    $mysqli->close();

?>
