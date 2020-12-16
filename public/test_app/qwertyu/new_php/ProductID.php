<?php

    $mysqli = mysqli_connect("140.112.76.152", "eales", "eales3488", "food_traceability_web");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    mysqli_set_charset($mysqli,"utf8");

    $sql_product = "SELECT product_id, product_name FROM product";

    $sql_tooltype = "SELECT Distinct tool, tool_type FROM task_log";

    $sql_task = "SELECT Distinct task FROM task_log";

    $sql_location = "SELECT Distinct location FROM task_log";

    $result_product = mysqli_query($mysqli,$sql_product) or die('MySQL query product error');

    $result_task = mysqli_query($mysqli,$sql_task) or die('MySQL query task error');
    
    $result_location = mysqli_query($mysqli,$sql_location) or die('MySQL query location error');
    
    $result_tooltype = mysqli_query($mysqli,$sql_tooltype) or die('MySQL query tooltype error');

    $data_product = $result_product->fetch_all(MYSQLI_ASSOC);
    $data_task = $result_task->fetch_all(MYSQLI_ASSOC);
    $data_location = $result_location->fetch_all(MYSQLI_ASSOC);
    $data_tooltype = $result_tooltype->fetch_all(MYSQLI_ASSOC);
    
    $return = array('product'=> $data_product, 'task'=>  $data_task, 'location'=> $data_location, 'tooltype'=> $data_tooltype);   
   
    #echo json_encode($data_product, JSON_UNESCAPED_UNICODE);
    #echo json_encode($data_task, JSON_UNESCAPED_UNICODE);
    #echo json_encode($data_location, JSON_UNESCAPED_UNICODE);
    #echo json_encode($data_tooltype, JSON_UNESCAPED_UNICODE);
    echo json_encode($return, JSON_UNESCAPED_UNICODE);
    
    $mysqli->close();

?>
