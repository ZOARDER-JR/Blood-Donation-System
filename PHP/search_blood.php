<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="search_style.css">
	<link rel="stylesheet" type="text/css" href="home_style.css">
</head>
<body>
	<div class = "main_container" id="main_container">
		<div class = "nav_bar" id="nav_bar">
			<div class="nav1" id="nav1">
				<nav>
					<li><a href="search_blood.html" style="color: white; text-decoration: none">Search For Blood&nbsp&nbsp<img src="search.png" title="Search" alt = "Search" style="width: 20px; height:20px;"></a></li>
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
		</div><!--Nav bar ends-->
		<div class="form-style-5">
<form method="post" action="view.php">
<fieldset>
<legend>Search For Blood Donor In Your Area</legend>
<input type="text" name="find_city" placeholder="City">
<input type="text" name="find_area" placeholder="Area">
<select id="blood_group" name="blood_group">
  <option value="select_blood_group">Select Blood Group:</option>
  <option value="A+">A+</option>
  <option value="A-">A-</option>
  <option value="B+">B+</option>
  <option value="B-">B-</option>
  <option value="O+">O+</option>
  <option value="O-">O-</option>
  <option value="AB+">AB+</option>
  <option value="AB-">AB-</option>
</select>      
</fieldset>

<input type="submit" value="Search" name="donor_search" />
</form>
</div>
		<div class="footer" id="search_footer">
			<p>OverNight Website</p>
		</div>
	</div>
</body>
</html>