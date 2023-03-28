<?php 
	session_start();

	include("functions.php");

	require_once "ProjectManagement.php";

	$filename = $_SERVER['PHP_SELF'];
	$result1 = substr($filename,15);
	$result2 = substr($result1,0,-4);

	$projectName = "StartTuts";
	$projectManagement = new ProjectManagement();
	$statusResult = $projectManagement->getAllStatus();

	$db_handle = new DBController();
	$query = "SELECT * FROM projects WHERE project_link_id = (?) limit 1";
	$result = $db_handle->runQuery($query, 'i', array($result2));


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$id = $_POST["user_id"];
		$title = $_POST["title"];
		$table_name = "tbl_task".$id;

		//echo $table_name;

		$query = "INSERT INTO `$table_name` (`title`, `descp`, `project_name`, `status_id`) values (?, ?, ?, ?)";

		//$desc = "yyy";
		//$project_name = "StartTuts";
		//$status_id = 1;

		// Define the parameter types and values for the placeholders
		//$param_type = "ssssi";
		//$param_value_array = array($table_name, $title, "yyy", "StartTuts", 1);

		// Call the insert function to execute the INSERT statement
		$db_handle->insert($query, "sssi", array($title, "yyy", "StartTuts", 1));

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

	.link-container{
		height: 70px;
		max-width: 300px;
		background: yellow;
		color: black;
		padding: 5px;
		border: solid 2px black;
		font-size: 30px;
	}


	.flex-container {
		display: flex;
		gap: 200px;
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
	<br><br>

	<?php
		include("admin_nav.php");

	?>
	<br>

	<center><h2><u><?php echo $result[0]['project_name'] ?></u></h2></center>

	<br>

	<center>
	<div class="link-container">
		<?php echo "<a href=".$result[0]['project_link'].">Repo Link</a>" ?>
	</div>
	</center>
	<br><br>

	<div class="flex-container">
		<div class="flexible-container">
			<br>
			<center>Employees</center>
			<hr>
			<?php
			
				$query = "SELECT * FROM users";
				$result = $db_handle->runBaseQuery($query);
				echo "<table> <thead>
				<tr>
				  <th scope='col'>EMP_ID</th>
				  <th scope='col'>EMP_NAME</th>
				</tr>
			  </thead>
			  <tbody>";
				
				foreach($result as $row) 
				{
					echo "<tr>
					<th scope='row'>".$row['user_id']."</th>
					<th scope='row'>".$row['user_name']."</th>
					</tr>";
				}
				echo "</tbody></table>";
			
			?>
			<br>
			<a href="signup.php">Add new user?</a>
			<br>
		</div>
		<div class="fixed-container">
		<br>
			<center>Assign Tasks</center>
			<hr>
			<form method="post">
				<div style="font-size: 20px;margin: 10px;color: black;">Enter Employee Id</div>
				<input id="text1" type="text" name="user_id" placeholder="enter employee id"><br>
				<div style="font-size: 20px;margin: 10px;color: black;">Enter task</div>
				<input id="text1" type="text" name="title" placeholder="task"><br><br>

				<input id="button" type="submit" value="Assign"><br><br>

			</form>
		</div>
	</div>

	<br><br><br>



</body>
</html>