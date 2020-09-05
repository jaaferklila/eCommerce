<?php
/*==============================================
  ==============================================

 ================Commentaire Page=================

 ================================================
 ================================================
*/
ob_start();
session_start();
$titre="Commentaire";
if(isset($_SESSION['nom'])) {
  include'connect.php';
   include'includes/function/function.php';
  include"includes/template/header.php";
  include'includes/template/navbar.php';


$do=isset($_GET['do'])?$_GET['do']:'commentaire';


if ($do=="commentaire") {


$stat=$con->prepare("SELECT commentaire.*, article.name as name_article, mombre.name as name_mombre FROM  commentaire  INNER JOIN article on article.idarticle=commentaire.id_article INNER JOIN mombre on mombre.id=commentaire.id_mombre");
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

                                 if ($row['etatcom']==0) {   ?>
                                   

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



elseif ($do=="modifier") {
	                $commentaireid=isset($_GET['id'])?$_GET['id']:0;

                	$stat=$con->prepare("SELECT * FROM commentaire where idcommentaire=?");
                	$stat->execute(array($commentaireid));
                	$row=$stat->fetch();
                  $count=$stat->rowcount();

                     if ($count>0) { ?>
               	<h1 class="text-center">Modifier Commentaire</h1>
      <div class="container">
     	
                 	<form class="form-horizontal" method="POST" action="commentaire.php?do=update">
                       		<input type="hidden" name="idcommentaire" value="<?php echo $row['idcommentaire']; ?>">
                          <div class="form-group form-group-lg">
                       		<label class="col-sm-4 control-label"> Commentaire </label>
                       		<div class="col-sm-10 col-md-4">
                            <textarea class="form-control" name="commentaire"><?php echo $row['commentaire']; ?></textarea>

                       			</div>
                       		</div>
                      		<!-- end name --> 
                         
                       			<!-- Start button --> 
                                   <div class="form-group form-group-lg">
                                    <div class="col-sm-offset-4 col-sm-6">
                       			     <input type="submit" value="Modifier commentaire" class="btn btn-primary"/>
                       			
                       		</div>
                       	</div>
                 		<!-- end button --> 
                 	</form>
     </div>
     	
    <?php  }

     else{
     	echo "id n'existe pas";
     }

	?>

	
<?php }
elseif ($do=="update") {

	if ($_SERVER['REQUEST_METHOD']=="POST") {
       $idcommentaire=$_POST['idcommentaire'];
  		$commentaire=$_POST["commentaire"];
  		
		$stat=$con->prepare("UPDATE commentaire SET commentaire=? where idcommentaire=?");
		$stat->execute(array($commentaire,$idcommentaire));

         header('Refresh:2;commentaire.php');
          
		
	}
	else{

		echo "impossibe de viste ce lien directement";
	}
	
}
elseif ($do=="supprimer") {
     $idcommentaire=isset($_GET['id'])?$_GET['id']:0;
          $stat=$con->prepare("delete  FROM commentaire where idcommentaire=?");
         $stat->execute(array($idcommentaire));
        
        echo "la supprssion est effectuer";
        header("Refresh:0; URL=commentaire.php?do=commentaire");

     
}
// start code liste de nombre

// END code liste de nombre
// start code liste de nombre non active

     
               
                
               
          
// END code liste de nombre non actif
// start code liste de nombre 
elseif ($do=="approuver") {
$idcommentaire=$_GET['id'];
  $stat=$con->prepare("UPDATE commentaire SET etatcom=1 where idcommentaire=$idcommentaire");
    $stat->execute();

header("Refresh:0.000000000000000000000000000000000000000000000001;url=commentaire.php?do=commentaire");


}


	?>


	<?php
	include('includes/template/footer.php');
}



else{

	header('location:index.php');
}
ob_end_flush();
