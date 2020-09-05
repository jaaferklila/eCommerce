

<?php 
ob_start();
session_start();
if (isset($_SESSION['user'])) {
	header('location:profil.php');
}
$titre="Login user";
include'admin/connect.php';
include'includes/function/function.php';
include'includes/template/header.php';

	 if ($_SERVER['REQUEST_METHOD']=="POST") {
          if (isset($_POST['login'])) {
          	$nomuser=$_POST['name'];
	          $pass=sha1($_POST['password']);
$stat=$con->prepare("SELECT name,password,image,id,active FROM mombre where  name=? and password=? and isadmin=0");
$stat->execute(array($nomuser,$pass));
$row=$stat->fetch();
$count=$stat->rowcount();

if ($count>0) {
$_SESSION['user']= $row['name'];
$_SESSION['ran']= $row['id'];


header('location:profil.php');
exit();
}
          }
          else{
          $name= filter_var($_POST['name'],FILTER_SANITIZE_STRING) ;
          $prenom=filter_var($_POST['prenom'],FILTER_SANITIZE_STRING) ;
           $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL) ;
           $password=sha1($_POST['password']);
           $passverif=sha1($_POST['verifpassword']);
           $formerrors=array();
            if (empty($name)) {

            	$formerrors[]="votre nom est obligatoire";
            }
             if (verif('name','mombre',$name)>1) {

            	$formerrors[]="vous ete deja inscrit";
            }
            if (empty($prenom)) {

            	$formerrors[]="votre prenom est obligatoire";
            }
            if (empty($email)) {

            	$formerrors[]="votre email est obligatoire";
            }
            if (filter_var($email,FILTER_SANITIZE_EMAIL)!=true) {

            	$formerrors[]="votre email n'est valide";
            }
            if (isset($_POST['password'])) {
            	if (empty($_POST['password'])) {
            		$formerrors[]="votre mot de passe est obligatoire";
            	}

            	
           
            if (!empty($password)and ($password!==$passverif)) {

            	$formerrors[]="votre mot de passe non identique";
            } }
           
            if (empty($formerrors)) {
            	$stat=$con->prepare("INSERT INTO mombre (name,prenom,email,password,active,date,isadmin)  VALUES (:zname,:zprenom,:zemail,:zpassword,0,now(),0)");
                   $stat->execute(array(
                      	'zname'=>$name,
						'zprenom'=>$prenom,
						'zemail'=>$email,
						'zpassword'=>$password
                  

                   ));
                   echo $stat->rowcount();

            }
          }


	
	
}



 ?>
 <div class="container login">
 	<h3 class="text-center">
 		<span data-class="loginform" class="selected connecter"> Se connecter</span>  |<span  data-class="signup" class="creercompte">Créer un compte</span>   
 	</h3>
 	<div class="errors text-center">
		<?php if (isset($count)){
			if ($count==0) {
				 echo "<div class='msg'>corrdonnes non valide</div>";
			}

	   
}
		?></div>

 	<form class="loginform" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST"> 
	
    
		<input class="form-control"  type="text" name="name" placeholder="Taper votre nom">

		<input class="form-control " type="password" name="password" placeholder="Taper votre mot de passe" >
		<input  class="btn btn-primary btn-block " name="login" type="submit" value="Connecter" >
		
</form>
 </div>


<form class="signup" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST"> 
	   <input class="form-control"  type="text" name="name" placeholder="Taper votre nom" />
		<input class="form-control"  type="text" name="prenom" placeholder="Taper votre prenom" >
		<input class="form-control" type="email" name="email" placeholder="Taper votre email" >
		<input class="form-control  "    type="password" name="password" placeholder="Taper votre mot de passe">
		<input class="form-control  "    type="password" name="verifpassword" placeholder="Confirmer votre mot de passe">
			
		
		<input  class="btn btn-success btn-block" type="submit" value="Créer un compte" >
		
</form>
<div class="errors text-center">
<?php 	
 if (!empty($formerrors)) {
	 foreach ($formerrors as $errors) {
            	echo "<div class='msg'>".$errors."</div><br>";
            }} ?>
</div>
</div>






 <?php 
include'includes/template/footer.php';
ob_end_flush();
  ?>