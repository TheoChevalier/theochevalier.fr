<?php
//Gestion du choix de la langue
$default_lang = 'en';
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
  $default_lang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
  $default_lang = strtolower(substr(chop($default_lang[0]), 0, 2));
}
if(isset($_GET['lang']) && $_GET['lang'] == 'fr') {
  $lang = 'fr';
}
elseif(isset($_GET['lang']) && $_GET['lang'] == 'en') {
  $lang = 'en';
}
elseif ($default_lang == 'en') $lang = $default_lang;
else $lang = 'fr';
if ($lang == 'fr') {
  setlocale(LC_TIME, 'fr_FR');
  date_default_timezone_set('Europe/Paris');
}
else {
  setlocale(LC_TIME, 'en_US');
  date_default_timezone_set('America/Los_Angeles');
}
include("locales/index.php");
if (isset($_GET['page']) && ! empty($_GET['page']))
{
  $page = $_GET['page'];
}
else {
  $page = '';
}
?>
