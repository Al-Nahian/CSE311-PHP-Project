<?php 
	session_start();
	if ($_SESSION['id']) {
		echo "Hello " . $_SESSION['id']. (";");
	}
	else
		header("Location: teacherlogin.php");

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Teacher Portal</title>
</head>
<body>
	<div class="header">
		<h1>Welcome to Teacher Portal!</h1>
	</div>


	<div class="see">
		<form method="post">
			<p><button type="submit" name="seeres">Click</button> to see serial numbers of results.</p>
		</form>

		<?php 

		if (isset($_POST['seeres'])) 
		{
			$mydb = mysqli_connect('localhost','root','','project');
			$sql1=mysqli_query($mydb,"SELECT * FROM results");
 				if(mysqli_num_rows($sql1)>=1)
   				{
   					echo "<table border = '1'><tr><th>No.</th><th>ID</th><th>Course Name</th><th>Section</th><th>Faculty</th><th>Semester</th><th>Grade</th>";
    				while ($row = mysqli_fetch_assoc($sql1)) 
    				{
   						echo "<tr><td>".$row['no']."</td><td>".$row['id']."</td><td>".$row['c_name']."</td><td>".$row['section']."</td><td>".$row['initial']."</td><td>".$row['semester']."</td><td>".$row['grade']."</td>";
    				}
   				}else
  				{
 					echo('No result found!');
  				}
  			}
		 ?>


	</div>
	

	<div class="edres">
		<form method="post">
			<p>
				<label>Enter the serial no. you want to edit :</label>
				<form method="post">
					<input type="number" name="serial" placeholder="Serial number">
					<button type="submit" name="done">Edit</button>
				</form>

				<?php 

					if (isset($_POST['done'])) {
						$_SESSION['serial'] = $_POST['serial'];
						header("Location: update.php");
					}
					
				 ?>

			</p>

			
		</form>
	</div>
</body>
</html>