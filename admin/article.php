<?php
/*==============================================
  ==============================================

 ================items Page=================

 ================================================
 ================================================
*/
ob_start();
session_start();
$titre="Article";
//start session
if(isset($_SESSION['nom'])){
	include'connect.php';
  include'includes/function/function.php';
	include'includes/template/header.php';
  include'includes/template/navbar.php';
    
$do=isset($_GET['do'])?$_GET['do']:'article';

if ($do=="article") {

	$stat=$con->prepare("SELECT

	                        article.*,
	                          categories.name as name_categorie,
	                           mombre.name as name_mombre
	                         FROM 
	                             article 
                            INNER JOIN 
                               categories
                             on 
                              categories.id=article.IDcategorie

                           INNER JOIN
                                   mombre
                           on 
                                 mombre.id=article.IDmombre;


		                     ");
$stat->execute();
$rows=$stat->fetchAll();
$stat->rowcount();
?>
<h1 class="text-center">Gérer Article</h1>
<div class="container"><a href="article.php?do=ajouter" class="btn btn-success"><i class="fa fa-user-plus"></i>Ajouter Article</a>
	
     <div class="table-responsive">
          <table class="main-table text-center table table-bordered article" >
               <tr>
                       <td>ID</td>
                    <td>Nom</td>
                    <td>Description</td>
                    <td>Prix</td>
                     <td>Date</td>
	                 <td>nom_categorie</td>
	                 <td>nom_mombre</td>
                     
                    
                    <td>Gére article</td>
               </tr>
               <?php foreach ($rows as $row ) {?>
<tr>
                       <td><?php echo $row['idarticle']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td ><div  class="description"><?php echo $row['description']; ?></div></td>
                    <td><?php echo $row['prix']; ?></td>
                     <td><?php echo $row['date_ajout']; ?></td>
                    <td><?php echo $row['name_categorie']; ?></td>
                    <td><?php echo $row['name_mombre']; ?></td>
                    
                  
                    
                 
                    <td>
                          <a href="article.php?do=modifier&id=<?php echo $row['idarticle'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Modifier</a>
                         <a href="article.php?do=supprimer&id=<?php echo $row['idarticle'] ?>" class="btn btn-danger confirm"><i class="fa fa-times"></i>supprimer</a>
                             <?php

                                 if ($row['approuver']==0) {   ?>
                                   

                                        <a href="article.php?do=approuver&id=<?php echo $row['idarticle'] ?>" class="btn btn-info "><i class="fa fa-check"></i>Approuver</a>

                             <?php    }
                       ?>
                      
                       </td>

               </tr>

     
               <?php  }



 ?>
                
               
          </table>
     </div>
     
</div>
<?php }
elseif ($do=="ajouter") {?>
  <h1 class="text-center">Ajouter article</h1>
    <div class="container">
					    	<form class="form-horizontal" action="article.php?do=insert" method="POST" enctype="multipart/form-data">
					    		<div class=" form-group form-group-lg">
					    			<label class="col-sm-4 control-label">Nom</label>
					    			<div class="col-sm-10 col-md-4">
					    				<input type="text" name="nom" class="form-control" placeholder="nom de l'article" />
					    				
					    			</div>
					    		</div> 
					    		<div class="form-group form-group-lg">
					    			<label class="col-sm-4 control-label">Description</label>
					    			<div class="col-sm-10 col-md-4">
					    				<input type="text" name="description" value="" required="required" class="form-control" placeholder="description de l'article" />
					    				
					    			</div>
					    		</div>
					    		<div class="form-group form-group-lg">
					    			<label class="col-sm-10 col-md-4 control-label">Prix</label>
					    			<div class="col-sm-10 col-md-4">
					    				<input type="text" name="prix" class="form-control" placeholder="prix de l'article" />
					    				
					    			</div>
					    			
					    		</div>
					    		<div class="form-group form-group-lg">
					    		<label class="col-sm-10 col-md-4 control-label">Pays</label>
					    		<div class="col-sm-10 col-md-4">
					    			<input type="text" name="pays" class="form-control" required="required" placeholder="pays de fabrication" />
					    			</div>
					    		</div>

					    		<div class="form-group form-group-lg">
					    			<label class="col-ms-10 col-md-4 control-label">Mombre</label>
					    			<div class="col-sm-10 col-md-4">
					    				<select  class="form-control" name="mombre">
					    					<option value="0">...</option>
					    					<?php $stat=$con->prepare("SELECT * FROM mombre");

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
					    			<label class="col-ms-10 col-md-4 control-label">Catégorie</label>
					    			<div class="col-sm-10 col-md-4">
					    				<select  class="form-control" name="categorie">
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
					    			<label class="col-sm-10 col-md-4 control-label">Etat</label>
					    			<div class="col-sm-10 col-md-4">
					    				<select class="form-control" required="required"  name="etat">
					    					<option value="0">...</option>
					    					<option value="1">Nouveau</option>
					    					<option value="2">comme nouveau</option>
					    					<option value="3">utilisé</option>
					    				</select>
					    				
					    			</div>
					    		</div>

					    		<div class="form-group form-group-lg">
					    			<label class="col-sm-4 control-label">Image</label>
					    			<div class="col-sm-10 col-md-4">
					    				<input type="file" name="image" value="" required="required" class="form-control" placeholder="image" />
					    				
					    			</div>
					    		</div>
					    		<div class="form-group form-group-lg">
					    		<div class="col-sm-offset-4 col-sm-6">
					    			<input type="submit" value="Ajouter" class="btn btn-primary btn-lg"/>

					    			</div>
					    		</div>
					    	</form>
					    	
    </div>


<?php }

elseif ($do=="insert") {
	if ($_SERVER['REQUEST_METHOD']=="POST") {

		$nom=$_POST['nom'];
		$description=$_POST['description'];
		$prix=$_POST['prix'];
		$pays=$_POST['pays'];
		$etat=$_POST['etat'];
        $mombre=$_POST['mombre'];
        $categorie=$_POST['categorie'];
        $name=$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "..\images\\".$name);
        
		if (empty($etat)) {

		echo '<div class=" alert alert-danger  text-center">etat est obligatoire</div>';
		}

		$stat=$con->prepare("INSERT INTO article (name,description,prix,pays,etat,date_ajout,image,approuver,	IDcategorie,IDmombre) Values (:znom,:zdescription,:zprix,:zpays,:zetat,now(),:zname,1,:zIDcategorie,:zIDmombre)");
		$stat->execute(array(
            ':znom'           =>$nom,
            ':zdescription'    => $description  ,  
			':zprix'           =>$prix,
			':zpays'           =>$pays,
			':zetat'           =>$etat,
			'zname'           =>$name,
             ':zIDmombre'       => $mombre,
			  ':zIDcategorie'   =>$categorie

		));
		echo '<div class=" alert alert-succes col-sm-6 text-center">insertion avec succe</div>';
		//header('Refresh:2;article.php');

	}
	else{
		echo '<div class=" alert alert-danger col-sm-6 text-center">impossible de visiter ce lien directement</div>';
		//header('Refresh:2;article.php');
		
		
	}
	
}


elseif ($do=="modifier") {

	$id=isset($_GET['id'])?intval($_GET['id']):0;
         $stat=$con->prepare("SELECT * FROM article WHERE idarticle=?");
         $stat->execute(array($id));
         $row=$stat->fetch();

	 ?>
	<h1 class="text-center"> Modifier Article</h1>
	<div class="container">
			<form class="form-horizontal" action="article.php?do=update" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $id;?>">
						<div class="form-group form-group-lg">
								<label class="col-sm-10 col-md-4 control-label">Nom</label>
								<div class="col-sm-10 col-md-4">
								<input type="text"  value="<?php echo $row['name'] ;?>" name="name" class="form-control"/>
								</div>
						</div>

						<div class="form-group form-group-lg">
								<label class="col-sm-10 col-md-4 control-label">Description</label>
								<div class="col-sm-10 col-md-4">
									<input type="text" name="description" value="<?php echo $row['description'] ;?>" class="form-control"/>
								</div>
						</div>
						<div class="form-group form-group-lg">
								<label class="col-sm-10 col-md-4 control-label">Image</label>
								<div class="col-sm-10 col-md-4">
									<img src="images/<?php echo $row['image'] ;?>">
									<input type="file" name="imagearticle" class="form-control"/>
								</div>
						</div>
						<div class="form-group form-group-lg">
								<label class="com-sm-0 col-md-4  control-label">Prix</label>
								<div class="col-sm-10 col-md-4">
									<input type="text" name="prix" value="<?php echo $row['prix'] ;?>" class="form-control">
									
								</div>
							
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-10 col-md-4 control-label" >Pays</label>
							<div class="col-sm-10 col-md-4">
								<input type="text" name="pays" class="form-control" value="<?php echo $row['pays'] ;?>">
								
							</div>
							
						</div>
						<div class="form-group form-group-lg">
							<label class="col-sm-10 col-md-4 control-label" >Etat</label>
							<div class="col-sm-10 col-md-4">
								<select name="etat" class="form-control">
									<option  value="0">...</option>
									<option value="1" <?php if($row['etat']==1) echo "selected";  ?>>Nouveau</option>
									<option value="2"<?php if($row['etat']==2) echo "selected";  ?>>Comme nouveau</option>
									<option value="3"<?php if($row['etat']==3) echo "selected";  ?>>Utilisé</option>
									
								</select>
								
							</div>
							
						</div>
                        <div class="form-group form-group-lg">
							<label class="col-sm-10 col-md-4 control-label" >Mombre</label>
							<div class="col-sm-10 col-md-4">
								<select name="mombre" class="form-control">
									<?php 
									$stat=$con->prepare("SELECT * FROM mombre ");
									$stat->execute();
								$users=$stat->fetchAll();
								foreach ($users as $user) {
								
								
									?>
									<option  value="<?php echo $user['id'] ?>" 

										<?php if($user['id']==$row['IDmombre']){echo "selected";} ?>><?php echo
									$user['name']?></option>
									<?php } ?>
									
								</select>
								
							</div>
							
						</div>
                              <div class="form-group form-group-lg">
							<label class="col-sm-10 col-md-4 control-label" >Catégorie</label>
							<div class="col-sm-10 col-md-4">
								<select name="categorie" class="form-control">
									<?php 
									$stat=$con->prepare("SELECT * FROM categories ");
									$stat->execute();
								$categories=$stat->fetchAll();
								foreach ($categories as $categorie) {
								
								
									?>
									<option  value="<?php echo $categorie['id'] ?>" 

										<?php if($categorie['id']==$row['IDcategorie']){echo "selected";} ?>><?php echo
									$categorie['name']?></option>
									<?php } ?>
									
								</select>
								
							</div>
							
						</div>

                    <div class="form-group form-group-lg"></div>
                    <div class="col-sm-offset-4 col-sm-6">
                    	<input type="submit" value="Enregistré" class="btn btn-primary btn-lg">

                    </div>
			</form>
			
	</div>
	<?php

$stat=$con->prepare("SELECT commentaire.*, article.name as name_article, mombre.name as name_mombre FROM  commentaire  INNER JOIN article on article.idarticle=commentaire.id_article INNER JOIN mombre on mombre.id=commentaire.id_mombre where id_article=$id");
$stat->execute();
$rows=$stat->fetchAll();


                        
  
     
    


?>
<h1 class="text-center">Gérer Commentaire</h1>
<div class="container">
     <div class="table-responsive">
          <table class="main-table text-center table table-bordered" >
               <tr>
                       <td>ID</td>
                    <td>commentaire</td>
                    <td>nom_article</td>
                    <td>nom_mombre</td>
                     <td>date</td>
                    
                    <td>gérer commentaire</td>
                    
               </tr>
               <?php foreach ($rows as $row ) {?>
<tr>
                       <td><?php echo $row['idcommentaire']; ?></td>
                    <td><?php echo $row['commentaire']; ?></td>
                    <td><?php echo $row['name_article']; ?></td>
                    <td><?php echo $row['name_mombre']; ?></td>
                     <td><?php echo $row['date']; ?></td>
                 
                    <td>
                          <a href="commentaire.php?do=modifier&id=<?php echo $row['idcommentaire'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Modifier</a>
                         <a href="commentaire.php?do=supprimer&id=<?php echo $row['idcommentaire'] ?>" class="btn btn-danger confirm"><i class="fa fa-times"></i>supprimer</a>

                      
                       <?php

                                 if ($row['etat']==0) {   ?>
                                   

                                        <a href="commentaire.php?do=approuver&id=<?php echo $row['idcommentaire'] ?>" class="btn btn-info "><i class="fa fa-check"></i>Approuver</a>


                             <?php } ?>

                       
                       </td>
               </tr>

     
               <?php  }



 ?>
                
               
          </table>
     </div>
     
</div>
<?php }
elseif ($do=="update") {

   if ($_SERVER['REQUEST_METHOD']=="POST") {

   	 $idarticle=$_POST['id'];
             $nom= $_POST['name'];
             $description= $_POST['description'];
             $prix=$_POST['prix'];
             $pays=$_POST['pays'];
             $etat=$_POST['etat'];
             $categorie=$_POST['categorie'];
             $mombre=$_POST['mombre'];
             $name=$_FILES['imagearticle']['name'];
        move_uploaded_file($_FILES['imagearticle']['tmp_name'], "..\images\\".$name);
             
             



      $stat=$con->prepare("UPDATE article SET name=?,description=?,prix=?,pays=?,etat=?,image=?,IDcategorie=?,IDmombre=? WHERE idarticle=? ");
	$stat->execute(array($nom,$description,$prix,$pays,$etat, $name,$categorie,$mombre,$idarticle));
   	
   	 header('Refresh:2;article.php');
   }

   else{

   	echo "impossible de visiter ce lien directemnt";
   }
	
}

elseif ($do=="supprimer") {
	$idar=isset($_GET['id'])?intval($_GET['id']):0;
   $nombre=verif('idarticle','article',$idar);
   if ($nombre>0) {

   	$stat=$con->prepare(" DELETE FROM article WHERE idarticle=?");
	$stat->execute(array($idar));

 header('Refresh:0.0001;article.php');
   }
   else{
   	echo "cette id nexiste pas";
   }
	

	
}
elseif ($do=="approuver") {
$id=$_GET['id'];
  $stat=$con->prepare("UPDATE article SET approuver=1 where idarticle=$id");
    $stat->execute();

header("Refresh:0.000000000000000000000000000000000000000000000001;url=article.php");


}
include('includes/template/footer.php');
}
//end session
else{

	header('location:index.php');
}


ob_end_flush();
