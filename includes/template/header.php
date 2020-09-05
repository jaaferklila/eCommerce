

<!DOCTYPE html>
<html>
<head>
	<title><?php titre(); ?></title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="layout/css/all.min.css">
   <link rel="stylesheet" href="layout/css/style.css">
</head>
<body>
	<div class="barre">
		<div class="container">
<?php 
ini_set('display_errors', 'on');
error_reporting(E_ALL);
if (isset($_SESSION['user'])) {
	$stat=$con->prepare("SELECT image FROM mombre where  name=?");
$stat->execute(array($_SESSION['user']));
$row=$stat->fetch();

	echo "<img src='imagesMombres/".$row['image']."' class='img-thumbnail img-circle'/>";
	
	?>
	
	<div class="btn-group my-info">
		<span class="btn dropdown-toggle" data-toggle="dropdown"><?php echo   $_SESSION['user']?>
		<span class="caret"></span>
		</span>
		<ul class="dropdown-menu">
			<li><a href="profil.php">Mon profil</a></li>
			<li><a href="newarticle.php">Nouveau article</a></li>
			<li><a href="deconnection.php">Déconnection</a></li>
		</ul>
	</div>
	
	
<?php	
     $active= userActive($_SESSION['user']);
     if (  $active==0) {
     	echo "  vous ete nom active   ";
     	# code...
     }



} else{?>
	<a href="login.php"> <sapn class="option pull-right">login/sigup</span></a>

<?php }?>
</div>

</div>
	

<nav class="navbar navbar-inverse">
	<div class="container">
 	<div class="navbar-header"> 
 	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> 
 	
 		 <span class="icon-bar"></span>
 		  <span class="icon-bar"></span> 
 		  <span class="icon-bar"></span>
 		   </button> <a class="navbar-brand" href="index.php">Homepage</a>
 		    </div>
 		    <!-- Collect the nav links, forms, and other content for toggling --> 
 		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

 		     <ul class="nav navbar-nav navbar-right">

 		             
 		               	<?php
                              $categories=getCat();
                       foreach ($categories as $cat ) {
	                           echo '<li>
	                                   <a href="categories.php?id='.$cat['id'].'&name='.str_replace(' ','-',$cat['name']).'">'.$cat['name'].' </a>

	                           </li>';
	                           
	                          
	                          
                                 }

                                 ?>
 		               	   

 		               
 		  
 		          
                 </ul> 
 
 	 
 </div><!-- /.navbar-collapse --> 
</div><!-- /.container-fluid -->

 </nav>
