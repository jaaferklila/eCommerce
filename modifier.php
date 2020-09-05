
<?php
session_start();
$titre="profil";
include'includes/function/function.php';
include'includes/template/header.php';
if (isset($_SESSION['user'])) {


       if ($_SERVER['REQUEST_METHOD']=="POST") {
  		$name=$_POST["name"];
  		$email=$_POST["email"];
       $prenom=$_POST['prenom'];
       $telephone=$_POST['telephone'];
		$password=empty($_POST['newpassword'])?$_POST['oldpassword']:sha1($_POST['newpassword']);

		$stat=$con->prepare("UPDATE mombre SET name=?,prenom=?,telephone=?,email=?,password=? where id=?");
		$stat->execute(array($name,$prenom, $telephone,$email,$password,$_SESSION['ran']));

         
          header("location:profil.php");
		$_SESSION['user']=$name;
	}

 }
else{

	echo "impossible de visiter cette page directement";
}
include'includes/template/footer.php';
?>

