<?php

	session_start();

	$pemail = $_SESSION['puser'];

	include('connect.php');
?>

<html>
<head>
	<title>User Profile</title>
	<link rel="stylesheet" type="text/css" href="user_profile_style.css">
</head>

<body>
	<div class = "main_container" id="main_container">
		<div class = "nav_bar" id="nav_bar"> <!-- Navigation Bar -->
				<div class="nav2" id="nav2">
				<nav>
					<li><a href="search_blood.php" style="text-decoration: none; color: white">Search For Blood&nbsp&nbsp  <img src="search.png" alt="Search" style="width: 20px; height:20px;"></a> </li>
				</nav>
			</div>
			<div id = "nav1" class="nav1">
				<nav>
					<li><a href="home.php" style="color:white;"> <img src="home_green.png" title="Home" alt = "Home" style="width: 27px; height:27px;"></a></li>&nbsp&nbsp|
					<li><a href="profile.php" style="color:white;"><img src="profile.png" title="Profile" alt = "Profile" style="width: 27px; height:27px;"></a></li>&nbsp&nbsp|
					<li><a href="profile.php" style="color:white;"><img src="notifications.png" title="Notifications" alt = "Notifications" style="width: 27px; height:27px;"></a></li>&nbsp&nbsp|
					<li><a href="profile.php" style="color:white;"><img src="message1.png" title="Messages" alt = "Messages" style="width: 27px; height:27px;"></a></li>&nbsp&nbsp|
					<li><a href="index.php" style="color:white;"><img src="logout.png" title="Logout" alt = "Logout" style="width: 27px; height:27px;"></a></li>
				</nav>
			</div>
		</div>

		<div class = "div_1" id="div_1">
			<div class = "photo" id="photo">
				<p>Photo</p>
			</div>

			<div class = "profile_info" id="profile_info">

				<?php

					$sql= "select * from user where email = '$pemail'";

					$result = mysqli_query($conn,$sql);
					echo "<h2>User Information</h2>";
					while ($row = mysqli_fetch_array($result))
					{
						echo "<b> User ID: <b>" . $row['ID']."<br>";
						echo "<b> Name: <b>" . $row['fname']. " " . $row['lname'] . "<br>";
						echo "<b> Blood Group: <b>" . $row['bgroup'] . "<br>";
						echo "<b> Area: <b>" . $row['area'] . "<br>";
						echo "<b> City: <b>" . $row['city'] . "<br>";
						echo "<b> Contact: <b>" . $row['contact'] . "<br>";
					}


				?>

			</div>
		</div>
		<div class = "div_2" id="div_2">
			<div class = "menu" id="menu">
				<p>About Menu</p>
			</div>

			<div class = "details" id="details">
				<p>Details</p>
			</div>
		</div>
		<div class="footer" id="footer">
			<p>OverNight website</p>
		</div>
	</div>
</body>
</html>