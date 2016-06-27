<?php
include("locales/sitemap.php");
$page_titre = $langage['titre'][$lang];
$page_desc= $langage['page_desc'][$lang];
include("pages/header.php");
include("pages/body.php"); ?>
<div class="titre"><?=$langage['titre'][$lang]?></div>
<article id="creations">
<div class="texte">
<?php
$languages = array("fr", "en");
foreach ($languages as $language)
{ 
if($language == "fr") echo "<h1>Pages en français</h1>";
else echo "<h1>Pages in english</h1>";
?>
  <ul>
    <li><a href="index.php?lang=<?=$language?>"><?=$langage['home'][$language]?></a></li>
    <li><a href="index.php?page=6&amp;lang=<?=$language?>"><?=$langage['blog'][$language]?></a>
      <ul>
        <?php 
        $requete_art = mysqli_query("SELECT art_id, titre_".$language.", date FROM tc_articles ORDER BY date");
        while($art = mysqli_fetch_array($requete_art))
          echo '<li><a href="index.php?page=6&amp;article='.$art['art_id'].'&amp;lang='.$language.'">'.utf8_encode($art['titre_'.$language]).'</a></li>';
        ?>
      </ul>
    </li>
    <li><a href="index.php?page=2&amp;lang=<?=$language?>"><?=$langage['projects'][$language]?></a></li>
    <li><a href="index.php?page=5&amp;lang=<?=$language?>"><?=$langage['resume'][$language]?></a></li>
    <li><a href="index.php?page=4&amp;lang=<?=$language?>"><?=$langage['contact'][$language]?></a></li>
    <li><a href="index.php?page=sitemap&amp;lang=<?=$language?>"><?=$langage['titre'][$language]?></a></li>
  </ul>
<?php } ?>
</div>
</article>