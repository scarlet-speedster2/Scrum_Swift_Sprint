<?php 
	session_start();

	include("functions.php");

	require_once "ProjectManagement.php";

	$projectName = "StartTuts";
	$projectManagement = new ProjectManagement();
	$statusResult = $projectManagement->getAllStatus();
	$db_handle = new DBController();

	$user_data = $projectManagement->check_login();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$project_name = $_POST['project_name'];
		$project_link = $_POST['project_link'];
		$unique = random_num(10);
		$project_filename = "project-$unique.php";

		// Path to the source file
		$source_file = "project.php";

		// Read the contents of the source file
		$file_contents = file_get_contents($source_file);

		file_put_contents($project_filename, $file_contents);

		if(!empty($project_name) && !empty($project_link))
		{
			$query = "INSERT INTO projects (project_link_id,project_name,project_link) values (?, ?, ?)";

			// Define the parameter types and values for the placeholders
			$param_type = "iss";
			$param_value_array = array($unique, $project_name, $project_link);

			// Call the insert function to execute the INSERT statement
			$db_handle->insert($query, $param_type, $param_value_array);

			// Redirect back to the form page or to a success page
			header("Location: admin.php");
			die;
		}
	}

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

	#text1{
		height: 40px;
		border-radius: 5px;
		padding: 4px;
		border: solid 2px black;
		width: 90%;
	}

	#button{
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
		color: white;
		margin: 20px;
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


	.flex-container {
		display: flex;
		gap: 300px;
	}

	.fixed-container {
		width: 500px; /* Change this value to your desired width */
		height: 500px;
		background: yellow;
		color: black;
		border: solid 2px black;
		font-size: 25px;
		padding-left: 30px;
	}

	.flexible-container {
		flex: 1;
		min-width: 400px;
		overflow-y: auto; /* This will add a scrollbar if the list is too long */
		background: yellow;
		color: black;
		border: solid 2px black;
		font-size: 25px;
		padding-left: 30px;
	}

	th, td {
		padding-right: 20px;
	}

	hr{
		height: 5px;
	}

	</style>

	<?php
		include("admin_nav.php");
	?>
	<br><br>

	<u><center><h1>Welcome Admin!</h1></center></u>
	<br>
	<div class="flex-container">
		<div class="flexible-container">
			<br>
			<center>Open Exisiting Project</center>
			<hr>
			<?php
			
				$query = "SELECT * FROM projects";
				$result = $db_handle->runBaseQuery($query);
				echo "<table>";
				foreach($result as $row) 
				{
					echo "</td><td><a href='project-".$row['project_link_id'].".php'>".$row['project_name']."</a></td></tr>";
				}
				echo "</table>";
			
			?>
		</div>
		<div class="fixed-container">
			<br>
			<center>Create New Project</center>
			<hr>
			<form method="post">
				<div style="font-size: 20px;margin: 10px;color: black;">Enter Project Name</div>
				<input id="text1" type="text" name="project_name" placeholder="enter a name"><br>
				<div style="font-size: 20px;margin: 10px;color: black;">Enter Github/Repo Link</div>
				<input id="text1" type="text" name="project_link" placeholder="enter link"><br><br>

				<input id="button" type="submit" value="Create"><br><br>

			</form>
		</div>
	</div>

<br><br><br>
</body>
</html>