<?php 
	session_start();

	include("functions.php");

	require_once "ProjectManagement.php";

	$projectName = "StartTuts";
	$projectManagement = new ProjectManagement();
	$statusResult = $projectManagement->getAllStatus();

	$user_data = $projectManagement->check_login();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SCRUM</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<style type="text/css">
	
	#text{
		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid 2px black;
		width: 90%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: solid 2px black;
	}

	#box{
		background-color: yellow;
		margin: auto;
		width: 325px;
		padding: 20px;
		border: solid 2px black;
	}

	body 
    {
        background-image: url('pictures/bg.jpg');
		color: white;
    }

	#box2{
        background-color: #FFEA20;
        margin: auto;
        width: 403px;
        padding: 20px;
        border: solid;
    }

	img{
		border: solid 2px black;
	}

	.navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #333;
        height: 80px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 999;
    }
    
    /* Style for the left links */
    .navbar-left {
        display: flex;
        justify-content: flex-start;
        margin-left: 20px;
    }
    
    /* Style for the right link */
    .navbar-right {
        margin-right: 20px;
    }
    
    /* Style for all links */
    .navbar-link {
        color: #fff;
        text-decoration: none;
        margin-right: 20px;
        font-weight: bold;
        font-size: 16px;
    }
    
	</style>

	<?php
		include("_nav.php");
	?>
	<br><br>

	<br>
	<?php 
		header('Location: login.php');
		die;
	?>
</body>
</html>