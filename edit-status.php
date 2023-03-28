<?php 

    require_once "ProjectManagement.php";
    $projectManagement = new ProjectManagement();
    $status_id = $_GET["status_id"];
    $task_id = $_GET["task_id"];
    $file_name = $_GET['file'];
    //echo $status_id;
    //echo $task_id;
    //echo $file_name;
    $result1 = substr($file_name,5);
    $result2 = substr($result1,0,-4);
    //echo $result2;
    $table_name = "tbl_task".$result2;
    $projectManagement->editTaskStatus($status_id, $task_id, $table_name);
    

?>