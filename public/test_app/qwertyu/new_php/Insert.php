<?php

    $con = mysqli_connect("140.112.76.152", "eales", "eales3488", "food_traceability_web");
    mysqli_set_charset($con,"utf8");

    if (!$con) {
        die("連線失敗: " . mysqli_error($con));
    } 

    $product_id = $_POST["product_id"];
    $timestamp = $_POST["timestamp"];
    $task = $_POST["task"];
    $location = $_POST["location"];
    $tool = $_POST["tool"];
    $tool_type = $_POST["tool_type"];
    $input_method = $_POST["input_method"];
    $remark="";       
    $more_info_url="";
    $bc_explorer_url="";
    $task_url="";
    $location_url="";
    $tool_url="";
    $remark_url="";
    

    $statement = mysqli_prepare($con,"INSERT INTO task_log (product_id, timestamp, task, location, tool, tool_type, input_method,remark,more_info_url,bc_explorer_url,task_url,location_url,tool_url,remark_url ) VALUES (?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?)");
    
    mysqli_stmt_bind_param($statement, "iissssssssssss", $product_id, $timestamp, $task, $location, $tool, $tool_type, $input_method,$remark,$more_info_url,$bc_explorer_url,$task_url,$location_url,$tool_url,$remark_url);
    
    $response = array();
    if($timestamp!=NULL &&  mysqli_stmt_execute($statement)){
	    $response["success"] = true; 
    }else{
	    $response["success"]=false;
    }
    echo json_encode($response);

    $con->close();
?>
