<?php
include("locales/creations.php");
$page_titre="Mozilla Firefox";
$page_desc = $langage['page_desc'][$lang];
include("pages/header.php");
include("pages/body.php");
 ?>
  <article id="creations">
    <div class="titre">Portfolio</div>
    <div class="cadre_titre"></div>
    <div class="texte details">
      <h1 class="portfolio_h1">Mozilla Firefox</h1>
      <div class="container">
        <div class="portfolio-shadow curved"><img src="img/creations/firefox.png" alt="" /></div>
      </div>
      <p>J’ai réalisé plusieurs modifications dans Firefox sur mon temps libre.</p>
      <p>J’ai ajouté une « promo-box » (encart informatif) à Firefox pour signaler à l’utilisateur qu’il peut synchroniser ses modules complémentaires.
      <br/>J’ai également modifié plusieurs parties de l’interface des versions de développement et ajouté de nombreuses vérifications au niveau des préférences concernant l’envoi de données de performance (télémétrie).
      <br/>Vous pouvez consulter la <a class="lien" href="https://bugzilla.mozilla.org/buglist.cgi?list_id=2930875;resolution=FIXED;emailtype1=exact;query_format=advanced;emailassigned_to1=1;email1=theo.chevalier11%40gmail.com">
      liste de mes modifications</a> sur Bugzilla.</p>
      <p>En dehors du code, je localise (traduis) Firefox et l’ensemble des logiciels de Mozilla en français.</p>
      

        <p class="competences">Compétences acquises :
<br/>- Créer du code optimisé, réutilisable et lisible par tous
<br/>- Développement au sein d’une communauté mondiale, en anglais
<br/>- Débogage à l’aide de tests unitaires
<br/>- Utilisation de logiciels de gestion de versions (GIT, HG, SVN)
<br/>- Utilisation de logiciel de gestion de projet (Bugzilla)
<br/></p>
      <div>
      <a href="img/creations/optin.png"><div class="image"><img src="img/creations/optin_mini.png" alt="Opt in notification" /></div></a>
      <div class="creations_text"><p>Notification pour informer de l’activation par défaut de la télémétrie pour Firefox pour ordinateur, activation de la télémétrie par défaut pour Nightly et Aurora (<a href="https://bugzilla.mozilla.org/show_bug.cgi?id=699806">Bug 699806</a>)
      Cette fonctionnalité aura nécessité plus de 40 versions de patch et plusieurs semaines de développement. Un an s’est écoulé le temps que des discussions aient lieu avec la communauté.
      <!--<br/>Une difficulté majeure aura été d’identifier et prendre en charge tous les différents cas. Gavin Sharp (ingénieur Firefox) a même dû proposer une toute nouvelle approche en cours de développement tellement la gestion des différents cas se compliquait.-->
      </p></div>
      <div class="clear"></div>
      </div>
      <div>
        <a href="img/creations/optout.png"><div class="image"><img src="img/creations/optout_mini.jpg" alt="Opt out notification" /></div></a>
        <div class="creations_text"><p>Notification pour informer de l’activation par défaut de la télémétrie pour Firefox pour Android (<a href="https://bugzilla.mozilla.org/show_bug.cgi?id=725987">Bug 725987</a>)
        </p></div>
        <div class="clear"></div>
      </div>

      <div>
        <a href="img/creations/doorhanger.jpg"><div class="image"><img src="img/creations/doorhanger_mini.jpg" alt="Opt in notification" /></div></a>
        <div class="creations_text"><p>« Promo-box » pour informer de la possibilité de synchroniser les modules complémentaires avec Firefox Sync (<a href="https://bugzilla.mozilla.org/show_bug.cgi?id=716643">Bug 716643</a>)
        </p></div>
        <div class="clear"></div>
      </div>

      <div class="clear"></div>
</article>
