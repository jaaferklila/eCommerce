<?php
include'admin/connect.php';

function titre(){

global $titre;
if (isset($titre)) {
	echo $titre;
	# code...
}
else{echo "Default";}

}





function getCat(){
global $con;
	$statment=$con->prepare("SELECT *  FROM categories ORDER BY id ASC");
		$statment->execute();
        $cat=$statment->fetchAll();
        return $cat;





}

function getArticle($IDcategorie){
global $con;
	$statment=$con->prepare("SELECT * FROM article where IDcategorie=? and approuver=1 ORDER BY idarticle ASC");
		$statment->execute(array($IDcategorie));
        $article=$statment->fetchAll();
        return $article;

}
//verifier c'est user active par admin ou nom
function userActive($user){
   global $con;
	  $statment=$con->prepare("SELECT name , active FROM mombre where name=?  and active=1");
		$statment->execute(array($user));
        $active=$statment->rowcount();
        return $active;



}
//retouner le nombre de l'existance d"un element
function nombre($value,$table){

	global $con;

	$stat=$con->prepare("SELECT count($value) FROM $table");
	$stat->execute();
	return $stat->fetchcolumn();
}
function verif($select,$from,$value){
global $con;
	$statment=$con->prepare("SELECT $select FROM $from where $select=?");
		$statment->execute(array($value));
        $count=$statment->rowcount();
        return $count;





}
  ?>
  