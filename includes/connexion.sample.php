<?php
define('ROOTPATH','http://'.$_SERVER['HTTP_HOST'], true);

// Database configuration

  // Name of the database server
  define('NOM_SERVEUR','localhost', true);
  
  // Your login
  define('LOGIN','root', true);
  
  // Your password
  define('MOT_DE_PASSE','password', true);
  
  // The name of the database
  define('NOM_BD','theochevalier', true);

// Server configuration
  $server = str_replace('http://', '', ROOTPATH);
  define('WEB_SERVER',$server, true);
  
  // The mail you want to use to be joined
  define('EMAIL','contact@theochevalier.fr', true);
  
  // The name to be displayed on the website
  define('NAME','Théo Chevalier', true);
?>