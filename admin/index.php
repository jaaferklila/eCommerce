
<?php
/*==============================================
  ==============================================

 ================Index Page=================

 ================================================
 ================================================
*/
session_start();
if (isset($_SESSION['admin'])) {
	
	header('location:dahbord.php');
}
$titre="Login admin";
include'includes/function/function.php';
include'connect.php';
include'includes/template/header.php';

if ($_SERVER['REQUEST_METHOD']=="POST") {
	$name=$_POST['user'];
	$pass=sha1($_POST['password']);
$stat=$con->prepare("SELECT name,password,id FROM mombre where  name=? and password=? and isadmin=1");
$stat->execute(array($name,$pass));
$row=$stat->fetch();
$count=$stat->rowcount();

if ($count>0) {
$_SESSION['nom']= $row['name'];
$_SESSION['ran']= $row['id'];


header('location:dahbord.php');
exit();
}
}

?>


<form class="login"  action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
	<h4 class="text-center">Login Admin</h4>
	<div> </div>
	<input  class="form-control" type="text" name="user" placeholder="your name" autocomplete="off">
	<input class="form-control" type="password" name="password" placeholder="your password" autocomplete="off">
	<input class="btn btn-primary btn-block " type="submit" name="login1" value="LOGIN">

</form>



<?php
include'includes/template/footer.php';