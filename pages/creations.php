<?php
include("locales/creations.php");
$page_titre="Projets";
$page_desc = $langage['page_desc'][$lang];
include("pages/header.php");
include("pages/body.php");
 ?>
  <article id="creations">
    <div class="titre">
      <h1><?=$langage['titre'][$lang]?></h1>
    </div>
    <div class="cadre_titre"></div>
    <div class="texte">
    <div>
      <div class="image"><a href="http://www.mozilla.org/about" target="_blank"><img src="img/creations/5.jpg" alt=""></a></div>
      <h2><?=$langage['fx_titre'][$lang]?></h2>
      <p><?=$langage['fx'][$lang]?></p>
      <div class="clear"></div>
    </div>
    <div>
      <div class="image"><a href="http://www.paintball-lorraine.theochevalier.fr" target="_blank"><img src="img/creations/4.jpg" alt=""></a></div>
      <h2><?=$langage['lpl_titre'][$lang]?></h2>
      <p><?=$langage['lpl'][$lang]?></p>
      <div class="clear"></div>
    </div>
    <div>
      <div class="image"><a href="http://www.gtaier.fr" target="_blank"><img src="img/creations/3.jpg" alt=""></a></div>
      <h2><?=$langage['gtaier_titre'][$lang]?></h2>
      <p><?=$langage['gtaier'][$lang]?></p>
      <div class="clear"></div>
    </div>
    <div>
      <div class="image"><a href="http://teamforfun.free.fr" target="_blank"><img src="img/creations/1.jpg" alt=""></a></div>
      <h2><?=$langage['tff_titre'][$lang]?></h2>
      <p><?=$langage['tff'][$lang]?></p>
      <div class="clear"></div>
    </div>
    <div>
      <div class="image"><a href="http://teamforfun.free.fr/edj/" target="_blank"><img src="img/creations/2.jpg" alt=""></a></div>
      <h2><?=$langage['edj_titre'][$lang]?></h2>
      <p><?=$langage['edj'][$lang]?></p>
      <div class="clear"></div>
    </div>
    </div>
  </article>