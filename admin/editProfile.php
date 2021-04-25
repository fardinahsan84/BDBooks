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
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/entryform.css">
  <style>
  .footer {
    text-align: center;
    padding: 5px;
    margin-top:50px;
    background-color: #515151;
    color: white;
  }
  .footer a{
  	color: white;
      text-decoration: none;
      font-weight: bold;
  }
  .footer p{
    width: 400px;
    margin-bottom:-10px;
  }
  </style>
<?php
$fnameErr = $lnameErr = $emailErr = $genderErr = $remailErr = $passwordErr = $unameErr = "";

$fname = $lname= $email = $gender = $remail = $uname = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $fnameErr = "*First name is required";
  } else {
  if (ctype_alpha($_POST["fname"]) === false) {
           $fnameErr = "*Your First name only should be in letters.";
          }
		  else{
		  $fname = test_input($_POST["fname"]);
		  }
  }

  if (empty($_POST["lname"])) {
    $lnameErr = "*Last name is required";
  } else {
	  if (ctype_alpha($_POST["lname"]) === false) {
           $lnameErr = "*Your Last name only should be in letters.";
          }
		  else{
		  $lname = test_input($_POST["lname"]);
		  }
  }

  if (empty($_POST["gender"])) {
    $genderErr = "*Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "*Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }

  if (empty($_POST["uname"])) {
    $unameErr = "Username is required";
  } else {
    $uname = test_input($_POST["uname"]);
  }

  if (empty($_POST["password"])) {
    $passwordErr = "*Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }

  if (empty($_POST["remail"])) {
    $remailErr = "*Recovery email is required";
  } else {
    $remail = test_input($_POST["remail"]);
  }
  if($fname != "" && $lname != "" && $email != "" && $gender !="" && $uname != "" && $password != "" && $remail != "")
   {
     $user = array("fname"=>$fname, "lname"=>$lname, "email"=>$email, "gender"=>$gender,
                    "uname"=>$uname, "password"=>$password, "rEmail"=>$remail, "type"=>"user");

                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }
                    else{
                        echo "Connection successful";
                        $semail= $_SESSION["email"];
                        $sql = "UPDATE users SET firstName='$fname', lastName='$lname', email='$email', gender='$gender',
                                uname='$uname', password='$password', recoveryEmail='$remail' WHERE email='$semail' ";
                          if ($connection->query($sql) === TRUE) {
                            echo "Updated successfully";
                            header('Location:http://localhost/BDBooks/admin/home.php');
                            exit();
                          }
                    }
      }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  ?>
<title>
Edit profile
</title>
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
<div class="testbox">
  <h1>My Profile</h1>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <?php $admin=$users->getUserByEmailPass($_SESSION["email"],$_SESSION["password"]); ?>
<hr>
  <span class="error"> <?php echo $fnameErr;?></span>
  <label id="txt" for="fname">First Name</label>
  <input type="text" name="fname" id="fname" value="<?php echo $admin->firstName; ?>"/>

  <span class="error"> <?php echo $lnameErr;?></span>
  <label id="txt" for="lname">Last Name</label>
  <input type="text" name="lname" id="lname" value="<?php echo $admin->lastName; ?>"/>

  <span class="error"> <?php echo $emailErr;?></span>
  <label id="txt" for="email">Email</label>
  <input type="email" name="email" id="email" value="<?php echo $admin->email; ?>"/>

  <span class="error"> <?php echo $remailErr;?></span>
  <label id="txt" for="remail">Recovery Email</label>
  <input type="email" name="remail" id="remail" value="<?php echo $admin->recoveryEmail; ?>"/>

  <span class="error"> <?php echo $unameErr;?></span>
  <label id="txt" for="uname">Username</label>
  <input type="text" name="uname" id="uname" value="<?php echo $admin->uname; ?>"/>

  <span class="error"> <?php echo $passwordErr;?></span>
  <label id="txt" for="password">password</label>
  <input type="password" name="password" id="password" value="<?php echo $admin->password; ?>"/><br>

  <label id="txt" for="gender">Gender</label>
    <input type="radio" value="None" id="male" name="gender" checked/>
    <label for="male" class="radio" chec>Male</label>
    <input type="radio" value="None" id="female" name="gender" />
    <label for="female" class="radio">Female</label>


   <p>By clicking Update your data will update, if you wish to <a href="/BDBooks/admin/home.php">cancel</a>click here!</p>

   <input class="button" type="submit" value="Update" />
  </form>
</div>
<div class="footer">
  <?php include '../assets/layout/footer.php' ; ?>
</div>
</body>
</html>
