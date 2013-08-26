<?php
/*
Planning Biblio, Plugin LDAP Version 1.0.2
Licence GNU/GPL (version 2 et au dela)
Voir les fichiers README.txt et COPYING.txt
Copyright (C) 2013 - Jérôme Combes

Fichier : plugins/ldap/uninstall.php
Création : 4 juillet 2013
Dernière modification : 23 juillet 2013
Auteur : Jérôme Combes, jerome@planningbilbio.fr

Description :
Fichier permettant la désinstallation du plugin LDAP. Supprime les informations LDAP de la base de données
*/

session_start();

// Sécurité
if($_SESSION['login_id']!=1){
  echo "<br/><br/><h3>Vous devez vous connecter au planning<br/>avec le login \"admin\" pour pouvoir d&eacute;sinstaller ce plugin.</h3>\n";
  echo "<a href='../../index.php'>Retour au planning</a>\n";
  exit;
}

$version="1.0";
include_once "../../include/config.php";
$sql=array();
//	Suppression des infos LDAP dans la table config
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='LDAP-Host';";
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='LDAP-Port';";
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='LDAP-Protocol';";
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='LDAP-Suffix';";
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='LDAP-Filter';";
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='LDAP-RDN';";
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='LDAP-Password';";

//	Suppression des infos CAS dans la table config
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='CAS-Version';";
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='CAS-Hostname';";
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='CAS-Port';";
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='CAS-URI';";
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='CAS-URI-Logout';";
$sql[]="DELETE FROM `{$dbprefix}config` WHERE `nom`='CAS-CACert';";

//	Modification du choix de la méthode d'authentification
$sql[]="UPDATE `{$dbprefix}config` SET `valeurs`=REPLACE(`valeurs`,',LDAP,LDAP-SQL,CAS,CAS-SQL','') WHERE `nom`='Auth-Mode';";
$sql[]="UPDATE `{$dbprefix}config` SET `valeur`='SQL' WHERE `nom`='Auth-Mode';";

//	Inscription du plugin LDAP dans la base
$sql[]="DELETE FROM `{$dbprefix}plugins` WHERE `nom`='ldap';";

foreach($sql as $elem){
  $db=new db();
  $db->query($elem);
  if(!$db->error)
    echo "$elem : <font style='color:green;'>OK</font><br/>\n";
  else
    echo "$elem : <font style='color:red;'>Erreur</font><br/>\n";
}

echo "<br/><br/><a href='../../index.php'>Retour au planning</a>\n";
?>