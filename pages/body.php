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
    
    function menu() {
      var menu = document.getElementById('menu').querySelector('ul');
      menu.classList.add('menu_active');
      menu.setAttribute('style','margin-top: -55px;');
      var header = document.querySelector('header');
      header.classList.add('header_close');
      header.setAttribute('style','opacity: 0;');
    }
  </script>
  <div id="container">
    <header>
      <div class="header_degrade">
        <img id="github" src="img/forkme_left_darkblue_121621.png" alt="Fork me on GitHub" usemap="#map" width="149" height="149"/>
        <map name="map">
          <area shape="poly" coords="134,0,0,134,0,0" href="https://github.com/TheoChevalier/theochevalier.fr" target="_blank" alt="Fork me on GitHub" />
        </map>
        <div id="choix_langue">
        <?php
          $uri = str_replace('&', '&amp;', $_SERVER['REQUEST_URI']);
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
          <a href="<?=$url_fr?>" class="lang"><div class="fr"></div></a>
          <a href="<?=$url_en?>" class="lang"><div class="en"></div></a>
        </div>
        <span class="titre_site roll"><span data-title="<?=NAME?>"><a class="unstyled_link" href="<?=ROOTPATH?>" onClick="menu();"><?=NAME?></a></span></span>
        <div class="sous_titre_site"><div class="star">*</div><?=$langage_index['ss_titre1'][$lang]?><div class="star">*</div><?=$langage_index['ss_titre2'][$lang]?><div class="star">*</div></div>
      </div>
      <div class="separateur_header">
        <div class="conteneur_liens_sociaux">
          <a href="index.php?page=4&amp;lang=<?=$lang?>" target="_blank" id="contact"></a>
          <a href="http://www.facebook.com/theo.chevalier" target="_blank" id="facebook"></a>
          <a href="http://twitter.com/#!/t_chevalier" target="_blank" id="twitter"></a>
          <a href="http://fr.linkedin.com/pub/th%C3%A9o-chevalier/3a/108/b44" target="_blank"  id="linkedin"></a>
          <a href="https://mozillians.org/tchevalier" target="_blank" id="mozillans"></a>
        </div>
      </div>
    </header>
    <div id="main" role="main">
    <section class="menu" id="menu">
      <ul onClick="menu();">
        <li class="header_menu"><a href="index.php?lang=<?=$lang?>"><?=$langage_index['menu_accueil'][$lang]?></a></li><li
        class="header_menu"><a href="index.php?page=6&amp;lang=<?=$lang?>"><?=$langage_index['menu_articles'][$lang]?></a></li><li
        class="header_menu"><a href="index.php?page=2&amp;lang=<?=$lang?>"><?=$langage_index['menu_projet'][$lang]?></a></li><li
        class="header_menu"><a href="index.php?page=3&amp;lang=<?=$lang?>"><?=$langage_index['menu_compet'][$lang]?></a></li><li
        class="header_menu"><a href="index.php?page=5&amp;lang=<?=$lang?>"><?=$langage_index['menu_cv'][$lang]?></a></li><li
        class="header_menu"><a href="index.php?page=4&amp;lang=<?=$lang?>"><?=$langage_index['menu_contact'][$lang]?></a></li>
      </ul>
    </section>