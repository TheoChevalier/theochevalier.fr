<?php
session_start();
include("includes/fonctions.php");
connexionbdd();
//Gestion du choix de la langue
$default_lang = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
$default_lang = strtolower(substr(chop($default_lang[0]),0,2));
if(isset($_GET['lang']) && $_GET['lang'] == 'fr') {
  $_SESSION['lang'] = 'fr';
  $lang = 'fr';
}
elseif(isset($_GET['lang']) && $_GET['lang'] == 'en') {
  $_SESSION['lang'] = 'en';
  $lang = 'en';
}
elseif(isset($_SESSION['lang']) && ($_SESSION['lang']=='fr' || $_SESSION['lang']=='en')) $lang = $_SESSION['lang'];
elseif($default_lang == 'en') $lang = $default_lang;
else $lang = 'fr';
if($lang == 'fr'){
  setlocale(LC_TIME, 'fr_FR');
  date_default_timezone_set('Europe/Paris');
}else
{
  setlocale(LC_TIME, 'en_US');
  date_default_timezone_set('America/Los_Angeles');
}
include("locales/index.php");
if(isset($_GET['page']) && !empty($_GET['page']))
{
  $page = $_GET['page'];
}
else{
  $page = '';
}
switch($page)
{
  case'2':
    include("pages/creations.php");
  break;
  case'3':
    include("pages/competences.php");
  break;
  case'4':
    include("pages/contact.php");
  break;
  case'5':
    include("pages/cv.php");
  break;
  case'6':
    include("pages/articles.php");
  break;
  case'fichiers':
    include("pages/fichiers.php");
  break;
  case'slam1':
    include("pages/slam1.php");
  break;
  case'slam1-2':
    include("pages/slam1-2.php");
  break;
  case'admin':
    include("pages/admin.php");
  break;
  default;
    include("pages/profil.php");
  break;
}
  include("pages/footer.php");
?>
</body>
</html>
