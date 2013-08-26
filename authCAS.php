<?php
/*
Planning Biblio, Plugin LDAP Version 1.0.2
Licence GNU/GPL (version 2 et au dela)
Voir les fichiers README.txt et COPYING.txt
Copyright (C) 2013 - Jérôme Combes

Fichier : plugins/ldap/authCAS.php
Création : 4 juillet 2013
Dernière modification : 24 juillet 2013
Auteur : Jérôme Combes, jerome@planningbilbio.fr

Description :
Fichier permettant l'authentification CAS
*/

include "class.ldap.inc";

if(substr($config['Auth-Mode'],0,3)=="CAS" and !isset($_GET['noCAS'])){
  $_SESSION['oups']['Auth-Mode']="CAS";
  $loginCAS=authCAS();
  if($loginCAS){
    echo "<script type='text/JavaScript'>document.form.login.value='$loginCAS';</script>\n";
    echo "<script type='text/JavaScript'>document.form.auth.value='CAS';</script>\n";
    echo "<script type='text/JavaScript'>document.form.submit();</script>\n";
  }
}
?>