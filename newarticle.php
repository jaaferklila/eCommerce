<?php

session_start();
$titre="Ajouter un article";
include'includes/function/function.php';
include'includes/template/header.php';
if (isset($_SESSION['user'])) {

if ($_SERVER['REQUEST_METHOD']=='POST') {

	$name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
	$description=filter_var($_POST['description'],FILTER_SANITIZE_STRING);
	$prix=filter_var($_POST['prix'],FILTER_SANITIZE_NUMBER_INT);
	$pays=filter_var($_POST['pays'],FILTER_SANITIZE_STRING);
	$categorie=filter_var($_POST['categorie'],FILTER_SANITIZE_NUMBER_INT);
	$etat=filter_var($_POST['etat'],FILTER_SANITIZE_NUMBER_INT);
	
$formerrors=array();
if (empty($_POST['name'])) {
	$formerrors[]="le nom de l'article est obligatoire";

}
if (empty($description)) {
	$formerrors[]="la description de l'article est obligatoire";
	# code...
}
if (empty($_POST['prix'])) {
	$formerrors[]="le prix de l'article est obligatoire";
	# code...
}
if (empty($_POST['pays'])) {
	$formerrors[]="le pays de l'article est obligatoire";
	# code...
}




if (isset($_POST['prix'])) {
         if (filter_var($prix,FILTER_SANITIZE_NUMBER_INT)!=true ) {
            $formerrors[]="votre prix n'est pas valide";
            }
        }
        

        	
            if (filter_var($categorie,FILTER_SANITIZE_NUMBER_INT)!=true) {
            	$formerrors[]="le categorie n'est pas valide";
             }


            if (filter_var($etat,FILTER_SANITIZE_NUMBER_INT)!=true) {

            	$formerrors[]="l'etat de l'article non valide";
            }
            if (empty($formerrors)) {
            	$stat=$con->prepare("INSERT INTO article (name,description,prix,pays,etat,date_ajout,approuver,	IDcategorie,IDmombre) Values (:zname,:zdescription,:zprix,:zpays,:zetat,now(),0,:zIDcategorie,:zIDmombre)");
		$stat->execute(array(
            ':zname'           =>$name,
            ':zdescription'    => $description  ,  
			':zprix'           =>$prix,
			':zpays'           =>$pays,
			':zetat'           =>$etat,
             ':zIDmombre'       => $_SESSION['ran'],
			  ':zIDcategorie'   =>$categorie

		));
		$ajout=$stat->rowcount();
		header('REFRESH:01;newarticle.php');

            }
 
}
	?>

<div class="container">
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter un article</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-md-8">

							<div class="errors text-center">
										<?php if (isset($ajout)) {
											if ($ajout==1) {
											echo "<div class='ajout'>ajout avec suuce";						
											echo "</div>";
																	}
										}	
												
										 if (!empty($formerrors)) {
											 foreach ($formerrors as $errors) {
										            	echo "<div class='msg'>".$errors."</div><br>";
										            }} ?>
</div>
							
					    	<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
					    		<div class=" form-group form-group-lg">
					    			<label class="col-sm-2 control-label">Nom</label>
					    			<div class="col-sm-2 col-md-8">
					    				<input type="text" name="name" class="form-control live-name" placeholder="nom de l'article" required autocomplete="off"/>
					    				
					    			</div>
					    		</div> 
					    		<div class="form-group form-group-lg">
					    			<label class="col-sm-2 control-label">Description</label>
					    			<div class="col-sm-2 col-md-8">
					    				<input type="text" name="description" value="" required="required" class="form-control live-description" autocomplete="off" placeholder="description de l'article" />
					    				
					    			</div>
					    		</div>
					    		<div class="form-group form-group-lg">
					    			<label class="col-sm-2  control-label">Prix</label>
					    			<div class="col-sm-2 col-md-8">
					    				<input type="text" name="prix" class="form-control prix" placeholder="prix de l'article"  required autocomplete="off"/>
					    				
					    			</div>
					    			
					    		</div>
					    		<div class="form-group form-group-lg">
					    		<label class="col-sm-2 control-label">Pays</label>
					    		<div class="col-sm-02 col-md-8">
					    			<input type="text" name="pays" class="form-control" required="required" placeholder="pays de fabrication" autocomplete="off" />
					    			</div>
					    		</div>

					    		
                                  <div class="form-group form-group-lg">
					    			<label class="col-sm-2 control-label">Catgorie</label>
					    		<div class="col-sm-02 col-md-8">
					    				<select  class="form-control" name="categorie" >
					    					<option value="0">...</option>
					    					<?php $stat=$con->prepare("SELECT * FROM categories");

					                          $stat->execute();
					                          $rows=$stat->fetchAll();
					                          foreach ($rows as $row) {
					                          echo	"<option value='".$row['id']."'>".$row['name']."</option>";
					                          }
					    					 ?>

					    				</select>
					    				
					    			</div>
					    			
					    		</div>


					    		<div class="form-group form-group-lg">
					    			<label class="col-sm-2 control-label">Etat</label>
					    		<div class="col-sm-02 col-md-8">
					    				<select class="form-control" required="required"  name="etat">
					    					<option value="0">...</option>
					    					<option value="1">Nouveau</option>
					    					<option value="2">comme nouveau</option>
					    					<option value="3">utilisé</option>
					    				</select>
					    				
					    			</div>
					    		</div>

					    		
					    		<div class="form-group form-group-lg">
					    		<div class="col-sm-offset-2 col-sm-2">
					    			<input type="submit" value="Ajouter" class="btn btn-primary btn-lg"/>

					    			</div>
					    		</div>
					    			
					    		
					    	</form>
					    	
    



						</div>
						<div class="col-md-4">
								
										<div class=' thumbnail item-box'>
										<span class='price'></span>

									   <img class='image-resonsive' src='image.jpg'/>
									    <div class='caption'>
										          <h3> </h3>
											      <p>   </p>
							          </div>
							   </div>
			         </div>
						</div>

						
					</div>
				</div>
			</div>
		</div>


<?php  }
else{
	header('location:login.php');
}

include'includes/template/footer.php';
?>

