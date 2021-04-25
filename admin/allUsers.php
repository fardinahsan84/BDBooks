<?php
session_start();
require '../model/dataaccess.php';
require_once '../model/User.php';
$users = new User($connection);
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
all Users
</title>
<style>
*, *:before, *:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  font-family: 'Nunito', sans-serif;
  color: #384047;
}

table {
  max-width: 960px;
  margin: 10px auto;
}

caption {
  font-size: 1.6em;
  font-weight: 400;
  padding: 10px 0;
}

thead th {
  font-weight: 400;
  background: #8a97a0;
  color: #FFF;
}

tr {
  background: #f4f7f8;
  border-bottom: 1px solid #FFF;
  margin-bottom: 5px;
}

tr:nth-child(even) {
  background: #e8eeef;
}

th, td {
  text-align: left;
  padding: 20px;
  font-weight: 300;
}

tfoot tr {
  background: none;
}

tfoot td {
  padding: 10px 2px;
  font-size: 0.8em;
  font-style: italic;
  color: #8a97a0;
}

.error {color: #FF0000;}
h1 {
	text-align:center;
}
span {color: #FF0000;
	font-size:20px;
	margin-left:40em;
}

}
.hero {
    background: #307D99;
    color: white;
	background-size: cover;
    text-align: left;
    padding-bottom: 50em;
	padding-top: 2em;
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
	<li><a href="/BDBooks/users/allBooks">All books</a></li>
	<li><a href="/BDBooks/users/newArrival">New Arrival</a></li>
  <li><a href="/BDBooks/admin/home.php"><?php echo $_SESSION["fname"] ?></a></li>
  <li><a href="/BDBooks/logout.php">Sign out</a></li>
</ul>
<div class="hero">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<div class="form-design">

					<?php
					$user = $users->getAllUsers();
	        if(!empty($user)){ ?>

                <table>
        <caption>Users Information</caption>
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Gender</th>
            <th scope="col">E-mail</th>
            <th scope="col">Username</th>
            <th scope="col">Password</th>
            <th scope="col">Recovery Email</th>
          </tr>
        </thead>
        	<?php foreach ($user as $usr){
            if($usr->type=="user"){?>
        <tbody>
          <tr>
            <th scope="row"><?php echo $usr->firstName ." ". $usr->lastName; ?></th>
            <td><?php echo $usr->gender; ?></td>
            <td><?php echo $usr->email; ?></td>
            <td><?php echo $usr->uname; ?></td>
            <td><?php echo $usr->password; ?></td>
            <td><?php echo $usr->recoveryEmail; ?></td>
          </tr>
        </tbody>
      <?php } }?>
      </table>
				</div>
      <?php }
					else{ echo "<span>There is no user in the array</span>"; }?>

	</div>
</div>
<div class="footer">
  <?php include '../assets/layout/footer.php' ; ?>
</div>
</body>
</html>
