<?php

session_start();
$titre="modifier profil";
include'includes/function/function.php';
include'includes/template/header.php';
if (isset($_SESSION['user'])) {

if ($_SERVER['REQUEST_METHOD']=="POST") {
   	 $idarticle=$_POST['id'];
             $nom= $_POST['name'];
             $description= $_POST['description'];
             $prix=$_POST['prix'];
             $pays=$_POST['pays'];
             $etat=$_POST['etat'];
             $categorie=$_POST['categorie'];
            
      
      $stat=$con->prepare("UPDATE article SET name=?,description=?,prix=?,pays=?,etat=?,IDcategorie=?,IDmombre=? WHERE idarticle=? ");
	$stat->execute(array($nom,$description,$prix,$pays,$etat,$categorie,$_SESSION['ran'],$idarticle));
   	
   	 header('Refresh:0;profil.php');
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