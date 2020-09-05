<?php
/*==============================================
  ==============================================

 ================Dashbord Page=================

 ================================================
 ================================================
*/
session_start();
$titre="Dashbord";
if(isset($_SESSION['nom'])){
	include'connect.php';
       include'includes/function/function.php';
	include"includes/template/header.php";
	include'includes/template/navbar.php';
	?>



<div class="container home-stat text-center">
	<h1 class="text-center">Dashbord</h1>
	<div class="row">

		<a href="mombre.php?do=liste">
		<div class="col-md-4">

			<div class="statestique totmembre ">
				Total membre

           <span class="demention"><?php echo nombre("id","mombre"); ?></span>
			</div>

		</div></a>

		<a href="mombre.php?do=listenonactive">
		<div class="col-md-4">
			<div class="statestique active">Membre non active
			<span><?php echo nombrenonactive("active","mombre"); ?></span></div>
		</div></a>
		<a href="article.php">
		<div class="col-md-4">
			<div class="statestique totarticle ">
				Total Article

           <span><?php echo nombre("idarticle","article"); ?></span>
			</div>
		</div></a>
</div>

</div>

<div class="container lasted">
           <div class="row">
           	<div class="col-sm-6">
           		<div class="panel panel-default">
                  <div class="panel-heading">
                  	<i class="fa fa-users"></i>  Dérnier users
                  	
                  	<span class="toggle-info pull-right">
                  		<i class="fa fa-plus"></i>
                  		
                  	</span>
           	
            </div>
            <div class="panel-body">
            	<ul class="list-unstyled latest-users">
                  	<?php 
                     $users=last('*','mombre','id','5');
                     foreach ($users as $rows) {
                     	echo"<li>" .$rows['name']."<a href='mombre.php?do=modifier&id=".$rows ['id']."'<span class='btn btn-success pull-right'><i class='fa fa-edit'></i>Modifier</span></a></li>";
                     }


                  	?>
                  </ul>
                 </div>

           </div>
           </div>
	<div class="col-sm-6">
           		<div class="panel panel-default">
                  <div class="panel-heading"><i class="fa fa-tag"></i>  Dérnier article
                  	<span class="toggle-info pull-right">
                  		<i class="fa fa-plus"></i>
                  		
                  	</span>
           	
            </div>
            <div class="panel-body">
                  <ul class="list-unstyled latest-users">
                  	<?php 
                     $users=last('*','article','idarticle','5');
                     foreach ($users as $rows) {
                     	echo"<li>" .$rows['name']."<a href='article.php?do=modifier&id=".$rows ['idarticle']."'<span class='btn btn-success pull-right'><i class='fa fa-edit'></i>Modifier</span></a></li>";
                     }



                  	?>
                  	</ul>
                 </div>

           </div>
           </div>

           </div> 
       </div>

                  
                  



	<?php


	include"includes/template/footer.php";

}


else{

	header('location:index.php');
	exit();
}
?>