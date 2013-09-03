<?php
/*
Planning Biblio, Plugin LDAP Version 1.0.3
Licence GNU/GPL (version 2 et au dela)
Voir les fichiers README.txt et COPYING.txt
Copyright (C) 2013 - Jérôme Combes

Fichier : plugins/ldap/class.ldap.inc
Création : 4 juillet 2013
Dernière modification : 24 juillet 2013
Auteur : Jérôme Combes, jerome@planningbilbio.fr

Description :
Fonctions permettant les authentifications LDAP et CAS
Fichier inclus par plugins/ldap/auth.php
*/


function authCAS(){
  include "CAS-1.3.2/CAS.php";
  phpCAS::setDebug("data/cas_debug.txt");
  phpCAS::client($GLOBALS['config']['CAS-Version'], $GLOBALS['config']['CAS-Hostname'], intval($GLOBALS['config']['CAS-Port']), $GLOBALS['config']['CAS-URI'],false);
  phpCAS::setExtraCurlOption(CURLOPT_SSLVERSION,3);
  if($GLOBALS['config']['CAS-CACert']){
    phpCAS::setCasServerCACert($GLOBALS['config']['CAS-CACert']);
  }
  else{
    phpCAS::setNoCasServerValidation();
  }
  phpCAS::forceAuthentication();
  return phpCAS::getUser();
}

function authLDAP($login,$password){
  $auth=false;
  if(!$GLOBALS['config']['LDAP-Port']){
    $GLOBALS['config']['LDAP-Port']="389";
  }

  //	Connexion au serveur LDAP
  $ldapconn = ldap_connect($GLOBALS['config']['LDAP-Host'],$GLOBALS['config']['LDAP-Port'])
    or die ("Impossible de se connecter au serveur LDAP");
  ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
  ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
  if($ldapconn){
    if(@ldap_bind($ldapconn,"uid=".$login.",ou=people,".$GLOBALS['config']['LDAP-Suffix'],$password)){
      $auth=true;
      $_SESSION['oups']['Auth-Mode']="LDAP";
    }
  }
  return $auth;
}

?>