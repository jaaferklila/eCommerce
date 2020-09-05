
<?php

session_start();
$titre="modifier profil";
include'includes/function/function.php';
include'includes/template/header.php';
if (isset($_SESSION['user'])) {

if ($_SERVER['REQUEST_METHOD']=="POST") {
   	 $idarticle=$_POST['ar'];
      	$stat=$con->prepare(" DELETE FROM article WHERE idarticle=?");
	$stat->execute(array($idarticle));

header('Refresh:0.0001;profil.php');      
}
   else{

   	echo "impossible de visiter ce lien directemnt";
   }
	

}
else{
	header('location:login.php');
}
include'includes/template/footer.php';
?>














