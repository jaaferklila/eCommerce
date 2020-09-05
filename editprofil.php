<?php
session_start();
$titre="Modifier profil";
include'includes/function/function.php';
include'includes/template/header.php';
if (isset($_SESSION['user'])) { 

$stat=$con->prepare("SELECT * FROM mombre where id=?");
                	$stat->execute(array($_SESSION['ran']));
                	$row=$stat->fetch();
                  $count=$stat->rowcount();
                  

         ?>
               	<h1 class="text-center">Modifier Mombre</h1>
      <div class="container">
     		<!-- Start name --> 
     	<form class="form-horizontal" method="POST" action="modifier.php">
     		<input type="hidden" name="userid" value="<?php echo $row['id']; ?>">
        <div class="form-group form-group-lg">
     		<label class="col-sm-4 control-label"> Nom </label>
     		<div class="col-sm-10 col-md-4">
     			<input type="text" name="name" value="<?php echo $row['name']; ?>"class="form-control" autocomplete="off"/>
     			</div>
     		</div>
     		<!-- end name --> 
        <div class="form-group form-group-lg">
        <label class="col-sm-4 control-label">Prénom</label>
        <div class="col-sm-10 col-md-4">
          <input type="text" name="prenom" required="" value="<?php echo $row['prenom']; ?>" class="form-control" autocomplete="off"/>
          
        </div>
      </div>
     			<!-- Start email --> 
     	<div class="form-group form-group-lg">
     		<label class="col-sm-4 control-label">Email</label>
     		<div class="col-sm-10 col-md-4">
     			<input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" autocomplete="off"/>
     			
     		</div>
     	</div>
     		<!-- end email --> 
         <div class="form-group form-group-lg">
        <label class="col-sm-4 control-label">Télephone</label>
        <div class="col-sm-10 col-md-4">
          <input type="number" name="telephone" required="" value="<?php echo $row['telephone']; ?>" class="form-control" autocomplete="off"/>
          
        </div>
      </div>
     			<!-- start password --> 
     	<div class="form-group form-group-lg">
     		<label class="col-sm-4 control-label">Mot de passe</label>
     		<div class="col-sm-10 col-md-4">
     			<input type="hidden" value="<?php echo $row['password'] ;?>" name="oldpassword" class="form-control"/>
     			<input type="password"  value="" name="newpassword" class="form-control password"/>
     			  <i class=" show-password fa fa-eye fa-2x"></i>
     		</div>
     	</div>
     		<!-- end password --> 
     			<!-- Start button --> 
                 <div class="form-group form-group-lg">
                  <div class="col-sm-offset-4 col-sm-6">
     			     <input type="submit" value="Modifier mombre" class="btn btn-primary"/>
     			
     		</div>
     	</div>
     		<!-- end button --> 
     	</form>
     </div><?php

	

 }
else{

	echo "impossible de visiter cette page directement";
}

include'includes/template/footer.php';
?>