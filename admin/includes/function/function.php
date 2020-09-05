<?php
include'connect.php';

function titre(){

global $titre;
if (isset($titre)) {
	echo $titre;
	# code...
}
else{echo "Default";}

}





function verif($select,$from,$value){
global $con;
	$statment=$con->prepare("SELECT $select FROM $from where $select=?");
		$statment->execute(array($value));
        $count=$statment->rowcount();
        return $count;





}
/*
cherche le nombre de fois l'element existe dans la table 
*/
function nombre($value,$table){

	global $con;

	$stat=$con->prepare("SELECT count($value) FROM $table");
	$stat->execute();
	return $stat->fetchcolumn();
}
/*
cette fonction retourne le nombre des utilisateur non active 

*/
function nombrenonactive($value,$table){

	global $con;

	$stat=$con->prepare("SELECT count($value) FROM $table where $value=0");
	$stat->execute();
	return $stat->fetchcolumn();
}

/*fonction pour dernier element dans les tables de base de donne
contient 4 parametre $element(nom element de table),$table(nom de table),$id (l'ordre selon cette id)
$nbelemnt(nombre de colone selectione)


*/
function last($element,$table,$id,$nbelement=5){

global $con;
$stat=$con->prepare(" SELECT $element FROM $table ORDER BY $id DESC LIMIT $nbelement");
$stat->execute();
$row=$stat->fetchAll();
return $row;

}

  ?>
  