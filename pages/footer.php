
 </div>
  <footer>
    <section class="menu">
      <ul>
        <li class="footer_menu"><a href="index.php?lang=<?=$lang?>"><?=$langage_index['menu_accueil'][$lang]?></a></li>
        <li class="footer_menu"><a href="index.php?page=6&amp;lang=<?=$lang?>"><?=$langage_index['menu_articles'][$lang]?></a></li>
        <li class="footer_menu"><a href="index.php?page=2&amp;lang=<?=$lang?>"><?=$langage_index['menu_projet'][$lang]?></a></li>
        <li class="footer_menu"><a href="index.php?page=5&amp;lang=<?=$lang?>"><?=$langage_index['menu_cv'][$lang]?></a></li>
        <li class="footer_menu"><a href="index.php?page=4&amp;lang=<?=$lang?>"><?=$langage_index['menu_contact'][$lang]?></a></li>
        <li class="footer_menu"><a href="<?=$url_fr?>" class="lang_footer"><div class="fr"></div></a></li>
        <li class="footer_menu"><a href="<?=$url_en?>" class="lang_footer"><div class="en"></div></a></li>
      </ul>
    </section>
    <div id="footer">
      <ul>
        <li class="footer_title"><?=$langage_index['articles'][$lang]?></li>
        <?php 
        $requete_art = mysql_query("SELECT art_id, titre_".$lang.", art_img, date_update_".$lang." FROM tc_articles ORDER BY date_update_".$lang." DESC LIMIT 7");
        while($art = mysql_fetch_array($requete_art))
          echo '<li><a href="index.php?page=6&amp;article='.$art['art_id'].'&amp;lang='.$lang.'">'.utf8_encode($art['titre_'.$lang]).'</a></li>';
        ?>
      </ul>
      <ul id="sites">
        <?=$langage_index['blogs'][$lang]?>
      </ul>
      <ul>
        <li class="footer_title"><?=$langage_index['tweets'][$lang]?></li>
      <?php
      
      /* Nom d'utilisateur sur Twitter */
      $user = "t_chevalier";
      /* Nombre de message à afficher */
      $count = 4;
      /* Format de la date à afficher */
      $date_format = 'd M Y, H\hi';
      $url = 'http://twitter.com/statuses/user_timeline/'.$user.'.xml?count='.$count;
      //$url = 'http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=t_chevalier';
      if ($oXML = simplexml_load_file( $url ))
      {
        foreach( $oXML->status as $oStatus ) {
          $datetime = date_create($oStatus->created_at);
          $date = date_format($datetime, $date_format);
          echo '<li><div class="tweet">'.parse($oStatus->text);
          echo '<div class="tweet_date"><a href="http://twitter.com/'.$user.'/status/'.$oStatus->id.'" target="_blank">'.$date.'</a></div></div></li>'."\n";
        }
      }
      ?>
      <li><a href="https://twitter.com/#!/t_chevalier" target="_blank"><?=$langage_index['tweeter'][$lang]?></a></li>
      </ul>
      <ul>
        <li class="footer_title"><?=$langage_index['pub'][$lang]?></li>
        <li><a href='http://sudweb.fr' target="_blank" class="footer_img"><img class="dark_shadow" src="img/sudweb_120.png" alt="Sud Web" width="120" height="120" /></a></li>
        <li><a href="http://www.stopacta.info/" target="_blank" class="footer_img"><img src="img/stop-acta.png" alt="STOP ACTA!" width="120" height="98" /></a></li>
      </ul>
    </div>
    <div id="firefox">
    Design &amp; code by Théo Chevalier - 2011-<?php
    $date_footer = getdate();
    $annee = $date_footer['year'];
    echo $annee; ?><br/>
     <a class="ff_desktop" href='https://affiliates.mozilla.org/link/banner/1287/2/3' target="_blank"><img src="img/firefox_<?=$lang?>.png" alt='Firefox Download Button' width="468" height="60"/></a>
     <a class="ff_mobile" href="https://affiliates.mozilla.org/link/banner/1287/1/91"><img src="img/firefox_mobile_en.png" alt="Firefox Mobile Download Button" width="125" height="125"/></a>
    </div>
  </footer>
</div> <!--! end of #container -->
<!-- JavaScript at the bottom for fast page loading -->
<!--[if lte IE 8 ]>
  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->