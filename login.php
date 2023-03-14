<?php
session_start();
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];


    if(($user_name == "admin") && ($password == "admin"))
    {
        header("Location: admin.php");
        die;
    }

    $query = "select * from users where user_name = '$user_name' limit 1";
    $result = mysqli_query($con, $query);

    if($result && mysqli_num_rows($result)>0)
    {
        $user_data = mysqli_fetch_assoc($result);
        
        if($user_data['password'] == $password)
        {
            $_SESSION['user_id'] = $user_data['user_id'];
            header("Location: work.php");
            die;
        }
        echo "Please enter valid information!"; 
    } 
    else
    {
        echo "Please enter valid information!";
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet"
    href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
    body {
        margin-top: 1000px;
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
        background-color: #CCF381;
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


    #button{
        padding: 10px;
        width: 100px;
        color: black;
        background-color: lightblue;
        border: solid;
    }

    #box{
        background-color: #FFEA20;
        margin: auto;
        width: 300px;
        padding: 20px;
        border: solid;
    }

    #box2{
        background-color: #FFEA20;
        margin: auto;
        width: 425px;
        padding: 20px;
        border: solid;
    }

    img {
  border: 2px solid black;
}

</style>
</head>
<body>
<br><br><br>

<center>
<div id="box2">
    <img src="logo.png" width="400px" alt="SCRUM">
</div>
</center>

<br><br><br>
<div id="box">
        <form method="post">
            <div style="font-size: 20px;margin: 10px;color: black;">Login</div>

            <input id="text" type="text" name="user_name" placeholder="Enter your username"><br><br>
            <input id="text" type="password" name="password" placeholder="Enter your password"><br><br>

            <input id="button" type="submit" value="Login"><br><br>

        </form>
    </div>

<br><br><br>
</body>
</html>