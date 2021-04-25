<?php
session_start();
if(empty($_SESSION))
{
	header('Location:http://localhost/BDBooks/login.php');
	exit();
}
$filepath = "../data/bookdb.json";
$f3 = fopen($filepath, "r");
$data = fread($f3, filesize($filepath));
$data_decoded = json_decode($data, true);
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
h1 {
	text-align:center;
}
span {color: #FF0000;}
.image {
	float :left;
	margin-left : 15em;
	margin-top: 1em;
}
.info {
	float:left;
	margin: 5em 10em 0 2em;
	font-weight: bold;
	text-aligh: left;
	font-size: 20px;

}
.hero {
    background: #307D99;
    color: white;
	background-size: cover;
    text-align: left;
    padding-bottom: 50em;
	padding-top: 2em;
}
</head>
</style>
<body>
<body>
<div class="heading">
	<div class="site-logo">
		<a target="_blank" href="/BDBooks/index.php">
		<img src="/BDBooks/assets/images/bookslogo.PNG" alt="logo" width="300" height="60">
		</a>
	</div>

</div>
<ul>
<li><a class="active" href="/BDBooks/index.php">Home</a></li>
<li><a href="/BDBooks/users/news.php">News</a></li>
<li><a href="/BDBooks/users/contact.php">Contact</a></li>
<li><a href="/BDBooks/users/about.php">About</a></li>
<li><a href="/BDBooks/users/allBooks">All books</a></li>
<li><a href="/BDBooks/users/newArrival">New Arrival</a></li>
  <li><a href="/BDBooks/admin/home.php">Samanta</a></li>
  <li><a href="/BDBooks/logout.php">Sign out</a></li>
</ul>
<div class="hero">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="form-design">
		<h1>Book added successfully</h1><br>
		<div class="image">
			<img src="<?=@$data_decoded[1]["path"]?>" width="400" height="400" />
		</div>
		<div class="info">
		<?php
			echo "Book name :" . $data_decoded[1]["bname"] ."<br>";
			echo "Author :" . $data_decoded[1]["author"] . "<br>";
			echo "Price :" . $data_decoded[1]["price"] . "Tk" . "<br>";
			echo "Publication :" . $data_decoded[1]["pub"] . "<br>";
			echo "Description :" . $data_decoded[1]["des"];
		?>
		</div>
		</div>
</div>
<div class="footer">
  <?php include '../assets/layout/footer.php' ; ?>
</div>
</body>
</html>
