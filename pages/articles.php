<?php
include("locales/articles.php");
//Si un numero d'article est présent on récupère toutes les infos
if(isset($_GET['article'])&& !empty($_GET['article']))
{
  $art_id = mysql_real_escape_string($_GET['article']);
  $requete_art = mysql_query('SELECT art_id, titre_'.$lang.', keywords, texte_'.$lang.', art_img, date, date_update FROM tc_articles WHERE art_id = '.$art_id);
  $art = mysql_fetch_array($requete_art);
  //On prépare les variables pour les afficher dans le header
  $page_titre = utf8_encode($art['titre_'.$lang]);
  $page_img = "articles/".$art['art_img'];
  $page_desc = utf8_encode(strip_tags(substr($art['texte_'.$lang], 0, 400)))." ...";
  $page_keywords = utf8_encode($art['keywords']);
  //On inclue le header et le menu
  include("pages/header.php");
  include("pages/body.php");
  //Et on affiche l'article
 ?>
  <a href="index.php?page=6&amp;lang=<?=$lang?>" onClick="menu();"><div class="art_link"><div class="arrow_back"></div> <?=$langage['titre'][$lang]?></div></a>
  <article class="art_all">
    <h1 class="art_titre art_titre_article"><?=utf8_encode($art['titre_'.$lang])?></h1>
    <?php if($art['date'] != $art['date_update']) echo '<span id="update">'.$langage['update'][$lang].' '.date_heure($art['date_update'], $lang).'.</span>'; ?>
    <div class="art_text">
      <div class="art_img_big"><img src="img/articles_big/<?=$art['art_img']?>" alt="<?=$art['art_img']?>" /></div>
      <?php echo utf8_encode($art['texte_'.$lang]); ?>
      <div id="partage">
        <div>
          <a href="https://twitter.com/share" class="twitter-share-button" data-via="t_chevalier" data-lang="<?=$lang?>">Tweeter</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
        <div>
          <a name="fb_share" type="button" share_url="<?php echo ROOTPATH.str_replace('&', '&amp;', $_SERVER['REQUEST_URI']).'&amp;lang='.$lang; ?>">Partager</a>
          <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
        </div>
      </div>
      <div class="art_date2"><?=$langage['date'][$lang]?> <?php echo utf8_encode(date_heure($art['date'], $lang)); ?></div>
      <div class="clear"></div>
    <div class="com_sep"></div>
    <?php
    //On affiche les comentaires
    $i=0;
    $com_requete = mysql_query('SELECT * FROM tc_com WHERE com_art ='.$art['art_id']);
    $compte = mysql_query('SELECT COUNT(*) AS nb_com FROM tc_com WHERE com_art ='.$art['art_id']);
    $com_compte = mysql_fetch_array($compte);
    if($com_compte["nb_com"] > 0) echo "<h2>".$com_compte["nb_com"]." commentaires</h2>";
    if($com_requete)
    {
      while($com = mysql_fetch_array($com_requete))
      {
        $i++;
        echo add_com($i,$com['com_id'],$com['com_mail'],$com['com_site'],$com['com_nom'],$com['com_date'],$com['com_msg'],$lang);
      }
    }
    ?>
    
    <script src="js/libs/canvasloader.min.js"></script>
    <script type="text/javascript">
    function creerRequete() {
      try {
        requete = new XMLHttpRequest();
      } catch (microsoft) {
        try {
          requete = new ActiveXObject('Msxml2.XMLHTTP');
        } catch(autremicrosoft) {
          try {
            requete = new ActiveXObject('Microsoft.XMLHTTP');
          } catch(echec) {
            requete = null;
          }
        }
      }
      if(requete == null) {
      alert('<?=$langage['xhr_fail'][$lang]?>');
      }
    }
    
    var count_message = <?=$i?>;
    function envoi_ajax() {
      creerRequete();
      var form = document.formulaire;
      var nom = form.nom.value;
      var email = form.email.value;
      var site = form.site.value;
      var message = form.message.value;
      var follow = form.follow;
      if(follow.checked)
        var follow = follow.value;
      else
        var follow = "no-follow";
      var article = <?=$_GET['article']?>;
      var lang = '<?=$lang?>';
      var url = 'includes/com.php';
      requete.open('POST', url, true);
      requete.onreadystatechange = function() {
        if (requete.readyState == 4) {
          document.getElementById('canvasloader-container').style.display = 'none';
          var tmp = requete.responseText.split('%☺%');
          var com = document.getElementById('com_js');
          var message = document.getElementById('resultats');
          if (tmp[0] != "") {
            form.reset();
            var div = document.createElement('div');
            div.innerHTML = tmp[0];
            com.parentNode.insertBefore(div, com);
            count_message++;
          }
          if (tmp[1] != "") {
            message.style.display = 'block';
            message.innerHTML = tmp[1];
          }
          else document.getElementById('bouton_submit').style.display = 'block';
        }
      };
      requete.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      var data = "nom="+nom+"&email="+email+"&site="+site+"&article="+article+"&message="+message+"&lang="+lang+"&count_message="+count_message+"&follow="+follow;
      requete.send(data);
    }
    </script>
    <div id="com_js"></div>
    <h2><?=$langage['form_titre'][$lang]?></h2>
      <form name="formulaire" id="formulaire" action="self" method="post" onsubmit="return false;">
      <div><label for="nom"><span class="requis">(*)</span> <?=$langage['nom'][$lang]?></label> <input type="text" name="nom" id="nom" placeholder="<?=$langage['pl_nom'][$lang]?>" required="" /></div>
      <div><label for="email"><span class="requis">(*)</span> <?=$langage['email'][$lang]?></label> <input type="text" name="email" id="email"  placeholder="<?=$langage['pl_email'][$lang]?>" required="" /></div>
      <div><label for="site"><?=$langage['site'][$lang]?></label> <input type="url" id="site" name="site" placeholder="<?=$langage['pl_site'][$lang]?>" /></div>
      <div><label for="message"><span class="requis">(*)</span> <?=$langage['message'][$lang]?></label> <textarea id="message" name="message" rows="4" placeholder="<?=$langage['pl_message'][$lang]?>" required="" ></textarea></div>
      <div><input type="checkbox" name="follow" id="follow" checked="" value="follow" /><label for="follow" id="labelBox"><?=$langage['follow'][$lang]?></label></div>
      <button id="bouton_submit" class="submit" onClick="envoi_ajax();document.getElementById('canvasloader-container').style.display = 'block';document.getElementById('bouton_submit').style.display = 'none';"><?=$langage['envoyer'][$lang]?></button>
      </form>
      <div id="canvasloader-container"></div>
    <script type="text/javascript">
    var cl = new CanvasLoader('canvasloader-container');
    cl.setColor('#0073d8'); // default is '#0099ff'
    cl.setDiameter(25); // default is 40
    cl.setDensity(50); // default is 40
    cl.setRange(1); // default is 1.3
    cl.setSpeed(1); // default is 2
    cl.setFPS(60); // default is 24
    cl.show(); // Hidden by default
    </script>
      <div id="resultats"></div>
    </div>
    <span class="requis"><?=$langage['requis'][$lang]?></span>
  </article>
  <a href="index.php?page=6&amp;lang=<?=$lang?>" onClick="menu();"><div class="art_link art_link_bot"><div class="arrow_back"></div> <?=$langage['titre'][$lang]?></div></a>
<?php
}
//Sinon on affiche tous les articles
else
{
  //On prépare les variables pour les afficher dans le header
  $page_titre = "Blog";
  $page_img = "articles/default.jpg";
  $page_desc = $langage['page_desc'][$lang];
  $page_keywords = "blog, articles, news, developement, Mozilla, Firefox,";
  //On inclue le header et le menu
  include("pages/header.php");
  include("pages/body.php");
  //On définit le nombre d'articles par page
  $nombreDeMessagesParPage = 3;
  //on commence par récupérer le nombre total d'articles
  $retour = mysql_query('SELECT COUNT(*) AS nb_articles FROM tc_articles');
  $donnees = mysql_fetch_array($retour);
  //ce nombre d'articles sera le total des messages pour l'ensemble des pages
  $totalDesMessages = $donnees['nb_articles'];
  //Si un numéro de page est présent dans l'url, on affichera cette page, sinon on affiche la page 1 par défaut
  if(isset($_GET['p'])) $page = intval($_GET['p']);
  else $page = 1;
  //On calcule le nombre de pages nécessaires
  $nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
  ?><div class="pages" id="pages"><?php
  //On affiche les liens de pages, en affichant spécialement la page actuelle
  for($i = 1 ; $i <= $nombreDePages ; $i++)
  {
    echo '<a href="index.php?page=6&amp;p='.$i.'" onClick="menu();">';
    echo '<div class=';
    if($page == $i) echo '"page_actuelle">'; else echo '"page">';
    echo $i.'</div></a>';
  }
  ?>
  </div>
  <div class="art_all">
  <?php
  //On définit le numéro du premier article à afficher en fonction du numéro de la page et du nombre d'articles à afficher par page
  $premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
  $requete_art = mysql_query('SELECT art_id, titre_'.$lang.', texte_'.$lang.', art_img, date FROM tc_articles ORDER BY date DESC LIMIT '.$premierMessageAafficher.', '.$nombreDeMessagesParPage);
  //On affiche les articles
  while($art = mysql_fetch_array($requete_art))
  { ?>
  <a href="index.php?page=6&amp;article=<?=$art['art_id']?>&amp;lang=<?=$lang?>" onClick="menu();">
  <article>
  <div class="article">
    <div class="art_img"><img src="img/articles/<?=$art['art_img']?>" alt="<?=$art['art_img']?>" /></div>
      <div class="art_titre">
        <?php echo utf8_encode($art['titre_'.$lang]); ?>
      </div>
    <div class="art_date"><?=$langage['date'][$lang]?> <?php echo utf8_encode(date_heure($art['date'], $lang)); ?></div>
    <div class="clear"></div>
    </div>
  </article>
  </a>
  <?php
  } ?>
  </div>
<?php
}
 ?>