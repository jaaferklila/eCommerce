<?php
/*==============================================
  ==============================================

 ================Mombre Page=================

 ================================================
 ================================================
*/
ob_start();
session_start();
$titre="Mombre";
if(isset($_SESSION['nom'])) {
  include'connect.php';
   include'includes/function/function.php';
  include"includes/template/header.php";
  include'includes/template/navbar.php';


$do=isset($_GET['do'])?$_GET['do']:'liste';

if ($do=="ajouter") {
	
?>
<h1 class="text-center">Ajouter Mombre</h1>
     <div class="container">
     		<!-- Start name --> 
     	<form class="form-horizontal " method="POST" action="mombre.php?do=insert"enctype="multipart/form-data">
          <div class="form-group form-group-lg">
     		         <label class="col-sm-4 control-label"> Nom </label>

     		         <div class="col-sm-10 col-md-4 ">

     			     <input type="text" name="name" required="" value=""class="form-control" autocomplete="off"/>
     			</div>
     		</div>
        <div class="form-group form-group-lg">
        <label class="col-sm-4 control-label">Prénom</label>
        <div class="col-sm-10 col-md-4">
          <input type="text" name="prenom" required="" value="" class="form-control" autocomplete="off"/>
          
        </div>
      </div>
        <!-- Start email --> 
      <div class="form-group form-group-lg">
        <label class="col-sm-4 control-label">Email</label>
        <div class="col-sm-10 col-md-4">
          <input type="email" name="email" required="" value="" class="form-control" autocomplete="off"/>
          
        </div>
      </div>

        <!-- end email --> 
      <div class="form-group form-group-lg">
        <label class="col-sm-4 control-label">Télephone</label>
        <div class="col-sm-10 col-md-4">
          <input type="number" name="telephone" required="" value="" class="form-control" autocomplete="off"/>
          
        </div>
      </div>
     		<!-- end name --> 
     		 
     			<!-- start password --> 
     	<div class="form-group form-group-lg">
     		<label class="col-sm-4 control-label">Mot de passe</label>
     		<div class="col-sm-10 col-md-4">
     			<input type="password" value="" required="" name="password" class="form-control password"/>
     			<i class=" show-password fa fa-eye fa-2x"></i>
     		</div>
     	</div>
     		<!-- end password --> 
        <div class="form-group form-group-lg">
        <label class="col-sm-4 control-label">Image</label>
        <div class="col-sm-10 col-md-4">
          <input type="file" name="photo" required="" value="" class="form-control" autocomplete="off"/>
          
        </div>
      </div>
     			<!-- Start button --> 
     <div class="form-group form-group-lg">
                  <div class="col-sm-offset-4 col-sm-6">
     			<input type="submit" value="Ajouter" class="btn btn-success btn-lg"/>
     			
     		</div>
     	</div>
     		<!-- end button --> 
     	</form>
     </div>

<?php }
elseif ($do=="insert") {
	if ($_SERVER['REQUEST_METHOD']=="POST") {
        		$nom=$_POST['name'];
        		$email=$_POST['email'];
            $prenom=$_POST['prenom'];
            $telephone=$_POST['telephone'];
        		$password=sha1($_POST['password']);
            $photoUser=$_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], "..\imagesMombres\\".$photoUser);
            /* Debut de verification de l'existance de nom a la base de donne*/
            $value=verif("name","mombre",$nom);

                     if($value==0){
                                     $stat=$con->prepare("INSERT INTO mombre
                                      (name,prenom,telephone,email,password,image,active,date,isadmin) 
                                      VALUES
                                      (:zname,:zprenom,:ztelephone,:zemail,:zpasswrd,:zimage,1,now(),0)");
                                      $stat->execute(array(
                                      'zname'=>$nom,
                                      'zprenom'=>$prenom,
                                      'ztelephone'=>$telephone,
                                      ':zemail'=>$email,
                                      ':zpasswrd'=>$password,
                                      ':zimage'=>$photoUser

                                       ));
          echo $stat->rowcount();
          header('Refresh:2;URL=mombre.php?do=liste');

           }
           else{echo "name existe";
                     header('Refresh:2;URL=mombre.php?do=liste');}
     
		}
	else{
		echo"page not found direct";
	}
}
elseif ($do=="modifier") {
	                $userid=isset($_GET['id'])?$_GET['id']:0;

                	$stat=$con->prepare("SELECT * FROM mombre where id=?");
                	$stat->execute(array($userid));
                	$row=$stat->fetch();
                  $count=$stat->rowcount();

                     if ($count>0) { ?>
               	<h1 class="text-center">Modifier Mombre</h1>
      <div class="container">
     		<!-- Start name --> 
     	<form class="form-horizontal" method="POST" action="mombre.php?do=update"enctype="multipart/form-data">
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
       <div class="form-group form-group-lg">
        <label class="col-sm-4 control-label">Image</label>
        <div class="col-sm-10 col-md-4">
          <input type="file" name="photo" required="" value="<?php echo $row['image']; ?>" class="form-control" autocomplete="off"/>
          
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
     </div>
     	
    <?php  }

     else{
     	echo "id n'existe pas";
     }

	?>

	
<?php }
elseif ($do=="update") {

	if ($_SERVER['REQUEST_METHOD']=="POST") {
       $userid=$_POST['userid'];
  		$name=$_POST["name"];
  		$email=$_POST["email"];
      $prenom=$_POST['prenom'];
      $telephone=$_POST['telephone'];
          $photoUser=$_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], "..\imagesMombres\\".$photoUser);
		$password=empty($_POST['newpassword'])?$_POST['oldpassword']:sha1($_POST['newpassword']);

		$stat=$con->prepare("UPDATE mombre SET name=?,prenom=?,telephone=?,email=?,password=?,image=? where id=?");
		$stat->execute(array($name,$prenom, $telephone,$email,$password,$photoUser,$userid));

         
       header("refresh:0.000000000000000000000000000000000000000000000001;url=mombre.php?do=liste");
		
	}
	else{

		echo "impossibe de viste ce lien directement";
	}
	
}
elseif ($do=="supprimer") {
     $userid=isset($_GET['id'])?$_GET['id']:0;
          $stat=$con->prepare("delete  FROM mombre where id=?");
         $stat->execute(array($userid));
        
        echo "la supprssion est effectuer";
        header("Refresh:0; URL=mombre.php?do=liste");

     
}
// start code liste de nombre
elseif ($do=="liste") {



  
     
    

$stat=$con->prepare("SELECT * FROM mombre where isadmin=0");
$stat->execute();
$rows=$stat->fetchAll();
$stat->rowcount();
?>
<h1 class="text-center">Gérer Membre</h1>
<div class="container"><a href="mombre.php?do=ajouter" class="btn btn-success"><i class="fa fa-user-plus"></i>Ajouter Membre</a>
     <div class="table-responsive">
          <table class="main-table text-center table table-bordered" >
               <tr>
                       <td>ID</td>
                    <td>Name</td>
                    <td>Prénom</td>
                    <td>Email</td>
                     <td>Date</td>
                 
                     
                    <td>Membre Actif</td>
                    <td>Gére mombre</td>
               </tr>
               <?php foreach ($rows as $row ) {?>
<tr>
                       <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['prenom']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                     <td><?php echo $row['date']; ?></td>
                 
                    <td>
                          <a href="mombre.php?do=modifier&id=<?php echo $row['id'] ?>" class="btn btn-primary"><i class="fa fa-user-edit"></i> Modifier</a>
                         <a href="mombre.php?do=supprimer&id=<?php echo $row['id'] ?>" class="btn btn-danger confirm"><i class="fa fa-user-times"></i>supprimer</a>

                      
                       </td>
                       <td>
                       <?php

                                 if ($row['active']==0) {   ?>
                                   

                                        <a href="mombre.php?do=activer&id=<?php echo $row['id'] ?>" class="btn btn-info "><i class="fa fa-user-check"></i>Activer</a>

                             <?php    }
                              else {   ?>
                                 <a href="mombre.php?do=desactiver&id=<?php echo $row['id'] ?>" class="btn btn-info "><i class="fa fa-user-check"></i>Désactiver</a>

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
// END code liste de nombre
// start code liste de nombre non active
elseif ($do=="listenonactive") {
     
    

                  $stat=$con->prepare("SELECT * FROM mombre where (active=0 && isadmin=0) ");
                  $stat->execute();
                  $rows=$stat->fetchAll();
                  $stat->rowcount();

     ?>
     <h1 class="text-center">Membre Non Active</h1>
<div class="container">
     <div class="table-responsive">
          <table class="main-table text-center table table-bordered" >
               <tr>
                       <td>id</td>
                    <td>name</td>
                    <td>email</td>
                 
                     
                    <td>fonction</td>
               </tr>
               <?php foreach ($rows as $row ) {?>
<tr>
                       <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                 
                    <td>
                          <a href="mombre.php?do=modifier&id=<?php echo $row['id'] ?>" class="btn btn-primary"><i class="fa fa-user-edit"></i>Modifier</a>
                         <a href="mombre.php?do=supprimer&id=<?php echo $row['id'] ?>" class="btn btn-danger confirm"><i class="fa fa-user-times"></i>supprimer</a>

                            <?php

                                 if ($row['active']==0) {   ?>
                                   

                                        <a href="mombre.php?do=activer&id=<?php echo $row['id'] ?>" class="btn btn-info "><i class="fa fa-user-check"></i>Active</a>

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
// END code liste de nombre non actif
// start code liste de nombre 
elseif ($do=="activer") {
$id=$_GET['id'];
  $stat=$con->prepare("UPDATE mombre SET active=1 where id=$id");
    $stat->execute();

header("Refresh:0.000000000000000000000000000000000000000000000001;url=mombre.php?do=liste");


}

elseif ($do=="desactiver") {
$id=$_GET['id'];
  $stat=$con->prepare("UPDATE mombre SET active=0 where id=$id");
    $stat->execute();

header("Refresh:0.0000000000000000000000000000000000000000000000000000001;url=mombre.php?do=liste");


}



	?>


	<?php
	include('includes/template/footer.php');
}



else{

	header('location:index.php');
}
ob_end_flush();
