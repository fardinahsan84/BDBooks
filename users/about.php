<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/css/header.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
}

.about-section {
  padding: 50px;
  text-align: center;
  background-color: #474e5d;
  color: white;
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}

@media screen and (max-width: 650px) {
  .column {
    width: 60%;
    display: block;
  }
}
</style>
</head>
<div class="heading">
	<div class="site-logo">
		<a target="_blank" href="/BDBooks/index.php">
		<img src="/BDBooks/assets/images/bookslogo.PNG" alt="logo" width="300" height="60">
		</a>
	</div>
</div>
<ul>
  <li><a class="active" href="/BDBooks/index.php">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="/BDBooks/users/contact.php">Contact</a></li>
  <li><a href="/BDBooks/users/about.php">About</a></li>
  <li><a href="/BDBooks/index.php">New Arrival</a></li>
  <li><a href="/BDBooks/index.php">All Books</a></li>
  <?php if(isset($_SESSION["email"])){?>
  <li><a href="/BDBooks/users/home.php"><?php echo $_SESSION["fname"]; ?></a></li>
  <li><a href="/BDBooks/logout.php">Sign out</a></li>
  <?php }
  else{?>
  <li><a href="/BDBooks/login.php">Sign in</a></li>
  <li><a href="/BDBooks/users/register.php">Sign up</a></li>
  <?php } ?>
</ul>
<body>

<div class="about-section">
  <h1>About Us</h1>
  <p>BDBooks is now one of the leading e-commerce organizations in Bangladesh. It is indeed the biggest
    online bookshop or bookstore in Bangladesh that helps you save time and money. You can buy books online
    with a few clicks or a convenient phone call. You can buy anything
    from Bangla Upannash or English story books to academic, research or competitive exam books. Superfast cash
    on delivery service brings the products at your doorstep. Our customer support, return and replacement
    policies will surely add extra confidence in your online shopping experience. Happy Shopping with BDBooks.com!</p>

</div>

<h2 style="text-align:center">Our Team</h2>
<div class="row">
  <div class="column">
    <div class="card">
      <img src="/BDBooks/assets/images/p1.jpg" alt="p1" style="width:60%" style="height:80%">
      <div class="container">
        <h2>Samanta Sadia</h2>
        <p class="title">CEO & Founder</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>samantasadia1911@gmail.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="/BDBooks/assets/images/p2.jpg" alt="p2" style="width:60%" >
      <div class="container">
        <h2>Samanta Sadia</h2>
        <p class="title">Art Director</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>samantasadia1911@gmail.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="/BDBooks/assets/images/p3.jpg" alt="p3" style="width:60%">
      <div class="container">
        <h2>Samanta Sadia</h2>
        <p class="title">Designer</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>samantasadia1911@gmail.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
</div>
<div class="footer">
  <?php include '../assets/layout/footer.php' ; ?>
</div>
</body>
</html>
