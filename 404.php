<?php
session_start();
include("includes/fonctions.php");
include("includes/lang.php");
include("locales/404.php");
$page_titre = $langage['window_title'][$lang];
include("pages/header.php");
?>
	<style>
	.titre_site{ margin-top: 50px;}
	</style>
	<body>
		<div id="main">
			<div class="titre_site"><?=$langage['big_title'][$lang]?></div>
			<article>
				<div class="titre">
				  <h1><?=$langage['title'][$lang]?></h1>
				</div>
				<div class="clear"></div>
				<div class="cadre_titre"></div>
				<div class="texte">
				  <div class="clear"></div>
					<div class="logo_h2" id="info"></div>	
					<div class="marge_logo_h2"><?=$langage['content'][$lang]?></div>
					<div class="logo_h2" id="loupe"></div>
					<div class="marge_logo_h2">
						<script>
						var GOOG_FIXURL_LANG = (navigator.language || '').slice(0,2),
						GOOG_FIXURL_SITE = location.host;
						</script>
						<script src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js"></script>
					</div>
				</div>
			</article>
		</div>
	</body>
</html>