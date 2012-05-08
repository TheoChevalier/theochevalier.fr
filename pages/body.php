<body>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-10787732-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  <div id="container">
    <header>
  <div class="header_degrade">
  <a href="https://github.com/TheoChevalier" target="_blank"><img style="position: absolute; top: 0; left: 0; border: 0;" src="img/forkme_left_darkblue_121621.png" alt="Fork me on GitHub"></a>
    <div class="choix_langue">
    <?php
      $uri = $_SERVER['REQUEST_URI'];
      if(preg_match("/lang=/i", $uri)) {
        $url_fr = str_replace('lang=en', 'lang=fr', $uri);
        $url_en = str_replace('lang=fr', 'lang=en', $uri);
      }
      else {
        switch($uri)
        {
          case "/index.php":
            $url_fr = $uri.'?lang=fr';
            $url_en = $uri.'?lang=en';
          break;
          
          case "/":
            $url_fr = $uri.'index.php?lang=fr';
            $url_en = $uri.'index.php?lang=en';
          break;
          
          default:
            $url_fr = $uri.'&amp;lang=fr';
            $url_en = $uri.'&amp;lang=en';
          break;
        }
      }
    ?>
      <a href="<?=$url_fr?>"><button><img src="img/ico/flag_fr.png" alt="Français" title="Définir la langue en français" /></button></a>
      <a href="<?=$url_en?>"><button><img src="img/ico/flag_en.png" alt="English" title="Set langage to English" /></button></a>
    </div>
    <div class="titre_site">Théo Chevalier</div>
    <div class="sous_titre_site"><img src="img/etoile.png" alt="*" /><?=$langage_index['ss_titre1'][$lang]?><img src="img/etoile.png" alt="*" /><?=$langage_index['ss_titre2'][$lang]?><img src="img/etoile.png" alt="*" /></div>
  </div>
  <div class="separateur_header">
    <div class="conteneur_liens_sociaux">
      <div class="lien_social"><a href="index.php?page=4&amp;lang=<?=$lang?>"><img src="img/email.png" alt="" /></a></div>
      <div class="lien_social"><a href="http://www.facebook.com/theo.chevalier" target="_blank"><img src="img/facebook.png" alt="" /></a></div>
      <div class="lien_social"><a href="http://twitter.com/#!/T_Chevalier" target="_blank"><img src="img/twitter.png" alt="" /></a></div>
      <div class="lien_social"><a href="http://fr.linkedin.com/pub/th%C3%A9o-chevalier/3a/108/b44" target="_blank"><img src="img/linkedin.png" alt="" /></a></div>
      <div class="lien_social"><a href="https://mozillians.org/tchevalier" target="_blank"><img src="img/mozilla.png" alt="" /></a></div>
    </div>
  </div>
    </header>
    <div id="main" role="main">
    <section id="menu">
    <ul>
    <a href="index.php?lang=<?=$lang?>"><li><?=$langage_index['menu_accueil'][$lang]?></li></a><a 
    href="index.php?page=6&amp;lang=<?=$lang?>"><li><?=$langage_index['menu_articles'][$lang]?></li></a><a 
    href="index.php?page=2&amp;lang=<?=$lang?>"><li><?=$langage_index['menu_projet'][$lang]?></li></a><a 
    href="index.php?page=3&amp;lang=<?=$lang?>"><li><?=$langage_index['menu_compet'][$lang]?></li></a><a 
    href="index.php?page=5&amp;lang=<?=$lang?>"><li><?=$langage_index['menu_cv'][$lang]?></li></a><a 
    href="index.php?page=4&amp;lang=<?=$lang?>"><li><?=$langage_index['menu_contact'][$lang]?></li></a>
    </ul>
  </section>