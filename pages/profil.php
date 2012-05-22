<?php include("pages/header.php");
include("pages/body.php");
include("locales/profil.php"); ?>
	<article id="profil">
		<div class="titre"><?=$langage['titre'][$lang]?></div>
		<div class="cadre_titre"></div>
		<div class="texte">
			<div class="image image_shadow"><img src="img/theo.jpg" alt="" width="219" height="146"/></div><?=$langage['presentation_deb'][$lang]?>
      <?=age('1991-01-07')?> <?=$langage['presentation_fin'][$lang]?>
		<div class="clear"></div>
		</div>
	</article>