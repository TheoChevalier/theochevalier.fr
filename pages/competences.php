﻿<?php
include("pages/header.php");
include("pages/body.php");
include("locales/competences.php"); ?>
	<article id="competences">
		<div class="titre">
			<h1><?=$langage['titre'][$lang]?></h1>
		</div>
		<div class="cadre_titre"></div>
		<div class="texte">
			<div class="logo_h2"><img src="img/ico/script.png" alt="" /></div><h2><?=$langage['langages_titre'][$lang]?></h2>
			<div class="marge_logo_h2">
				<?=$langage['langages'][$lang]?>
			</div>
			<div class="logo_h2"><img src="img/ico/graphisme.png" alt="" /></div><h2><?=$langage['graphisme_titre'][$lang]?></h2>
			<div class="marge_logo_h2">
				<?=$langage['graphisme'][$lang]?>
			</div>
			
			<div class="logo_h2"><img src="img/ico/ampoule.png" alt="" /></div><h2><?=$langage['creativite_titre'][$lang]?></h2>
			<div class="marge_logo_h2">
				<?=$langage['creativite'][$lang]?>
			</div>
			
			<div class="logo_h2"><img src="img/ico/video.png" alt="" /></div><h2><?=$langage['video_titre'][$lang]?></h2>
			<div class="marge_logo_h2">
				<?=$langage['video'][$lang]?>
			</div>
			<div class="logo_h2"><img src="img/ico/os.png" alt="" /></div><h2><?=$langage['os_titre'][$lang]?></h2>
			<div class="marge_logo_h2">
				<?=$langage['os'][$lang]?>
			</div>
		</div>
	</article>