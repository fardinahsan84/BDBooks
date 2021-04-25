<?php
session_start();
require '../model/dataaccess.php';
require_once '../model/Book.php';
$books = new Book($connection);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/header.css">
<title>
search
</title>
<style>
div.desc {
  padding: 15px;
  text-align: center;
  color: white;
  background-color: #d17c06;
  margin: 0 30em 0 30em;
}

input[type=button]{
    background-color: #f3920a;
    border: none;
    color: white;
    text-align: center;
    padding: .5em 7.5em .5em 7.5em;
    font-size: 1.3em;
    cursor: pointer;
    margin: 0 30em 0 23em;
}

input[type=button]:hover{
    background-color: #d17c06;
}
a:link {
  text-decoration: none;
  text-color: white;
}
body {
  font-family: Arial, Helvetica, sans-serif;
}
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

	margin-top: 1em;
}
.info {
	float:right;
	margin:0 25em 0 2em;
	font-weight: bold;
	text-align: left;
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
                margin-left:auto;
                margin-right:auto;
                width:650px;

                display:table;
            }
            .container .box .box-row {
                display:table-row;
                font-weight:bold;
                font-size: 20px;

            }
            .container .box .box-cell {
                display:table-cell;
                width:200%;
                padding:5px;
            }
            .container .box .box-cell.box1 {

                margin-left:auto;
                margin-right:auto;

             }
            .container .box .box-cell.box2 {
				float:right;
				font-weight: bold;
				text-align: left;
				font-size: 20px;
				margin-bottom: 150px;
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
	<li><a href="/BDBooks/index.php">All books</a></li>
	<li><a href="/BDBooks/index.php">New Arrival</a></li>
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
<?php $bk=$books->getBookByName($_GET["search"]);
 ?>
<div class="hero-bg">

  <?php if(!empty($bk)){?>
		<div class="gallery">
		  <a target="_blank" href="/BDBooks/users/buyBook.php?id=<?php echo $bk->id; ?>">
			<img src="<?=@$bk->image ?>" alt="" width="400" height="480">
		  <div class="desc"><?php echo "Writer".$bk->author; ?><br>
                      <?php echo "Price".$bk->price." Tk"; ?>
        </div>

		  <input type="button" value="Buy now"></a>
		</div>
  <?php }
  else{
    echo "<h3>There is no book with this name</h3>";
  } ?>
</div>
<div class="footer">
  <?php include '../assets/layout/footer.php' ; ?>
</div>
</body>
</html>
