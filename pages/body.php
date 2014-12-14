<body>
<!--[if lte IE 8 ]>
<style>
#github{position: relative;display: block;float:left;}
#choix_langue{position: relative;display: block; float: right;}
</style>
<div id="ie_banner">
<img src="img/ico/ie_stop.png" alt="Stop" />
<?=$langage_index['ie_banner'][$lang]?>
</div>
<![endif]--> 
<script>
    window._idl = {};
    _idl.variant = "banner";
    (function() {
        var idl = document.createElement('script');
        idl.type = 'text/javascript';
        idl.async = true;
        idl.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'members.internetdefenseleague.org/include/?url=' + (_idl.url || '') + '&campaign=' + (_idl.campaign || '') + '&variant=' + (_idl.variant || 'banner');
        document.getElementsByTagName('body')[0].appendChild(idl);
    })();
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
          <a href="<?=$url_fr?>" class="lang" onClick="menu();"><div class="fr"></div></a>
          <a href="<?=$url_en?>" class="lang" onClick="menu();"><div class="en"></div></a>
        </div>
        <div id="titre_site">
          <span class="titre_site"><a class="unstyled_link" href="<?=ROOTPATH?>" onClick="menu();"><?=NAME?></a></span>
          <div class="sous_titre_site"><div class="star">*</div><?=$langage_index['ss_titre1'][$lang]?><div class="star">*</div><?=$langage_index['ss_titre2'][$lang]?><div class="star">*</div></div>
        </div>
      </div>
      <div class="separateur_header">
        <div class="conteneur_liens_sociaux">
          <a class="mailto" data-mailto-user="contact-web" data-mailto-domain="theochevalier.fr" title="Contact" id="contact"></a>
          <a href="https://twitter.com/#!/t_chevalier" title="Twitter" id="twitter"></a>
          <a href="https://www.linkedin.com/in/theochevalier/" title="Linkedin" id="linkedin"></a>
          <a href="https://github.com/TheoChevalier" title="Github" id="github_social"></a>
          <a href="https://reps.mozilla.org/u/tchevalier/" title="Mozilla Reps" id="mozillans"></a>
        </div>
      </div>
    </header>
    <div id="main" role="main">
    <section class="menu" id="menu">
      <ul>
        <li class="header_menu" onClick="menu();"><a href="index.php?lang=<?=$lang?>"><?=$langage_index['menu_accueil'][$lang]?></a></li><li
        class="header_menu" onClick="menu();"><a href="index.php?page=6&amp;lang=<?=$lang?>"><?=$langage_index['menu_articles'][$lang]?></a></li><li
        class="header_menu" onClick="menu();"><a href="index.php?page=2&amp;lang=<?=$lang?>"><?=$langage_index['menu_projet'][$lang]?></a></li><li
        class="header_menu" onClick="menu();"><a href="index.php?page=5&amp;lang=<?=$lang?>"><?=$langage_index['menu_cv'][$lang]?></a></li><li
        class="header_menu"><a class="mailto" data-mailto-user="contact-web" data-mailto-domain="theochevalier.fr"><?=$langage_index['menu_contact'][$lang]?></a></li>
      </ul>
    </section>
