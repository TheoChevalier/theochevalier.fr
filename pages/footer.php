
 </div>
  <footer>
    <section id="menu">
      <ul>
      <a href="index.php?lang=<?=$lang?>"><li><?=$langage_index['menu_accueil'][$lang]?></li></a><a 
      href="index.php?page=6&amp;lang=<?=$lang?>"><li><?=$langage_index['menu_articles'][$lang]?></li></a><a 
      href="index.php?page=2&amp;lang=<?=$lang?>"><li><?=$langage_index['menu_projet'][$lang]?></li></a><a 
      href="index.php?page=3&amp;lang=<?=$lang?>"><li><?=$langage_index['menu_compet'][$lang]?></li></a><a 
      href="index.php?page=5&amp;lang=<?=$lang?>"><li><?=$langage_index['menu_cv'][$lang]?></li></a><a 
      href="index.php?page=4&amp;lang=<?=$lang?>"><li><?=$langage_index['menu_contact'][$lang]?></li></a><a
      href="<?=$url_fr?>"><li><img class="dark_shadow" src="img/ico/flag_fr.png" alt="Français" title="Définir la langue en français" /></li></a><a
      href="<?=$url_en?>"><li><img class="dark_shadow" src="img/ico/flag_en.png" alt="English" title="Set langage to English" /></li></a>
      </ul>
    </section>
    <!-- Solution sale si pas de solution trouvée au pb actuel...
    <table>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </table>-->
    <div id="footer">
      <ul>
        <?=$langage_index['blogs'][$lang]?>
      </ul>
      <ul>
        <li><?=$langage_index['articles'][$lang]?></li>
        <?php 
        $requete_art = mysql_query("SELECT art_id, titre_".$lang.", art_img, date_update FROM tc_articles ORDER BY date_update DESC");
        while($art = mysql_fetch_array($requete_art))
          echo '<li><a href="index.php?page=6&article='.$art['art_id'].'&lang='.$lang.'">'.utf8_encode($art['titre_'.$lang]).'</a></li>';
        ?>
      </ul>
      <ul>
      <?php
      /*$xml = fopen("http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=t_chevalier" , 'r');
      file_put_contents("pages/twitter.xml", $xml);
      
      echo fread($xml, filesize("pages/twitter.xml"));*/
      
      ?>
      <li><?=$langage_index['tweets'][$lang]?></li>
      </ul>
      <ul>
        <li><a href='http://sudweb.fr' target="_blank"><img class="dark_shadow" src="img/sudweb_120.png" alt='Sud Web' /></a></li>
        <li><a href="http://www.stopacta.info/" target="_blank" ><img src="img/stop-acta.png" alt="STOP ACTA!" /></a></li>
      </ul>
    </div>
    <!--
    <div class="stop-acta">
      <a class="sudweb" href='http://sudweb.fr' target="_blank"><img src="img/sudweb_120.png" alt='Sud Web' /></a>
      <a href="http://www.stopacta.info/" target="_blank" ><img src="img/stop-acta.png" alt="STOP ACTA!" /></a>
    </div>-->
    <div id="firefox">
    Design &amp; code by Théo Chevalier - 2011-<?php
    $date_footer = getdate();
    $annee = $date_footer['year'];
    echo $annee; ?><br/>
     <a class="ff_desktop" href='https://affiliates.mozilla.org/link/banner/1287/2/3' target="_blank"><img src="img/firefox_<?=$lang?>.png" alt='Firefox Download Button' /></a>
     <a class="ff_mobile" href="https://affiliates.mozilla.org/link/banner/1287/1/91"><img src="img/firefox_mobile_en.png" alt="Firefox Mobile Download Button" /></a>
    </div>
  </footer>
</div> <!--! end of #container -->
<!-- JavaScript at the bottom for fast page loading -->
<!--[if lte IE 8 ]>
  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->