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
if(($_SESSION["type"] != "user") && ($_SESSION["type"] != "admin"))
{
  header('Location:http://localhost/BDBooks/login.php');
	exit();
}

if(isset($_POST["add_to_cart"]))
{
  if(isset($_SESSION["book_cart"]))
  {

      $book_array_id = array_column($_SESSION["book_cart"], "id");
      print_r( $book_array_id);
      if(!in_array($_GET["id"], $book_array_id))
      {
        $count= count($_SESSION["book_cart"]);
        $book_array= array(
          'id'        => $_GET["id"],
          'bname'     => $_GET["bn"],
          'price'     => $_GET["pr"],
          'quantity'  => $_POST["quantity"]
        );

        $_SESSION["book_cart"][$count] = $book_array;
      }
      else {
        echo '<script>alert("This book is already added")</script>';
        echo '<script>alertwindow.location="/BDBooks/users/buyBook.php"</script>';
      }
  }
  else
  {
    $book_array= array(
      'id'        => $_GET["id"],
      'bname'     => $_GET["bn"],
      'price'     => $_GET["pr"],
      'quantity'  => $_POST["quantity"]
    );
    $_SESSION["book_cart"][0] = $book_array;
  }
  header('Location: http://localhost/BDBooks/users/checkout.php');
  exit();

}


?>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/buy.css">
  <link rel="stylesheet" href="../assets/css/header.css">
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

<?php $bk = $books->getBookById($_GET["id"]); ?>
<!-- single product details -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$bk->id."&bn=".$bk->bname."&pr=".$bk->price;?>" method="post">
<div class="small-container single-product">
  <div class="row">
    <div class="col-2">
      <img src="<?=@$bk->image?>" alt=""  width="75%" id="ProductImg" />
    </div>
    <div class="col-2">
      <p>Home / Book</p>
      <h1><?php echo $bk->bname;?></h1>
      <h4><?php echo"Price:". $bk->price." Tk";?></h4>
      <h4><?php echo"Writer:". $bk->author;?></h4>
      <h4><?php echo"Publication:". $bk->pub;?></h4>
      <input type="number" name="quantity" value="1" min="1" />
      <input type="submit" name="add_to_cart" class="btn" value="Add to cart">

      <h3>Book Description <i class="fas fa-indent"></i></h3>
      <br />
      <p>
        <?php echo $bk->des;?>
      </p>
    </div>
  </div>
</div>
</form>

<!-- title -->
<div class="small-container">
  <div class="row row-2">
    <h2>Related Products</h2>
    <a href="/BDBooks/index.php"><p>View more</p></a>
  </div>
</div>

<!-- products -->
<?php $allbook=$books->getAllBooks(); ?>
<div class="small-container">
  <div class="row">
    <?php for($i=0; $i<3; $i++){?>
    <div class="col-4">
      <a href="/BDBooks/users/buyBook.php?id=<?php echo $allbook[$i]->id; ?>" ><img src="<?=@$allbook[$i]->image ?>" alt="" style="border: 3px solid #555" /></a>
      <h4><?php echo $allbook[$i]->bname;?></h4>
      <div class="rating">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="far fa-star"></i>
        <i class="far fa-star"></i>
        <i class="far fa-star"></i>
      </div>
      <p><?php echo $allbook[$i]->author;?></p>
      <p><?php echo "Price:".$allbook[$i]->price."Tk";?></p>

    </div>
  <?php } ?>
  </div>
</div>
<div class="footer">
  <?php include '../assets/layout/footer.php' ; ?>
</div>
</body>
</html>
