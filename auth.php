<?php
/*
Planning Biblio, Plugin LDAP Version 1.0.5
Licence GNU/GPL (version 2 et au dela)
Voir les fichiers README.md et LICENSE
Copyright (C) 2013 - Jérôme Combes

Fichier : plugins/ldap/auth.php
Création : 27 juin 2013
Dernière modification : 26 mars 2014
Auteur : Jérôme Combes, jerome@planningbilbio.fr

Description :
Fichier permettant l'authentification LDAP
*/

include "class.ldap.php";
if(substr($config['Auth-Mode'],0,3)=="CAS"){
  $authArgs=(array_key_exists("oups",$_SESSION) and $_SESSION['oups']['Auth-Mode']=="CAS")?null:"?noCAS";
}

if($login!="admin"){
  switch($config['Auth-Mode']){		//	Methode d'authentification
    case "LDAP" :				//	LDAP
      $auth=authLDAP($login,$password);
      break;

    case "LDAP-SQL" :			//	LDAP puis SQL en cas d'echec
      $auth=authLDAP($login,$password);
      if(!$auth){
	$auth=authSQL($login,$password);
      }
      break;

    case "CAS" :			//	CAS
      if($login and $_POST['auth']=="CAS"){
	$auth=true;
      }
      break;

    case "CAS-SQL" :		//	CAS puis SQL en cas d'echec
      if($login and $_POST['auth']=="CAS"){
	$auth=true;
      }
      if(!$auth){
	$auth=authSQL($login,$password);
      }
      break;
  }
}
?>