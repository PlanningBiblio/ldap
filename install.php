<?php
/*
Planning Biblio, Plugin LDAP Version 1.0.4
Licence GNU/GPL (version 2 et au dela)
Voir les fichiers README.txt et COPYING.txt
Copyright (C) 2013 - Jérôme Combes

Fichier : plugins/ldap/install.php
Création : 27 juin 2013
Dernière modification : 5 juillet 2013
Auteur : Jérôme Combes, jerome@planningbilbio.fr

Description :
Fichier permettant l'installation du plugin LDAP. Ajoute les informations nécessaires dans la base de données
*/

session_start();
if($_SESSION['login_id']!=1){
  echo "<br/><br/><h3>Vous devez vous connecter au planning<br/>avec le login \"admin\" pour pouvoir installer ce plugin.</h3>\n";
  echo "<a href='../../index.php'>Retour au planning</a>\n";
  exit;
}

$version="1.0";
include_once "../../include/config.php";
$sql=array();
//	Ajout des infos LDAP dans la table config
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'LDAP-Host','','','Nom d&apos;hote ou IP du serveur LDAP','LDAP','','20');";
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'LDAP-Port','','','Port du serveur LDAP','LDAP','','20');";
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'LDAP-Protocol','enum','','Protocol du serveur LDAP','LDAP','ldap,ldaps','20');";
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'LDAP-Suffix','','','Suffix LDAP','LDAP','','20');";
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'LDAP-Filter','','','Filtre','LDAP','','20');";
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'LDAP-RDN','','','DN de connexion au serveur LDAP','LDAP','','20');";
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'LDAP-Password','password','','Mot de passe de connexion','LDAP','','20');";

//	Ajout des infos CAS dans la table config
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'CAS-Hostname','text','','Nom d&apos;h&ocirc;te du serveur CAS','CAS','','30');";
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'CAS-Port','text','8080','Port serveur CAS','CAS','','30');";
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'CAS-Version','text','2','Version du serveur CAS','CAS','','30');";
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'CAS-CACert','text','','Certificat de l&apos;Autorit&eacute; de Certification','CAS','','30');";
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'CAS-URI','text','cas','Page de connexion CAS','CAS','','30');";
$sql[]="INSERT INTO `{$dbprefix}config` VALUES (null,'CAS-URI-Logout','text','cas/logout','Page de d&eacute;connexion CAS','CAS','','30');";

//	Ajout du choix de la méthode d'authentification
$sql[]="UPDATE `{$dbprefix}config` SET `valeurs`=CONCAT(`valeurs`,',LDAP,LDAP-SQL,CAS,CAS-SQL') WHERE `nom`='Auth-Mode';";

//	Inscription du plugin LDAP dans la base
$sql[]="INSERT INTO `{$dbprefix}plugins` (`nom`) VALUES ('ldap');";

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