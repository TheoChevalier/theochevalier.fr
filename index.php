<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
include("includes/fonctions.php");
$sql = connexionbdd();
include("includes/lang.php");
$ProfileLoaded = false;
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
  case'5':
    header('Location: Resume-Theo-Chevalier-03-2016.pdf');
  break;
  case'6':
    include("pages/articles.php");
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
