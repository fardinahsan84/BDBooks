<?php
session_start();
require 'model/dataaccess.php';
require_once 'model/Book.php';
$books = new Book($connection);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/header.css">
<style>
div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 180px;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
  color: white;
  background-color: #d17c06;
}
a:link {
  text-decoration: none;
  text-color: white;
}

input[type=button]{
    background-color: #f3920a;
    border: none;
    width: 100%;
    color: white;
    padding: .5em 0;
    font-size: 1.3em;
    cursor: pointer;
}

input[type=button]:hover{
    background-color: #d17c06;
}

div.top {
  content: "";
  clear: both;
  display: table;
  padding-top:2em;
  padding-left:20em;
}
div.bottom {
  padding: 2em 5em 0 20em;
}


</style>
</head>
<body>
<div class="heading">
	<div class="site-logo">
		<a target="_blank" href="/BDBooks/index.php">
		<img src="/BDBooks/assets/images/bookslogo.PNG" alt="logo" width="300" height="60">
		</a>
		<div class="search-container">
			<form action="/BDBooks/users/search.php" method="get">
			  <input type="text" placeholder="Search book.." name="search">
			  <button type="submit" ><i class="fa fa-search"></i></button>
			</form>
		</div>
	</div>
</div>

<ul>
  <li><a class="active" href="/BDBooks/index.php">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="/BDBooks/users/contact.php">Contact</a></li>
  <li><a href="/BDBooks/users/about.php">About</a></li>
  <li><a href="/BDBooks/index.php">New Arrival</a></li>
  <li><a href="/BDBooks/index.php">All Books</a></li>
  <?php if(isset($_SESSION["email"])){
    if($_SESSION["type"]=="user"){?>
      <li><a href="/BDBooks/users/home.php"><?php echo $_SESSION["fname"]; ?></a></li>
    <?php } else{ ?>
      <li><a href="/BDBooks/admin/home.php"><?php echo $_SESSION["fname"]; ?></a></li>
    <?php } ?>
  <li><a href="/BDBooks/logout.php">Sign out</a></li>
<?php }
else{?>
  <li><a href="/BDBooks/login.php">Sign in</a></li>
  <li><a href="/BDBooks/users/register.php">Sign up</a></li>
<?php } ?>
</ul>
<?php $allbook=$books->getAllBooks();
 ?>
<div class="hero-bg">
   <div class="top">
     <?php for($i=0; $i<count($allbook); $i++){
       $path_parts = pathinfo($allbook[$i]->image);
       $image="assets/uploads/".$path_parts['basename'];?>
		<div class="gallery">
		  <a target="_blank" href="/BDBooks/users/buyBook.php?id=<?php echo $allbook[$i]->id; ?>">
			<img src="assets/uploads/<?php echo $path_parts['basename']; ?>" alt="" width="600" height="400">
		  <div class="desc"><?php echo $allbook[$i]->author;?><br>
                      <?php echo "Price :".$allbook[$i]->price." Tk"; ?> </div>

		  <input type="button" value="Buy now"></a>
		</div>
  <?php } ?>



	</div>
	<div class="bottom">
	<div class="gallery">
	  <a target="_blank" href="img_mountains.jpg">
		<img src="/BDBooks/assets/images/ural.jpg" alt="Serina" width="600" height="400">
	  </a>
	  <div class="desc">Add a description of the image here</div>
	  <input type="button" value="Buy now">
	</div>
	<div class="gallery">
	  <a target="_blank" href="img_mountains.jpg">
		<img src="/BDBooks/assets/images/science.jpg" alt="science" width="600" height="400">
	  </a>
	  <div class="desc">Add a description of the image here</div>
	  <input type="button" value="Buy now">
	</div>
	<div class="gallery">
	  <a target="_blank" href="img_mountains.jpg">
		<img src="/BDBooks/assets/images/ajami.jpg" alt="52BookCover" width="600" height="400">
	  </a>
	  <div class="desc">Add a description of the image here</div>
	  <input type="button" value="Buy now">
	</div>
	<div class="gallery">
	  <a target="_blank" href="img_mountains.jpg">
		<img src="/BDBooks/assets/images/capler22B.jpg" alt="capler22B" width="600" height="400">
	  </a>
	  <div class="desc">Add a description </div>
	  <input type="button" value="Buy now">
	</div>
	</div>
</div>
<div class="footer">
  <?php include 'assets/layout/footer.php' ; ?>
</div>
</center>
</body>
</html>
