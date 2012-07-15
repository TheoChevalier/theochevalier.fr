<?php
if(isset($_POST['mot_de_passe']) && $_POST['mot_de_passe'] == "updateflux")
{
if(isset($_POST['rss']) && $_POST['rss'] != "")
if($_POST['rss'] == 'sitemap')
  update_sitemap();
else
  update_rss($_POST['rss']);

include("pages/header.php");
include("pages/body.php");
?>
<article id="creations">
<div class="texte">
<form method="post" action="">
  <label for="rss">RSS à mettre à jour :</label>
  <select id="rss" name="rss" size="1" onchange="this.form.submit();" >
    <option value="">--</option>
    <option value="fr">Français</option>
    <option value="en">Anglais</option>
    <option value="sitemap">Sitemap</option>
  </select>
  
  <input type="hidden" name="mot_de_passe" value="<?php if(isset($_POST['mot_de_passe'])) echo $_POST['mot_de_passe']; ?>" />
 </form>
 <?=date(DATE_ATOM, time())?>
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