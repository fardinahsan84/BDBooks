<?php
session_start();
require '../model/dataaccess.php';
require_once '../model/Book.php';
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/header.css">
<title>
all books
</title>
<style>

.error {color: #FF0000;}
h1 {
	text-align:center;
}
span {color: #FF0000;
	font-size:20px;
	margin-left:40em;
}
.image {
	float :center;
	margin-left : 15em;
	margin-top: 1em;
}
.info {
	float:right;
	margin:0 25em 0 2em;
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
.container .box {
                width:650px;
                margin:50px;
                display:table;
            }
            .container .box .box-row {
                display:table-row;
            }
            .container .box .box-cell {
                display:table-cell;
                width:200%;
                padding:5px;
            }
            .container .box .box-cell.box1 {
                float :center;

             }
            .container .box .box-cell.box2 {
				float:right;
				font-weight: bold;
				text-aligh: left;
				font-size: 20px;
				margin-bottom: 70px;
            }
			.container .box .box-cell.box2 a {
				text-decoration:none;
				font-size:bold;
			}
.button {
  font-family:'Open Sans';
  font-size: 16px;
  font-weight:400;
  display:inline-block;
  color:#FFF;
  border-radius: .25em;
  text-shadow: -1px -1px 0px rgba(0,0,0,0.4);
}

.primary {
  line-height:40px;
  transition:ease-in-out .2s;
  padding: 0 16px;
}
.primary:hover{
	background-color:#990000;
  transform:scale(1.02);
  box-shadow:2px 2px 5px rgba(0,0,0,0.20), inset 0 0 0 99999px rgba(0,0,0,0.2);
}
.edit:before, .delete:before {
  font-family: FontAwesome;
  display: inline-block;
  font-size:1rem;
  padding-right:12px;
  background:none;
  color:#FFF;
}
.edit {
  background-color: #9400D3;
  cursor: pointer;

  &:before {
    content: "\f040";
  }
}
.edit:hover {
	background-color: #4B0082;
}
.delete {
	cursor: pointer;
  background-color:#FF0000;

  &:before {
    content: "\f1f8";
  }
}
</style>
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
	<li><a href="/BDBooks/index.php">New Arrival</a></li>
  <li><a href="/BDBooks/index.php">All Books</a></li>
  <li><a href="/BDBooks/admin/home.php"><?php echo $_SESSION["fname"] ?></a></li>
  <li><a href="/BDBooks/logout.php">Sign out</a></li>
</ul>
<div class="hero">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<div class="form-design">
		<h1>All books list</h1><br>

					<?php
					$book = $books->getAllBooks();
	        if(!empty($book)){
							foreach ($book as $bk){ ?>
							<div class="container">
								<div class="box">
									<div class="box-row">
										<div class="box-cell box1">
										<img src="<?=@$bk->image?>" width="300" height="350" />
										</div>
										<div class="box-cell box2">
										<?php echo "Book name :" . $bk->bname ."<br>";
										echo "Author :" . $bk->author . "<br>";
										echo "Price :" . $bk->price . "Tk" . "<br>";
										echo "Publication :" . $bk->pub . "<br>";
										echo "Description :" . $bk->des ."<br><br>"; ?>
										<a class="button primary edit" href="/BDBooks/admin/editBook.php?id=<?php echo $bk->id;?>">Edit</a>
										<a class="button primary delete" href="/BDBooks/admin/deleteBook.php?id=<?php echo $bk->id;?>">Delete</a>
										</div>
									</div>
								</div>
				</div>
					<?php } }
					else{ echo "<span>There is no book in the array</span>"; }?>

	</div>
</div>
<div class="footer">
  <?php include '../assets/layout/footer.php' ; ?>
</div>
</body>
</html>
