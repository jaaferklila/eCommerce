<?php

session_start();
$titre="profil";
include'includes/function/function.php';
include'includes/template/header.php';
if (isset($_SESSION['user'])) {

$stat=$con->prepare("SELECT * FROM mombre where  name=?");
$stat->execute(array($_SESSION['user']));
$row=$stat->fetch();
	
	?>

<h2 class="text-center">Mon profil</h2>
	<div class="information">
		<div class="container">
			<div class="panel panel-primary">
				<div class="panel-heading">Mes information</div>
				<div class="panel-body">

					<ul class="list-unstyled">
						<li>
							<i class="fa fa-unlock-alt fa-fw"></i>
							<span>nom:</span><?php echo $row['name']."<br>"  ?>	
						</li>
						<li>
							<i class="fa fa-user fa-fw"></i>
							<span>prénom:</span><?php echo $row['prenom']."<br>"  ?>
						</li>
						<li>
							<i class="fa fa-envelope fa-fw"></i>
							<span>email:</span><?php echo $row['email']."<br>"  ?>
						</li>
						<li>
							<i class="fa fa-phone fa-fw"></i>
							<span>telephone:</span><?php echo $row['telephone']."<br>"  ?>
						</li>
						<li>
							<i class="fa fa-calendar fa-fw"></i>
							<span>date:</span><?php echo $row['date']."<br>"  ?>
						</li>
						

					</ul>
    <div class="btn btn-info pull-right profil"><a href="editprofil.php"><i class='fa fa-edit'></i> Modifier profil</a></div>
					
				</div>
			</div>

		</div>
	</div>
	<div class="article">
		<div class="container">
			<div class="panel panel-primary">
				<div class="panel-heading">Mes articles</div>
				<div class="panel-body">
					<?php

				$stat=$con->prepare("SELECT * FROM article where  IDmombre=?");
					$stat->execute(array($row['id']));
					$article=$stat->fetchAll();
					$count=$stat->rowcount();
					if (!empty($article)) {
						foreach ($article as $ar) {?>
							
                       
					<?php	echo "<div class='col-sm-6 col-md-4 '>";
						echo "<div class=' thumbnail item-box'>";?>
						
                              <form method="POST" action="editarticle.php">
								<input type="hidden" name="ar" value="<?php echo $ar['idarticle'] ?>">
								
								
									
                               <button type="submit" class='btn btn-info pull-right' name="id" value="Modifier">
                                        <i class="fa fa-edit"></i>Modifier</button>
                             
							</form>

							<form method="POST" action="supprimerarticle.php">
								<input type="hidden" name="ar" value="<?php echo $ar['idarticle'] ?>">
						
                              <button type="submit" class='btn btn-danger pull-right confirm' name="id" value="Modifier">
                                        <i class="fa fa-times"></i>Supprimer</button>
							</form>
							
                          
					<?php 	echo "<span class='price'>".$ar['prix']."$</span>";
					    echo "<img class='image-resonsive'  src='images/".$ar['image']."'/>";
					    echo "<div class='cation'>";
					   echo "<h3>" .$ar['name']." </h3>";
					     echo "<p>  " .$ar['description']."  </p>";
					     echo "<div class='date'>".$ar['date_ajout']."</div>";
					    echo "</div>";
					    echo "</div>";
					echo "</div>";
					}
					}
					else{
						echo "aucun article";
					}

					?>
				</div>
			</div>
			
		</div>
	</div>
	<div class="commentaire">
		<div class="container">
			<div class="panel panel-primary">
				<div class="panel-heading">Mes commentaires</div>
				<div class="panel-body">
					<?php

				$stat=$con->prepare("SELECT * FROM commentaire where  id_mombre=?");
					$stat->execute(array($row['id']));
					$commentaire=$stat->fetchAll();
					$count=$stat->rowcount();
					if (!empty($commentaire)) {
						foreach ($commentaire as $com) {
						echo $com['commentaire']."<br>";
						
					}
					}
					else{
						echo "aucun commentaire";
					}
					

					?>
					
				</div>
			</div>
			
		</div>
	</div>
	

<?php }
else{
	header('location:login.php');
}

include'includes/template/footer.php';
?>

