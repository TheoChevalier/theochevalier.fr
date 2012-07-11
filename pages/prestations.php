<?php
include("pages/header.php");
include("pages/body.php");
include("locales/prestations.php");
?>
	<article id="prestations">
		<div class="titre">
			<h1><?=$langage['titre'][$lang]?></h1>
		</div>
		<div class="cadre_titre"></div>
		<div class="texte">
		<h2><?=$langage['titre_pourquoi'][$lang]?></h2>
			<div class="logo_h2"><img src="img/ico/liste.png" alt="" /></div>
			<div class="marge_logo_h2">
				<p><?=$langage['pourquoi'][$lang]?></p>
			</div>
			<div class="logo_h2"><img src="img/ico/entreprise.png" alt="" /></div>
			<div class="marge_logo_h2">
				<p><?=$langage['entreprises'][$lang]?></p>
			</div>
			
			<div class="logo_h2"><img src="img/ico/particulier.png" alt="" /></div>
			<div class="marge_logo_h2">
				<p><?=$langage['particuliers'][$lang]?></p>
			</div>
			<h2><?=$langage['titre_comment'][$lang]?></h2>
			<div class="marge_logo_h2">
				<?=$langage['comment'][$lang]?>
			</div>
		</div>
	</article>