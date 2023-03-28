<?php 
	session_start();

	include("functions.php");

	require_once "ProjectManagement.php";


	$db_handle = new DBController();
	$projectName = "StartTuts";
	$projectManagement = new ProjectManagement();


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		$user_id = random_num(20);

		if($user_name == "admin")
		{
			header("Location: signup.php");
			die;
		}

			
		$query = "SELECT * FROM users WHERE user_name = (?) limit 1";
		$check = $db_handle->runQuery($query, 's', array($user_name));


		if ($check) {
			//echo '<script>alert("Welcome to Geeks for Geeks")</script>';
			header("Location: signup.php");
			die;
		}

		$task_filename = "task-$user_id.php";

		// Path to the source file
		$source_file = "task.php";

		// Read the contents of the source file
		$file_contents = file_get_contents($source_file);

		file_put_contents($task_filename, $file_contents);

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			$query = "INSERT INTO users (user_id,user_name,password) values (?, ?, ?)";

			// Define the parameter types and values for the placeholders
			$param_type = "iss";
			$param_value_array = array($user_id, $user_name, $password);

			// Call the insert function to execute the INSERT statement
			$db_handle->insert($query, $param_type, $param_value_array);

			$query = "SELECT * FROM users WHERE user_name = (?) limit 1";
			$result = $db_handle->runQuery($query, 's', array($user_name));


            $taskname = "tbl_task$user_id";

			//echo $taskname;

			/*
			
			$columns = "`id` int(11) NOT NULL AUTO_INCREMENT,
			`title` varchar(255) NOT NULL,
			`description` varchar(255) NOT NULL,
			`project_name` varchar(255) NOT NULL,
			`status_id` int(11) NOT NULL,
			`created_at` datetime DEFAULT current_timestamp()";

			$projectManagement->createTable_main($taskname,$columns);

			*/

			$create_result = $projectManagement->createTaskTable($user_id);


			// Redirect back to the form page or to a success page
			header('Location: admin.php');


			//header('Location: ' . $_SERVER['HTTP_REFERER']);
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
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
			<div style="font-size: 20px;margin: 10px;color: black;">Add New User!</div>

			<input id="text" type="text" name="user_name" placeholder="create a username"><br><br>
			<input id="text" type="password" name="password" placeholder="create a password"><br><br>

			<input id="button" type="submit" value="Signup"><br><br>
			
		</form>
	</div>
	<br><br><br>
</body>
</html>