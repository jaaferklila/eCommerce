 
<?php

session_start();
$titre="edit profil";
include'includes/function/function.php';
include'includes/template/header.php';
if (isset($_SESSION['user'])) {

if (isset($_POST['id'])) {
    $ida= $_POST['ar'];
     $stat=$con->prepare("SELECT * FROM article WHERE idarticle=?");
         $stat->execute(array($ida));
         $row=$stat->fetch(); ?>
<h1 class="text-center"> Modifier Article</h1>
    <div class="container">
            <form class="form-horizontal" action="modifierarticle.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $ida;?>">
                        <div class="form-group form-group-lg">
                                <label class="col-sm-10 col-md-4 control-label">Nom</label>
                                <div class="col-sm-10 col-md-4">
                                <input type="text" required="" value="<?php echo $row['name'] ;?>" name="name" class="form-control"/>
                                </div>
                        </div>

                        <div class="form-group form-group-lg">
                                <label class="col-sm-10 col-md-4 control-label">Description</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="text" required=""name="description" value="<?php echo $row['description'] ;?>" class="form-control"/>
                                </div>
                        </div>
                        <div class="form-group form-group-lg">
                                <label class="com-sm-0 col-md-4  control-label">Prix</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="text" required="" name="prix" value="<?php echo $row['prix'] ;?>" class="form-control">
                                    
                                </div>
                            
                        </div>
                        <div class="form-group form-group-lg">
                            <label class="col-sm-10 col-md-4 control-label" >Pays</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" required="" name="pays" class="form-control" value="<?php echo $row['pays'] ;?>">
                                
                            </div>
                            
                        </div>
                        <div class="form-group form-group-lg">
                            <label class="col-sm-10 col-md-4 control-label" >Etat</label>
                            <div class="col-sm-10 col-md-4">
                                <select name="etat" required="" class="form-control">
                                    <option  value="0">...</option>
                                    <option value="1" <?php if($row['etat']==1) echo "selected";  ?>>Nouveau</option>
                                    <option value="2"<?php if($row['etat']==2) echo "selected";  ?>>Comme nouveau</option>
                                    <option value="3"<?php if($row['etat']==3) echo "selected";  ?>>Utilisé</option>
                                    
                                </select>
                                
                            </div>
                            
                        </div>
                        
                              <div class="form-group form-group-lg">
                            <label class="col-sm-10 col-md-4 control-label" >Catégorie</label>
                            <div class="col-sm-10 col-md-4">
                                <select name="categorie" required="" class="form-control">
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
     
   
<?php }

 else{
    header('location:profil.php');
}
 }
else{
    header('location:profil.php');
}

include'includes/template/footer.php';
?>
