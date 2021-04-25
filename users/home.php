<?php
session_start();
if(empty($_SESSION))
{
	header('Location:http://localhost/BDBooks/login.php');
	exit();
}
if($_SESSION["type"] != "user")
{
	header('Location:http://localhost/BDBooks/login.php');
	exit();
}
$host = "localhost";
		$user = "root";
		$pass = "";
		$db = "bookbd";
		// Create connection
		$conn = new mysqli($host, $user, $pass, $db);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/header.css">
<title>
home page
</title>
<style>

.error {color: #FF0000;}
span {color: #FF0000;}
th {
  text-align: left;
}

</style>
</head>
<body>
<div class="heading">
	<div class="site-logo">
		<a target="_blank" href="/BDBooks/dashboard/index.html">
		<img src="/BDBooks/assets/images/bookslogo.PNG" alt="logo" width="300" height="60">
		</a>
	</div>

</div>
<ul>
<li><a class="active" href="/BDBooks/index.php">Home</a></li>
<li><a href="/BDBooks/users/news.php">News</a></li>
<li><a href="/BDBooks/users/contact.php">Contact</a></li>
<li><a href="/BDBooks/users/about.php">About</a></li>
<li><a href="/BDBooks/index.php">New Arrival</a></li>
<li><a href="/BDBooks/index.php">All Books</a></li>
  <li><a href="/BDBooks/users/home.php"><?php echo $_SESSION["email"]; ?></a></li>
  <li><a href="/BDBooks/logout.php">Sign out</a></li>
</ul>
<div class="hero-bg">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="form-design">
		<h1>Welcome to home page!!</h1><br>
		<h2><?php echo $_SESSION["email"]; ?> </h2>
		<h3><a href="">Logout<a></h3>
		<?php

			echo "Connection successful";
			$email= $_SESSION["email"];
			$sql = "SELECT * FROM users WHERE email='$email' ";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
					$_SESSION["fname"]= $row["firstName"];
					echo "Name :" . $row["firstName"] ." ". $row["lastName"] . "<br>";
					echo "Email :" . $row["email"] . "<br>";
					echo "Gender :" . $row["gender"] . "<br>";
					echo "Recovery email :" . $row["recoveryEmail"];
			  }
			}
		?>
		</div>
	</form>
 </div>
 <div class="footer">
	<?php include '../assets/layout/footer.php' ; ?>
</div>
<center>

</center>
</body>
</html>
