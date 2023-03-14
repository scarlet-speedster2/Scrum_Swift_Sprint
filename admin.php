<?php
session_start();
include("connection.php");
include("functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet"
    href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
    body {
        margin-top: 220px;
        font-family: "Georgia";
        font-size: 20;
        background-color: #D9D7F1;
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
        width: 150px;
        height: 100px;
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
    <center>
    <div>
        <form method="post">
            <input id="button" type="submit" value="Create New Project"><br><br>


    <br><br><br>

            <input id="button" type="submit" value="Open Existing Project"><br><br>
        </form>
    </div>
</center>
</body>
</html>