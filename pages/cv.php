<?php
include("locales/cv.php");
$page_titre="Curriculum Vitae";
$page_desc = $langage['page_desc'][$lang];
include("pages/header.php");
include("pages/body.php");
 ?>
	<article id="cv">
			<div class="titre"><?=$langage['titre'][$lang]?></div>
		<div class="cadre_titre"></div>
		<div class="texte">
			<?=$langage['coord'][$lang]?>
			<br /><br />
			
			<h2><?=$langage['exp_titre'][$lang]?></h2>
			<div class="marge_logo_h2">
				<?=$langage['exp'][$lang]?>
			</div>
			
			<h2><?=$langage['comp_titre'][$lang]?></h2>
			<div class="marge_logo_h2" id="skills_level">
				<?=$langage['comp'][$lang]?>
			</div>
			
			<h2><?=$langage['formation_titre'][$lang]?></h2>
			<div class="marge_logo_h2">
				<?=$langage['formation'][$lang]?>
			</div>
			
			<h2><?=$langage['os_titre'][$lang]?></h2>
			<div class="marge_logo_h2">
				<?=$langage['os'][$lang]?>
			</div>
			
			<h2><?=$langage['divers_titre'][$lang]?></h2>
			<div class="marge_logo_h2">
				<?=$langage['divers'][$lang]?>
			</div>
		</div>
		<a href="cv_theo_chevalier_<?=$lang?>.pdf" target="_blank">
		<div class="pdf">
			<div class="logo_h2" id="pdf"></div><?=$langage['telecharger'][$lang]?>
		</div>
		</a>
	</article>