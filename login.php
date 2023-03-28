<?php 
	session_start();

	include("functions.php");

	require_once "ProjectManagement.php";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$user_name = $_POST["user_name"];
		$password = $_POST["password"];

		if(($user_name == "admin") && ($password == "admin"))
		{
			header("Location: admin.php");
			die;
		}

			
		$db_handle = new DBController();
		$query = "SELECT * FROM users WHERE user_name = (?) limit 1";
		$result = $db_handle->runQuery($query, 's', array($user_name));

		//var_dump($user_data);

		if ($result && $password == $result[0]['password']) {
			$_SESSION['user_id'] = $result[0]['user_id'];
			$user_id = $result[0]['user_id'];
			//echo "yes";
			header("Location: task-$user_id.php");
			//echo '<script type="text/javascript">window.location.href = "index.php";</script>';
			die;
		} else {
			echo "Wrong credentials.";
		}

	}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
		color: black;
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


	</style>

	<br><br><br>

	<div id="box2">
		<img src="pictures/logo.png" width="400px" alt="Scrum">
	</div>

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