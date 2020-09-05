<?php 
session_start();
$titre="Catégorie";
include'includes/function/function.php';
include'includes/template/header.php';

?>
<div class="container">
	<h1 class="text-center"><?php 

if(isset($_GET['name'])){
	echo str_replace('-',' ',$_GET['name']); }?>
	</h1>
	
	<div class="row">
		
				<?php 
				if(isset($_GET['id'])){
				foreach (getArticle($_GET['id']) as $article ) {
					echo "<div class='col-sm-6 col-md-4 '>";
						
						echo "<div class=' thumbnail item-box'>";
						
						  echo "<span class='price'>".$article['prix']."$</span>";
					    echo "<img class='image-resonsive' src='images/".$article['image']."'/>";
					 
					   echo '<h3><a href="article.php?id='.$article['idarticle'].'">' .$article['name'].' </a></h3>';
					     echo "<p>  " .$article['description']."  </p>";
					     echo "<div class='date'>".$article['date_ajout']."</div>";
					    echo "</div>";
					    echo "</div>";
					    
				}
}
				?>

	</div>
</div>












<?php

include'includes/template/footer.php';
?>