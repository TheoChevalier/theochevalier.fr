<?php
include("locales/creations.php");
$page_titre="Projets";
$page_desc = $langage['page_desc'][$lang];
include("pages/header.php");
include("pages/body.php");
 ?>
  <article id="creations">
    <div class="titre"><?=$langage['titre'][$lang]?></div>
    <div class="cadre_titre"></div>
    <div class="texte">
      <h1>Logiciels</h1>
      <a href="index.php?page=foxshop" class="portfolio_link">
        <div class="image image_black image_shadow"><img src="img/creations/9.jpg" alt="" /></div>
        <div class="creations_text">
          <h2><?=$langage['foxshop_titre'][$lang]?></h2>
          <p><?=$langage['foxshop'][$lang]?></p>
        </div>
        <div class="clear"></div>
      </a>

      <a href="index.php?page=firefox" class="portfolio_link">
        <div class="image image_black image_shadow"><img src="img/creations/5.jpg" alt="" /></div>
        <div class="creations_text">
          <h2><?=$langage['fx_titre'][$lang]?></h2>
          <p><?=$langage['fx'][$lang]?></p>
        </div>
        <div class="clear"></div>
      </a>
<h1>Sites web</h1>
      <a href="index.php?page=psvideo" class="portfolio_link">
        <div class="image image_black image_shadow"><img src="img/creations/6.jpg" alt="" /></div>
        <div class="creations_text">
          <h2><?=$langage['psv_titre'][$lang]?></h2>
          <p><?=$langage['psv'][$lang]?></p>
        </div>
        <div class="clear"></div>
      </a>

      <a href="index.php?page=ecommerce" class="portfolio_link">
        <div class="image image_black image_shadow"><img src="img/creations/4.jpg" alt="" /></div>
        <div class="creations_text">
          <h2><?=$langage['lpl_titre'][$lang]?></h2>
          <p><?=$langage['lpl'][$lang]?></p>
        </div>
        <div class="clear"></div>
      </a>
    <!--<div>
      <div class="image image_black image_shadow"><a href="http://www.gtaier.fr" target="_blank"><img src="img/creations/3.jpg" alt="" /></a></div>
      <div class="creations_text">
        <h2><?=$langage['gtaier_titre'][$lang]?></h2>
        <p><?=$langage['gtaier'][$lang]?></p>
      </div>
      <div class="clear"></div>
    </div>
    <div>
      <div class="image image_black image_shadow"><a href="http://teamforfun.free.fr" target="_blank"><img src="img/creations/1.jpg" alt="" /></a></div>
      <div class="creations_text">
        <h2><?=$langage['tff_titre'][$lang]?></h2>
        <p><?=$langage['tff'][$lang]?></p>
      </div>
      <div class="clear"></div>
    </div>
    <div>
      <div class="image image_black image_shadow"><a href="http://teamforfun.free.fr/edj/" target="_blank"><img src="img/creations/2.jpg" alt="" /></a></div>
      <div class="creations_text">
        <h2><?=$langage['edj_titre'][$lang]?></h2>
        <p><?=$langage['edj'][$lang]?></p>
      </div>
      <div class="clear"></div>
    </div>-->
    </div>
  </article>
