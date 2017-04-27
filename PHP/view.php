

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="home_style.css">
</head>
<body>
	<div class = "main_container" id="main_container">
		<div class = "nav_bar" id="nav_bar">
			<div class="nav1" id="nav1">
				<nav>
					<li><a href="search_blood.php" style="text-decoration: none; color: white">Search For Blood&nbsp&nbsp  <img src="search.png" alt="Search" style="width: 20px; height:20px;"></a> </li>
				</nav>
			</div>
			<div class="nav2" id = "nav2" >
				<nav>
					<li><a href="home.php" style="color:white;"> <img src="home_green.png" title="Home" alt = "Home" style="width: 28px; height:28px;"></a></li>&nbsp&nbsp|
					<li><a href="profile.php" style="color:white;"><img src="profile.png" title="Profile" alt = "Profile" style="width: 28px; height:28px;"></a></li>&nbsp&nbsp|
					<li><a href="profile.php" style="color:white;"><img src="notifications.png" title="Notifications" alt = "Notifications" style="width: 28px; height:28px;"></a></li>&nbsp&nbsp|
					<li><a href="profile.php" style="color:white;"><img src="message1.png" title="Messages" alt = "Messages" style="width: 28px; height:28px;"></a></li>&nbsp&nbsp|
					<li><a href="logout.php" style="color:white;"><img src="logout.png" title="Logout" alt = "Logout" style="width: 28px; height:28px;"></a></li>
				</nav>
			</div>
        </div>
        <div>
        	<?php
				include('connect.php');

				if(isset($_POST['donor_search']))
				{
					$scity=$_POST['find_city'];
					$sarea=$_POST['find_area'];
					$sbg=$_POST['blood_group'];

					$sql="select * from user where (city='$scity' OR area='$sarea' OR bgroup='$sbg')";

					$result = mysqli_query($conn,$sql);

					while($row = mysqli_fetch_array($result))
					{
						echo"<div class='view'>";

							echo "<table width='100%'>";
								echo "<tr>";
									echo "<td>";
										echo "<b> Name: <b>" . $row['fname']. " " . $row['lname'] . "<br>";
										echo "<b> Blood Group: <b>" . $row['bgroup'] . "<br>";
										echo "<b> Area: <b>" . $row['area'] . "<br>";
										echo "<b> City: <b>" . $row['city'] . "<br>";
										echo "<b> Contact: <b>" . $row['contact'] . "<br>";
									echo "</td>";
									echo "<td>";
										echo "<p> Photo </p>";
									echo "</td>";
									echo "<td>";
										echo "<p> Call / Message </p>";
									echo "</td>";
								echo "</tr>";
							echo "</table>"; 
						echo"</div>";

					}
				}
			?>

        </div>
	</div>
</body>
</html>