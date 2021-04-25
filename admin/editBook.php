<?php
session_start();
require '../model/dataaccess.php';
require '../model/Book.php';
$books = new Book($connection);
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

$bnameErr = $authorErr = $priceErr = $pubErr = $desErr ="";
$bname = $author= $price = $pub = $des = $file_field = "";
$book = $books->getBookById($_GET["id"]);


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


  if (empty($_POST["pub"])) {
    $pubErr = "publication is required";
  } else {
    $pub = test_input($_POST["pub"]);
  }

  if (empty($_FILES["file_field"])) {
    $oldfile = $_GET["pt"];
    $file_field = $oldfile;
    $target_dir = "../assets/uploads/";
		$target_file = $target_dir . $file_field;
  } else {
    $file_field = $_FILES["file_field"];
    $target_dir = "../assets/uploads/";
		$target_file = $target_dir . basename($_FILES["file_field"]["name"]);
  }

  if($bname != "" && $author != "" && $price != "" && $des !="" && $pub != "" && $file_field != "")
   {

     echo $oldfile;
    echo $target_file;
	   if (move_uploaded_file($_FILES["file_field"]["tmp_name"], $target_file))
	   {
					if ($connection->connect_error) {
            echo "Connection failed";
			 		  	die("Connection failed: " . $connection->connect_error);
			 		}
			 		else{
				 			echo "Connection successful";
              $sql = "UPDATE book SET bname='$bname', author='$author', price='$price',
                      des='$des', pub='$pub', image='$target_file' WHERE id='$book->id' ";
			 					if ($connection->query($sql) === TRUE) {
			 						echo "Updated successfully";
									header('Location:http://localhost/BDBooks/admin/home.php');
									exit();
								}
	   			}
   	}
    else
    {
      echo 'Image upload error !!';
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
<?php $path_parts = pathinfo($book->image);?>
<div class="hero-bg">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$book->id."&pt=".$path_parts['basename'];?>" method="post" enctype="multipart/form-data">
		<div class="form-design">
		<h1>Edit book</h1>
    <?php
      if(!empty($book)){ ?>
		<span class="error"> <?php echo $bnameErr;?></span>
		<div class="lb">
			<label for="bname">Book Name:</label>
			<div>
				<input type="text" id="bname" name="bname" value="<?php echo $book->bname ?>">
			</div>
		</div>
		<span class="error"> <?php echo $authorErr;?></span>
		<label for="author">Author:</label>
		<input type="text" id="author" name="author" value="<?php echo $book->author ?>">

		<span class="error"> <?php echo $priceErr;?></span>
		<label for="price">Price:</label>
		<input type="number" id="price" name="price" value="<?php echo $book->price ?>">

		<span class="error"> <?php echo $pubErr;?></span>
		<label for="pub">Publication:</label>
		<input type="text" id="pub" name="pub" value="<?php echo $book->pub ?>">

		<span class="error"> <?php echo $desErr;?></span>
		<label for="des">Description:</label>
		<textarea name="des" rows="6" cols="22"><?php echo $book->des ?></textarea>

		<label for="file_field">Upload Book image:</label>
		<input type="file" id="file_field" name="file_field" >

		<input type="submit" name="submit" value="Update">
  <?php } ?>
      </div>
</form>
</div>
<div class="footer">
	<?php include '../assets/layout/footer.php' ; ?>
</div>
</center>
</body>
</html>
