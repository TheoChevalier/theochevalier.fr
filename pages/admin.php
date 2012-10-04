<?php
if(isset($_POST['mot_de_passe']) && $_POST['mot_de_passe'] == PASSWD_RSS)
{
  update_sitemap();
  $req_categories = mysql_query("SELECT categorie_id, libelle, lang FROM tc_categorie_nom");
  while($categories = mysql_fetch_array($req_categories)) {
    update_rss($categories['categorie_id'], $categories['libelle'], $categories['lang']);
  }
  // Defaul RSS containing everything
  update_rss(0, "all", "fr");
  update_rss(0, "all", "en");

include("pages/header.php");
include("pages/body.php");
?>
<article id="creations">
  <div class="texte">
    Mise à jour des flux RSS effectuée avec succès.
  </div>
</article>
<?php
 }else{ 
include("pages/header.php");
include("pages/body.php");?>
 <article id="creations">
 <div class="texte">
 <form method="post" action="">
  <p><label for="mot_de_passe">Mot de passe :</label><input type="password" id="mot_de_passe" name="mot_de_passe" /></p>
    <button type="submit">Envoyer</button>
 </form>
 </div>
 </article>
 <?php } ?>
