<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
include("includes/connexion.php");
include("includes/lang.php");
$ProfileLoaded = false;

if ($page == '5' || $_SERVER['REQUEST_URI'] == '/cv') {
  header('Location: Resume-Theo-Chevalier-07-2016.pdf');
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
    include("pages/profil.php");
  break;
  default;
    if(is_file("pages/".$page.".php"))
      include("pages/".$page.".php");
    else
      include("pages/profil.php");
  break;
}
  include("pages/footer.php");
?>
</body>
</html>
