<?php include("pages/header.php");
include("pages/body.php");
include("locales/profil.php"); ?>
	<article id="profil">
		<div class="titre">
			<h1><?=$langage['titre'][$lang]?></h1> 
		</div>
		<div class="cadre_titre"></div>
		<div class="texte">
			<div class="image"><img src="img/theo.jpg" alt="" /></div><?=$langage['presentation_deb'][$lang]?>
      <?=age('1991-01-07')?> <?=$langage['presentation_fin'][$lang]?>
		<div class="clear"></div>
		</div>
	</article>