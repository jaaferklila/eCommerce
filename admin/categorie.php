<?php
/*==============================================
  ==============================================

 ================Categorie Page=================

 ================================================
 ================================================
*/
ob_start();
session_start();
$titre="categorie";
//start session
if(isset($_SESSION['nom'])){
	include'connect.php';
  include'includes/function/function.php';
	include'includes/template/header.php';
  include'includes/template/navbar.php';
    
$do=isset($_GET['do'])?$_GET['do']:'categorie';
/*=============================================================================
===============================================================================
                   Debut Page categorie
   ===========================================================================                
==============================================================================*/
	     if ($do=="categorie") {
       $ordre="ASC";
       $sort_array=array('ASC' , 'DESC');
       if (isset($_GET['ordre'])&& in_array($_GET['ordre'], $sort_array)) {

         $ordre=$_GET['ordre'];
       }
       $stat=$con->prepare("SELECT * FROM categories ORDER BY ordre $ordre");
       $stat->execute();
       $categorie=$stat->fetchAll(); ?>

          <h1 class="text-center">Gérer Catégories</h1>
          <div class="container categorie">
            <div class="container"><a href="Categorie.php?do=ajouter" class="btn btn-success"><i class="fa fa-plus"></i>Ajouter catégorie</a>

                <div class="panel panel-default">
                  <div class="panel-heading">Gérer Catégories
                            <div class="option pull-right"><i class="fa fa-sort"></i>Ordre:[
                                      <a class="<?php if($ordre=='ASC'){echo 'active';} ?>" href="?ordre=ASC">ASC |</a>
                                      <a class="<?php if( $ordre=='DESC'){echo 'active';} ?>" href="?ordre=DESC">DESC</a>]
                                       View:[
                                       <span class="active" data-view="full">Full</span> |
                                       <span class="classic" data-view="classic">Classic</span>]
                             </div>
                            

                  </div>
                  
                  <div class="panel-body">
                   <?php
                   foreach ($categorie as $value) {
                    echo "<div class='cat'>";
                    echo "<div class='hidden-bouttons'>";
                    echo "<a href='categorie.php?do=modifier&id=".$value['id']."'class='btn  btn-success'><i class='fa fa-edit'></i>Modifier</a>";
                    echo "<a href='categorie.php?do=supprimer&id=".$value['id']."' class='btn  btn-danger confirm'><i class='fa fa-times'></i>supprimer</a>";

                        echo "</div>";
                         echo '<h3>'.$value['name'].'</h3>';
                  echo "<div class='full-view'>";
                  echo "<div class='hidden-class'>";
                         echo "<p class='description'>description :"; if($value['description']==""){echo "pas de cdescription";}else{echo $value['description']; }echo'</p>';
                      
                           echo "<spab> la visibilite est ".$value['visibilite'].'</span>';
                           echo "<span>commentaire ".$value['commentaire'].'</span>';
                           echo "<span>publicité ".$value['publicite'].'</span>';
                           echo "</div>";
                  echo "</div>";

                         echo "</div>";
                        echo "<hr>";
                   }

                   
                   ?>


                  </div>

                </div><!-- Fin div class panel      -->

          </div><!-- Fin div class container      -->


     <?php 
      }
/*=============================================================================
===============================================================================
                   Fin Page categorie
   ===========================================================================                
==============================================================================*/
/*=============================================================================
===============================================================================
                   Debut Page ajouter categorie
   ===========================================================================                
==============================================================================*/
       elseif($do=="ajouter"){  ?>
        <h1 class="text-center">Ajouter Catégorie</h1>
        <div class="container">
         
      <form class="form-horizontal " method="POST" action="categorie.php?do=insert">
        <!-- Start name of categorie -->
          <div class="form-group form-group-lg">
                 <label class="col-sm-4 control-label"> Nom </label>

                 <div class="col-sm-10 col-md-4 ">

               <input type="text" name="name" required="" placeholder="nom de catégorie" value=""class="form-control" autocomplete="off">
          </div>
        </div>
        <!-- End name of categorie -->
        <!-- Start descripition of categorie -->
        <div class="form-group form-group-lg">
        <label class="col-sm-4 control-label">Description </label>
        <div class="col-sm-10 col-md-4">
          <input type="text" name="description"  value="" class="form-control" placeholder="description de catégorie" autocomplete="on">
          
        </div>
      </div>
      <!-- Fin descripition de categorie -->
       <!-- debut ordre de categorie -->
      <div class="form-group form-group-lg">
        <label class="col-sm-4 control-label">ordre</label>
        <div class="col-sm-10 col-md-4">
          <input type="text" name="ordre"  value="" class="form-control" placeholder="ordre de catégorie" autocomplete="on"/>
          
        </div>
      </div>

        <!-- Fin ordre de categorie --> 
        <!-- Debut visible de categorie -->
     <div class="form-group form-group-lg">
      <label class="col-sm-4 control-label">Visibilité</label>
      <div>
        <input id="vis-yes" type="radio" name="visible" value="1" checked=""/>
        <label for="vis-yes">Oui</label>
      </div>
       <div>
        <input id="vis-no" type="radio" name="visible" value="0">
        <label for="vis-no">Non</label>
      </div>
     </div>
        <!-- Fin visible --> 
        <!-- Debut commantaire commentaire -->
         <div class="form-group form-group-lg">
      <label class="col-sm-4 control-label">Commentaire</label>
      <div>
        <input id="com-yes" type="radio" name="commentaire" value="1" checked=""/>
        <label for="com-yes">Oui</label>
      </div>
       <div>
        <input id="com-no" type="radio" name="commentaire" value="0">
        <label for="com-no">Non</label>
      </div>
     </div>
        <!-- Fin commentaire --> 
        <!-- Debut publicite -->
         <div class="form-group form-group-lg">
      <label class="col-sm-4 control-label">Publié</label>
      <div>
        <input id="pub-yes" type="radio" name="publicite" value="1" checked=""/>
        <label for="pub-yes">Oui</label>
      </div>
       <div>
        <input id="pub-no" type="radio" name="publicite" value="0">
        <label for="pub-no">Non</label>
      </div>
     </div>
        <!-- Fin publicite --> 
         
          <!-- Start button --> 
      <div class="form-group form-group-lg">
                  <div class="col-sm-offset-4 col-sm-6">
          <input type="submit" value="Ajouter Catégorie" class="btn btn-primary btn-lg"/>
          
        </div>
      </div>
        <!-- end button --> 
      </form>
     </div>

     <?php  }
                       /*==============================================================
                         =============================================================
                                     Fin ajout categorie
                            ==========================================================                
                      =========================================================================*/

                  /*============================================
                  ==============================================
                             Debut d'insertion de categorie
                             (coonection a la base de donne
                                      et insertion) 
                  =============================================
                  =============================================*/
     elseif ($do=="insert") {
      echo "<div class='container text-center'>";
             if ($_SERVER['REQUEST_METHOD']=='POST') {
             $nom= $_POST['name'];
             $description= $_POST['description'];
             $ordre=$_POST['ordre'];
             $visible=$_POST['visible'];
             $commentaire=$_POST['commentaire'];
             $publie=$_POST['publicite'];
             /* Debut de verification de l'existance de categorie a la base de donne*/
             $nombre=verif("name","categories",$nom);
             /* Fin de verification de l'existance de categorie a la base de donne*/
             if ($nombre==1) {
              echo "<div class='alert alert-danger'>Cette catégorie est deja existe</div>";
              
               
             }
             else{
              $stat=$con->prepare("INSERT INTO categories
              (name,description,ordre,visibilite,commentaire,publicite)
               VALUES
              (:zname,:zdescription,:zordre,:zvisibilite,:zcommentaire,:zpublicite)");
             $stat->execute(array(
                                    ':zname'=>$nom,
                                    ':zdescription'=> $description,
                                    ':zordre'=>$ordre,
                                    ':zvisibilite'=>$visible,
                                    ':zcommentaire'=> $commentaire,
                                    ':zpublicite'=>$publie


             ));

                

             echo "<div class='alert alert-success text-center'>insertion effectuer avec succes</div>";
             header('Refresh:2;categorie.php?do=ajouter');
             }

             
               
             }
             else{
             echo "<div class='alert alert-danger text-center'> impossible de visité cette page directement</div>";
             header('Refresh:2;categorie.php');
             }
             

       
     }

/*============================================
==============================================
           Fin d'insertion de categorie
           (coonection a la base de donne

                    et insertion) 

=============================================
=============================================*/
/*============================================
==============================================
           debut de modification de categorie
=============================================
=============================================*/
elseif ($do=="modifier") {


  $idcategorie=isset($_GET['id'])?intval($_GET['id']):0;
  $stat=$con->prepare("SELECT * FROM categories where id=?");
                  $stat->execute(array($idcategorie));
                  $row=$stat->fetch();
                  $count=$stat->rowcount();

                     if ($count>0) { ?>

                <h1 class="text-center">Modifier Mombre</h1>
                <div class="container">
         
      <form class="form-horizontal " method="POST" action="categorie.php?do=update">
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
        <!-- Start name of categorie -->
          <div class="form-group form-group-lg">
                 <label class="col-sm-4 control-label"> Nom </label>

                 <div class="col-sm-10 col-md-4 ">

               <input type="text" name="name" required="" placeholder="nom de catégorie" value="<?php echo $row['name'] ?>"class="form-control" autocomplete="off">
          </div>
        </div>
        <!-- End name of categorie -->
        <!-- Start descripition of categorie -->
        <div class="form-group form-group-lg">
        <label class="col-sm-4 control-label">Description </label>
        <div class="col-sm-10 col-md-4">
          <input type="text" name="description"  value="<?php echo $row['description'] ?>" class="form-control" placeholder="description de catégorie" autocomplete="on">
          
        </div>
      </div>
      <!-- Fin descripition de categorie -->
       <!-- debut ordre de categorie -->
      <div class="form-group form-group-lg">
        <label class="col-sm-4 control-label">ordre</label>
        <div class="col-sm-10 col-md-4">
          <input type="text" name="ordre"  value="<?php echo $row['ordre'] ?>" class="form-control" placeholder="ordre de catégorie" autocomplete="on"/>
          
        </div>
      </div>

        <!-- Fin ordre de categorie --> 
        <!-- Debut visible de categorie -->
     <div class="form-group form-group-lg">
      <label class="col-sm-4 control-label">Visibilité</label>
      <div>
        <input id="vis-yes" type="radio" name="visible" value="1"<?php if ($row['visibilite']==1) {echo "checked";} ?> />
        <label for="vis-yes">Oui</label>
      </div>
       <div>
        <input id="vis-no" type="radio" name="visible" value="0"<?php if ($row['visibilite']==0) {echo "checked";} ?> >
        <label for="vis-no">Non</label>
      </div>
     </div>
        <!-- Fin visible --> 
        <!-- Debut commantaire commentaire -->
         <div class="form-group form-group-lg">
      <label class="col-sm-4 control-label">Commentaire</label>
      <div>
        <input id="com-yes" type="radio" name="commentaire" value="1"<?php if ($row['commentaire']==1) {echo "checked";} ?>  />
        <label for="com-yes">Oui</label>
      </div>
       <div>
        <input id="com-no" type="radio" name="commentaire" value="0"<?php if ($row['commentaire']==0) {echo "checked";} ?>>
        <label for="com-no">Non</label>
      </div>
     </div>
        <!-- Fin commentaire --> 
        <!-- Debut publicite -->
         <div class="form-group form-group-lg">
      <label class="col-sm-4 control-label">Publié</label>
      <div>
        <input id="pub-yes" type="radio" name="publicite" value="1"<?php if ($row['publicite']==1) {echo "checked";} ?> />
        <label for="pub-yes">Oui</label>
      </div>
       <div>
        <input id="pub-no" type="radio" name="publicite" value="0"<?php if ($row['publicite']==0) {echo "checked";} ?>>
        <label for="pub-no">Non</label>
      </div>
     </div>
        <!-- Fin publicite --> 
         
          <!-- Start button --> 
               <div class="form-group form-group-lg">
                  <div class="col-sm-offset-4 col-sm-6">
                 <input type="submit" value="Modifier Catégorie" class="btn btn-primary btn-lg"/>
          
        </div>
      </div>
        <!-- end button --> 
      </form>
     </div>

  
<?php 
}else{
  echo "<div class='alert alert-danger text-center'> id n'existe pas</div>";
  header('Refresh:2;mombre.php');
}

}

/*=============================================
=============================================*/
/*============================================
==============================================
           Fin de modification de categorie
=============================================
=============================================*/

/*=============================================
=============================================*/
/*============================================
==============================================
           Debut de modification de categorie
           insertion de modification
=============================================
=============================================*/
/*=============================================
=============================================*/
elseif ($do=="update") {

  if ($_SERVER['REQUEST_METHOD']=="POST") {
             $id=$_POST['id'];
             $nom= $_POST['name'];
             $description= $_POST['description'];
             $ordre=$_POST['ordre'];
             $visible=$_POST['visible'];
             $commentaire=$_POST['commentaire'];
             $publie=$_POST['publicite'];

             $stat=$con->prepare("UPDATE categories SET name=?,description=?,ordre=?,visibilite=?,commentaire=?,publicite=? where id=?");
             $stat->execute(array($nom,$description,$ordre,$visible,$commentaire, $publie,$id));

                 
             echo "<div class='alert alert-success text-center'>mise a jour effectuer avec succes</div>";
             header('Refresh:2;categorie.php');
  
  }
  else{
    echo "<div class='alert alert-danger text-center'>Impossible de vister cette page directement</div>";
  }
  # code...
}






/*============================================
==============================================
           Fin de modification de categorie
           insertion de modification
=============================================
=============================================*/
/*============================================
==============================================
           debut supprition de categorie
           
=============================================
=============================================*/
elseif ($do=="supprimer") {
 $categorieid=isset($_GET['id'])?$_GET['id']:0;
 $verif=
$stat=$con->prepare("DELETE from categories where id=?");
$stat->execute(array($categorieid));
     
             echo "<div class='alert alert-success text-center'>supprition effectuer avec succes</div>";
             header('Refresh:2;categorie.php');
}


/*============================================
==============================================
         Fin supprition de categorie
           
=============================================
=============================================*/

include('includes/template/footer.php');
}
//end session
else{

	header('location:index.php');
}


ob_end_flush();
