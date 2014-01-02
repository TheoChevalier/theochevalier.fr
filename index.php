<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
include("includes/fonctions.php");
connexionbdd();
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
    include("pages/contact.php");
  break;
  case'5':
    header('Location: files/CV_theo_chevalier_fr.pdf');
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
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://www.theochevalier.fr/piwik/" : "http://www.theochevalier.fr/piwik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://www.theochevalier.fr/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->
</body>
</html>
