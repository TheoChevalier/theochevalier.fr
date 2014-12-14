
 <?php if(!$ProfileLoaded) echo "</div>"; ?>
  <footer>
    <section class="menu">
      <ul>
        <li class="footer_menu"><a href="index.php?lang=<?=$lang?>"><?=$langage_index['menu_accueil'][$lang]?></a></li>
        <li class="footer_menu"><a href="index.php?page=6&amp;lang=<?=$lang?>"><?=$langage_index['menu_articles'][$lang]?></a></li>
        <li class="footer_menu"><a href="index.php?page=2&amp;lang=<?=$lang?>"><?=$langage_index['menu_projet'][$lang]?></a></li>
        <li class="footer_menu"><a href="index.php?page=5&amp;lang=<?=$lang?>"><?=$langage_index['menu_cv'][$lang]?> <i class="fa fa-file-pdf-o"></i>
</a></li>
        <li class="footer_menu"><a class="mailto" data-mailto-user="contact-web" data-mailto-domain="theochevalier.fr"><?=$langage_index['menu_contact'][$lang]?> <i class="fa fa-paper-plane-o"></i></a></li>
        <li class="footer_menu"><a href="<?=$url_fr?>" class="lang_footer"><div class="fr"></div></a></li>
        <li class="footer_menu"><a href="<?=$url_en?>" class="lang_footer"><div class="en"></div></a></li>
      </ul>
    </section>
    <div id="footer">
      <ul>
        <li class="footer_title"><?=$langage_index['articles'][$lang]?></li>
        <?php 
        $requete_art = mysql_query("SELECT art_id, titre_".$lang.", date FROM tc_articles ORDER BY date DESC LIMIT 6");
        while($art = mysql_fetch_array($requete_art))
          echo '<li><a href="index.php?page=6&amp;article='.$art['art_id'].'&amp;lang='.$lang.'">'.utf8_encode($art['titre_'.$lang]).'</a></li>';
        ?>
      </ul>
      <ul id="sites">
        <?=$langage_index['blogs'][$lang]?>
      </ul>
      <ul>
        <li class="footer_title"><?=$langage_index['tweets'][$lang]?></li>
          <a class="twitter-timeline"  href="https://twitter.com/t_chevalier"  data-widget-id="353618369028694016">Tweets de @t_chevalier</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
      </ul>
      <ul>
        <li class="footer_title"><?=$langage_index['pub'][$lang]?></li>
        <li><a class="footer_img" href='https://affiliates.mozilla.org/link/banner/1287/2/3' target="_blank"><img src="img/firefox_desktop_<?=$lang?>.png" alt='Firefox Download Button' width="125" height="125"/></a></li>
        <li><a href='https://affiliates.mozilla.org/link/banner/40382' target="_blank" class="footer_img"><img src="img/firefox_os_<?=$lang?>.png" alt="Firefox OS" width="125" height="125" /></a></li>
      </ul>
    </div>
    <div id="firefox">
      <?=$langage_index['credit'][$lang]?><?php
      $date_footer = getdate();
      $annee = $date_footer['year'];
      echo $annee; ?> &middot; <a href="index.php?page=sitemap" class="lien">Sitemap</a>
    </div>
  </footer>
</div> <!--! end of #container -->
<!-- JavaScript at the bottom for fast page loading -->
<script type="text/javascript">
    function menu() {
      var menu = document.getElementById('menu').querySelector('ul');
      menu.classList.add('menu_active');
      menu.setAttribute('style','margin-top: -55px;');
      var header = document.querySelector('header');
      header.classList.add('header_close');
      header.setAttribute('style','opacity: 0;');
    }

  ;[].forEach.call(document.getElementsByClassName("mailto"), function(el) {
  el.setAttribute("href", "mailto:" + el.getAttribute("data-mailto-user") + "@" + (el.getAttribute("data-mailto-domain") || window.location.host))
  })
</script>
