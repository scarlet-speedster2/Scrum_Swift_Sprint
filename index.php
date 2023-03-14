<?php
require_once "ProjectManagement.php";

$projectName = "StartTuts";
$projectManagement = new ProjectManagement();
$statusResult = $projectManagement->getAllStatus();
?>
<html>
<head>
<title>Trello Like Drag and Drop Cards for Project Management Software</title>
<link rel="stylesheet"
    href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
body {
    /*font-family: arial;*/
    font-family: "Georgia";
    font-size: 20;
    background-color: #D9D7F1;
    margin-top: 25px;
}

h2{
    font-weight: 400;
    font-size: 40;
}

.task-board {
    background-color: #0de8f3;
    /*display: inline-block;*/
    width: 2000px;
    height: 2000px;
    white-space: nowrap;
}

.container{
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    height: auto;
    padding: 10px;
}

.status-card {
    margin-right: 8px;
    
    vertical-align: top;
    /* NEW */
    background-color: #FFEA20;
    padding: 10px;
    flex-basis: 30%;
    min-height: 100px;
    border-radius: 5px;
    border: solid 2px black;
}

.status-card:last-child {
    margin-right: 0px;
}

.card-header {
    width: 100%;
    padding: 10px 10px 0px 10px;
    box-sizing: border-box;
    border-radius: 3px;
    display: block;
    /*font-weight: bold;*/
}

.card-header-text{
    font-size: 25;
}


ul.sortable {
    padding-bottom: 10px;
}

ul.sortable li:last-child {
    margin-bottom: 0px;
}

ul {
    list-style: none;
    margin: 0;
    padding: 0px;
}

.text-row {
    padding: 15px 10px;
    margin: 10px;
    background: #fff;
    box-sizing: border-box;
    border-radius: 3px;
    border-bottom: 1px solid #ccc;
    cursor: pointer;
    font-size: 0.8em;
    white-space: normal;
    line-height: 20px;
    border: solid 2px black;
}

.ui-sortable-placeholder {
    visibility: inherit !important;
    background: transparent;
    border: #666 2px dashed;
}
</style>
</head>
<body>
<center><h2>Task Manager</h2></center>
        <div class="container">
            <?php
            foreach ($statusResult as $statusRow) {
                $taskResult = $projectManagement->getProjectTaskByStatus($statusRow["id"], $projectName);
                ?>
                <div class="status-card">
                    <div class="card-header">
                        <center><span class="card-header-text"><?php echo $statusRow["status_name"]; ?></span></center>
                        <br>
                    </div>
                    <ul class="sortable ui-sortable"
                        id="sort<?php echo $statusRow["id"]; ?>"
                        data-status-id="<?php echo $statusRow["id"]; ?>">
                <?php
                if (! empty($taskResult)) {
                    foreach ($taskResult as $taskRow) {
                        ?>
                
                     <li class="text-row ui-sortable-handle"
                            data-task-id="<?php echo $taskRow["id"]; ?>"><?php echo $taskRow["title"]; ?></li>
                <?php
                    }
                }
                ?>
                                                 </ul>
                </div>
                <?php
            }
            ?>
        </div>
    <script>
 $( function() {
     var url = 'edit-status.php';
     $('ul[id^="sort"]').sortable({
         connectWith: ".sortable",
         receive: function (e, ui) {
             var status_id = $(ui.item).parent(".sortable").data("status-id");
             var task_id = $(ui.item).data("task-id");
             console.log("status id:- ",status_id);
             console.log("task id:- ",task_id);
             $.ajax({
                 url: url+'?status_id='+status_id+'&task_id='+task_id,
                 success: function(response){
                     }
             });
             }
     
     }).disableSelection();
     } );
  </script>
</body>
</html>