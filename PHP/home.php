<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="home_style.css">
</head>

<?php

	session_start();

	$pemail = $_SESSION['puser'];

	include('connect.php');

	$sql= "select fname,lname from user where email = '$pemail'";

	$result = mysqli_query($conn,$sql);

	$row = mysqli_fetch_array($result);

	$pfname=$row['fname'];
	$plname=$row['lname'];

	if(isset($_POST['set_status']))
	{
		$status = $_POST['status'];

		$sql="insert into statustable (fname,lname,status,time) values ('$pfname','$plname','$status',now())";

		$result = mysqli_query($conn,$sql);
	}
?>

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
		<div class = "home_div_left" id="home_div_left">	
        	<p>Menu</p>
		</div>
        
		<div class = "home_div_middle" id="home_div_middle">
        	<div class="home_div_middle_status" id="home_div_middle_status">

            <form method = "post" action="home.php">
            	<textarea placeholder="What blood group do you need" name="status" id="status" rows="2" cols="100" style="border:none">
            	</textarea>
				<input type="submit" name="set_status" value="Post"/>
            </form>

			</div>
            <div class="home_div_middle_newsfeed" id="home_div_middle_newsfeed">
            	<?php
            		$sql= "select fname,lname,status,time from statustable order by ID desc ";

					$result = mysqli_query($conn,$sql);

					while($row = mysqli_fetch_array($result))
					{
						echo "<div class='home_div_middle_status'>";
						echo "<b>" . $row['fname']. " " . $row['lname'] . "</b><br>";
						echo $row['status'] . "<br>";
						echo "<p align='right'>" .  $row['time'] . "</p>"; 
						echo "</div>";
					}

            	?>
            	
            </div>
		</div>
        
		<div class="home_div_right" id="home_div_right">
			<div class="home_div_right_donor" id="home_div_right_donor">
				<p>Top Donors</p>
			</div>

			<?php
				echo "<br><br><b>Area</b><br>"; 
			?>
			<div class="home_div_right_area" id="home_div_right_area">
				<?php
            		$sql= "select distinct area from user ";

					$result = mysqli_query($conn,$sql);

					while($row = mysqli_fetch_array($result))
					{
						echo $row['area'] . "<br>";	
					}

            	?>
			</div>
		</div>
        <div class="footer">
        <p>OverNight Webiste</p>
        </div>
	</div>
</body>
</html>