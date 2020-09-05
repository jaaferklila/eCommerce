<?php

session_start();
$titre="profil";
include'includes/function/function.php';
include'includes/template/header.php';

$id=isset($_GET['id'])?intval($_GET['id']):0;
         $stat=$con->prepare("SELECT  article.*,categories.name as namecategorie ,mombre.name as namemombre
              from article 
              INNER JOIN categories
              ON 
              categories.id=article.IDcategorie
              INNER JOIN mombre
              ON 
                 mombre.id=article.IDmombre
          WHERE idarticle=?");

         $stat->execute(array($id));
         $row=$stat->fetch();
         $count=$stat->rowcount();


         if ( $count>0) {
         	echo"<h3 class='text-center'>".$row['name']."</h3>" ;?>
        <div class="container">
        	<div class="row">
        		<div class="col-md-3">
        			<img class='image-resonsive img-thumbnail ' src='images/<?php echo $row['image'];  ?>'/>
        		</div>
        		<div class="col-sm-9 item-info">
        			<h2><?php echo $row['name'];  ?></h2>
        			<ul class="list-unstyled">

	        			<li>
	        				<i class="fa fa-file fa-fw"></i>
	        				<span>Description:</span> <?php echo $row['description'];  ?></li>
	        			<li><i class="fa fa-money-bill-alt"></i><span>Prix:</span><?php echo $row['prix']."$";  ?>
	        		</li>
	        			<li>
	        				<i class="fa fa-building fa-fw"></i><span>Pays:</span><?php echo $row['pays'];  ?></li>
	        			<li><i class="fa fa-calendar fa-fw"></i><span>Date:</span><?php echo $row['date_ajout'];  ?></li>
	                    <li><i class="fa fa-list-alt"></i><span>Nom de catégorie:</span><?php echo $row['namecategorie'];  ?></li>
	                    <li>
	                    	<i class="fa fa-user fa-fw"></i><span>Nom de mombre:</span><?php echo $row['namemombre'];  ?></li>
                      </ul>
        			
        		</div>
        	</div>
        </div>
        	<hr class="custom-hr"></hr>
         <?php if (isset($_SESSION['user'])and $active ==1) {?>

<div class="container">
        		<div class="row">
        		<div class="col-md-offset-3">
        			<div class="ajout-commentaire">
 
        				<h3>Ajouter votre commentaire</h3>	
        		<form method="POST" action="<?php $_SERVER['PHP_SELF'].'?id='.$row['idarticle'] ?>">
        			<textarea required="" name="commentaire"></textarea>

        			<input type="submit" class="btn btn-primary " value="Ajouter commentaire"  name="">
        		</form>

<?php
        	        if ($_SERVER['REQUEST_METHOD']=='POST') {
        	        	$commentaire=filter_var($_POST['commentaire'],FILTER_SANITIZE_STRING) ;
        	               $idarticle=$row['idarticle'];
        		            $idmombre=$_SESSION['ran'];
        		            if (!empty($commentaire)) {
        		            	$stat=$con->prepare("INSERT INTO commentaire (commentaire,etatcom,date,id_article,id_mombre) Values (:zcommentaire,0,now(),:zid_article,:zid_mombre)");
		       $stat->execute(array(
            ':zcommentaire'           =>$commentaire,
            ':zid_article'             => $idarticle  ,  
			
			':zid_mombre'             =>$idmombre,

		));
        		            }
        		            	else{
        		            		echo "ecrire un commentaire";

        		            	}

        	        }?></div>
        	    </div>
        	</div>
        </div>
        

        <?php }
        else{

        	echo "pour ajouter un commentaitr il doit etre un mombre et approuver par l'administrateur merci";
        } 

$stat=$con->prepare("SELECT  commentaire.*,mombre.name as namem,article.*
              from commentaire 
                 INNER JOIN article
              ON 
                 article.idarticle=commentaire.id_article
              INNER JOIN mombre
              ON 
                 mombre.id=commentaire.id_mombre WHERE etatcom=1 AND id_article=?");
         $stat->execute(array($row['idarticle']));
         $rowcommentaire=$stat->fetchAll();
         $count=$stat->rowcount();
        
       ?>
<hr class="custom-hr"></hr>
        	<h3>Commentaire sur ce article</h3>
        	
        		<div class="col-md-4">
        			<?php 
                       foreach ($rowcommentaire as $com) {
         	             echo $com['namem']."<br>";
         }
        			?>
        		</div>
        		<div class="col-md-4">
        		
        			<?php 
        			foreach ($rowcommentaire as $com) {
         	echo $com['commentaire']."<br>";
         }?>
        		</div>


  <?php  }
         else{
         	 echo"<h3 class='text-center'>id n'existe pas</h3>" ;
         }

include'includes/template/footer.php';
?>