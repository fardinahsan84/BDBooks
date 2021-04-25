<?php
require '../model/dataaccess.php';
session_start();
if(empty($_SESSION))
{
	header('Location:http://localhost/BDBooks/login.php');
	exit();
}
if($_SESSION["type"] != "admin")
{
  header('Location:http://localhost/BDBooks/login.php');
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>
home page
</title>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
  width: 12%;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

a:link {
  text-decoration: none;
}
h1 {
	text-align:center;
}
.hero-bg {
    background: #307D99;
    color: white;
	background-size: cover;
    padding-bottom: 50em;
	padding-top: 2em;
}
.hero-bg a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.2rem;
	margin-left:12em;

}
form {
    margin: 6px auto;
    width: 45%;
    background-color: #727070;
    height: 1100px;
    border-radius: 10px;
    box-shadow: 1px 1px 5px 0px ;
	padding-bottom:3em;
}
form label ,input, textarea {
    display: block;

}
form label ,input, textarea {
    padding: 10px;
    width: 355px;
    margin-bottom: 12px;
    position: relative;
    left: 74px;
}
form input, textarea {
    border: none;
    border-radius: 10px;
    box-shadow: 0px 1px 1px 0px #000;
    padding: 15px;
}
form input[type=submit] {
    background-color: #06d6a0;
    width: 386px;
    margin: 26px 0px 12px 0px;
    font-size: 20px;
    color: #FFF;
	cursor: pointer;
}
form label  {
    margin-bottom: -3px;
    margin-left: -6px;
    font-size: 20px;
}
span {
    color: red;
	margin-left:8em;
	font-size: 20px;
}
.error {

	color: #FF0000;

	}
.form-design{
	position: static;

}
.footer {
  text-align: center;
  padding: 20px;
  background-color: #515151;
  color: white;
}
.footer a{
	color: white;
    text-decoration: none;
    font-weight: bold;
}
.error {color: #FF0000;}
span {color: #FF0000;}
th {
  text-align: left;
}
</style>
<?php
//margin-left: 40em;
	//margin-top: 5em;
// define variables and set to empty values
$idErr = $bnameErr = $authorErr = $priceErr = $pubErr = $desErr = $fileErr = "";

$id = $bname = $author= $price = $pub = $des = $file_field = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["bname"])) {
    $bnameErr = "Book name is required";
  } else {
    $bname = test_input($_POST["bname"]);
  }

  if (empty($_POST["author"])) {
    $authorErr = "Author name is required";
  } else {
    $author = test_input($_POST["author"]);
  }

  if (empty($_POST["price"])) {
    $priceErr = "Price is required";
  } else {
    $price = test_input($_POST["price"]);
  }

  if (empty($_POST["des"])) {
    $desErr = "Description is required";
  } else {
    $des = test_input($_POST["des"]);
  }

  if (empty($_FILES["file_field"])) {
    $fileErr = "Image is required";
  } else {
    $file_field = $_FILES["file_field"];
  }

  if (empty($_POST["pub"])) {
    $pubErr = "publication is required";
  } else {
    $pub = test_input($_POST["pub"]);
  }

  if($bname != "" && $author != "" && $price != "" && $des !="" && $pub != "" && $file_field != "")
   {
		$target_dir = "../assets/uploads/";
		$target_file = $target_dir . basename($_FILES["file_field"]["name"]);
	   if (move_uploaded_file($_FILES["file_field"]["tmp_name"], $target_file))
	   {

			 if ($connection->connect_error) {
					 die("Connection failed: " . $connection->connect_error);
			 }
			 else{
					 echo "Connection successful";
					 $sql = "INSERT INTO book (bname, author, price, des, pub, image)
							 VALUES ('$bname', '$author', '$price' ,'$des', '$pub', '$target_file')";

					 if ($connection->query($sql) === TRUE) {
							 echo "New record created successfully";
							 header('Location: http://localhost/BDBooks/index.php');
							 exit();
					 }

							$conn->close();
			 }
	   }
   }
   else
   {
	   echo 'upload error!!';
   }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  ?>
</head>
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
  <li><a href="/BDBooks/admin/home.php"><?php echo $_SESSION["fname"];?></a></li>
  <li><a href="/BDBooks/logout.php">Sign out</a></li>
</ul>
<div class="hero-bg">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
		<div class="form-design">
		<h1>Add new Book</h1>

		<span class="error"> <?php echo $idErr;?></span>

		<span class="error"> <?php echo $bnameErr;?></span>
		<div class="lb">
			<label for="bname">Book Name:</label>
			<div>
				<input type="text" id="bname" name="bname">
			</div>
		</div>
		<span class="error"> <?php echo $authorErr;?></span>
		<label for="author">Author:</label>
		<input type="text" id="author" name="author">

		<span class="error"> <?php echo $priceErr;?></span>
		<label for="price">Price:</label>
		<input type="number" id="price" name="price">

		<span class="error"> <?php echo $pubErr;?></span>
		<label for="pub">Publication:</label>
		<input type="text" id="pub" name="pub">

		<span class="error"> <?php echo $desErr;?></span>
		<label for="des">Description:</label>
		<textarea name="des" rows="4" cols="22"></textarea>

		<span class="error"> <?php echo $fileErr;?></span>
		<label for="file_field">Upload Book image:</label>
		<input type="file" id="file_field" name="file_field">

		<input type="submit" name="submit" value="ADD">
      </div>
</form>
</div>
<div class="footer">
	<?php include '../assets/layout/footer.php' ; ?>
</div>
</center>
</body>
</html>
