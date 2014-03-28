<?php
/*
Planning Biblio, Plugin LDAP Version 1.0.4
Licence GNU/GPL (version 2 et au dela)
Voir les fichiers README.md et LICENSE
Copyright (C) 2013-2014 - Jérôme Combes

Fichier : plugins/ldap/function.php
Création : 27 juin 2013
Dernière modification : 28 juin 2013
Auteur : Jérôme Combes, jerome@planningbilbio.fr

Description :
Fonctions utiles à l'importation et authentification LDAP

*/

function cmp_ldap($a,$b){	//tri par nom puis prenom (sn et givenname)
  if ($a['sn'][0] == $b['sn'][0]){
    if($a['givenname'][0] == $b['givenname'][0])
      return 0;
    return ($a['givenname'][0] < $b['givenname'][0]) ? -1 : 1;
    }
  return ($a['sn'][0] < $b['sn'][0]) ? -1 : 1;
}

?>