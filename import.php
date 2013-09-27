<?php
/*
Planning Biblio, Plugin LDAP Version 1.0.4
Licence GNU/GPL (version 2 et au dela)
Voir les fichiers README.txt et COPYING.txt
Copyright (C) 2013 - Jérôme Combes

Fichier : plugins/ldap/import.php
Création : 4 juillet 2013
Dernière modification : 19 août 2013
Auteur : Jérôme Combes, jerome@planningbilbio.fr

Description :
Permet l'import des agents à partir d'un annuaire LDAP.
Affiche un formulaire de recherche et la liste des agents correspondants à la recherche.

Fichier appelé par la page personnel/import.php	
*/

echo "<h3>Importation des agents à partir de l'annuaire LDAP</h3>\n";
echo "<div id='import-div' style='position:relative; margin:30px 0 0 0;'>\n";
if(in_array('ldap',$plugins)){
  if(isset($_POST['import-type'])){
    if($_POST['import-type']=="ldap"){
      include "plugins/ldap/import3.php";
    }
  }
  else{
    include "plugins/ldap/import2.php";
  }
}
echo "</div>\n";
?>