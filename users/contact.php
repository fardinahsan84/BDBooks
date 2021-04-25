<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/css/header.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

body {
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}
*{
	margin :0px;
	padding : 0px;
}
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
.heading .site-logo {
  margin-left: 20px;
}
/* Style inputs */
input[type=text],[type=email], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}


input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

/* Style the container/contact section */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 10px;
}

/* Create two columns that float next to eachother */
.column {
  float: left;
  width: 50%;
  margin-top: 6px;
  padding: 20px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column, input[type=submit] {
    width: 100%;
    margin-top: 0;
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
	<li><a href="/BDBooks/users/news.php">News</a></li>
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

<div class="container">
  <div style="text-align:center">
    <h2>Contact Us</h2>
    <p>Official mail: bdbooks@gmail.com</p>
  </div>
  <div class="row">
    <div class="column">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7299.2641000097055!2d90.4127929750428!3d23.831679838197292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c65e78f46ee1%3A0x3e009fd37c89634f!2sNikunja%202%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1616428605807!5m2!1sen!2sbd" width="600" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div class="column">
    <form action="/action_page.php" method="post">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="firstname" placeholder="Your name..">
        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastname" placeholder="Your last name..">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Your email..">
        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:170px"></textarea>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
</div>

<div class="footer">
  <?php include '../assets/layout/footer.php' ; ?>

</div>
</body>

</html>
