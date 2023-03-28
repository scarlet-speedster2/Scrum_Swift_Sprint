<?php
session_start();
require "connection.php";


class ProjectManagement {
    function getProjectTaskByStatus($statusId, $projectName, $table_name) {
        $db_handle = new DBController();
        $query = "SELECT * FROM $table_name WHERE status_id= ? AND project_name = ?";
        $result = $db_handle->runQuery($query, 'is', array($statusId, $projectName));
        return $result;
    }
    
    function getAllStatus() {
        $db_handle = new DBController();
        $query = "SELECT * FROM tbl_status";
        $result = $db_handle->runBaseQuery($query);
        return $result;
    }
    
    function editTaskStatus($status_id, $task_id, $table_name) {
        $db_handle = new DBController();
        //$query = "UPDATE `?` SET status_id = ? WHERE id = ?";
        $query = "UPDATE `$table_name` SET `status_id` = ? WHERE `$table_name`.`id` = ?";
        $result = $db_handle->update($query, 'ii', array($status_id, $task_id));
        return $result;
    }

    function check_login() {
        $db_handle = new DBController();
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            $query = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
            $result = $db_handle->runQuery($query, 'i', array($id));
            if ($result) {
                $user_data = $result[0];
                return $user_data;
            }
        }
    }    

    function createTaskTable($user_id) {
        $db_handle = new DBController();

        $taskname = "tbl_task" . $user_id;

        $columns = "id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    title varchar(255) NOT NULL,
                    descp text NOT NULL,
                    project_name varchar(255) NOT NULL,
                    status_id int(11) NOT NULL,
                    created_at datetime NOT NULL DEFAULT current_timestamp()";

        $result = $db_handle->createTable($taskname, $columns);

        return $result;
    }


}

?>