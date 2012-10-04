<?php
include("connexion.php");
function connexionbdd()
{
  mysql_connect(NOM_SERVEUR, LOGIN, MOT_DE_PASSE);
  mysql_select_db(NOM_BD);
}
function formater_date($date_bdd)
{
  $date_annee = substr($date_bdd, 0, 4);
  $date_mois = substr($date_bdd, 8, 2);
  $date_jour = substr($date_bdd, 5, 2);
  $timestamp = mktime( 0, 0, 0, $date_jour , $date_mois , $date_annee);
  $date = strftime( "%d %B %Y" , $timestamp);
  return $date;
}
function age($naiss) {
  list($annee, $mois, $jour) = explode('-', $naiss);
  $today['mois'] = date('n');
  $today['jour'] = date('j');
  $today['annee'] = date('Y');
  $annees = $today['annee'] - $annee;
  if ($today['mois'] <= $mois) {
    if ($mois == $today['mois']) {
      if ($jour > $today['jour'])
        $annees--;
      }
    else
      $annees--;
    }
  echo $annees;
}
function date_heure($timestamp_bdd, $lang)
{
  if($lang == "en") $date = strftime("%B, %d %Y, at %I:%M %p" , $timestamp_bdd);
  else $date = strftime("%d %B %Y, &agrave; %Hh%M" , $timestamp_bdd);
  return $date;
}
function add_com($i,$id,$mail,$site,$nom,$date,$message,$lang)
{
echo '<div class="com_msg" id="c'.$id.'">
  <div class="gravatar">
  <img src="http://www.gravatar.com/avatar/'.md5($mail).'?d=mm"/>
  </div>
  <div class="com_right">';
 if($site != "http://" && $site != NULL)
echo '<a href="'.utf8_encode($site).'" target="_blank">
    <div class="com_nom">'.utf8_encode($nom).'</div></a>';
else echo '<div class="com_nom">'.utf8_encode($nom).'</div>';
echo '<div class="com_date">&nbsp; '.utf8_encode(date_heure($date, $lang)).' <a href="#c'.$id.'">#'.$i.'</a></div>
  <div class="com">'.utf8_encode($message).'</div>
  </div>
</div>
<div class="clear"></div>';
}

function update_rss($id, $categorie, $lang)
{
  $debut_fichier ='<?xml version="1.0" encoding="utf-8"?>
  <feed xmlns="http://www.w3.org/2005/Atom">
   <title>'.NAME.'</title>
   <subtitle>Site personnel de '.NAME.'</subtitle>
   <link href="'.ROOTPATH.'/'.$lang.'_rss.xml" rel="self" type="application/atom+xml"/>
   <updated>'.date(DATE_ATOM, time()).'</updated>
   <author>
     <name>'.NAME.'</name>
     <email>'.EMAIL.'</email>
   </author>
   <id>'.ROOTPATH.'/'.$lang.'_rss.xml</id>';
  $fin_fichier = '</feed>';
  if ($categorie != "all")
    $requete = mysql_query("SELECT art_id, titre_".$lang.", date, date_update_".$lang.", texte_".$lang.", art_img FROM tc_articles
    WHERE art_id IN (SELECT art_id FROM tc_categorie WHERE categorie = ".$id.")");
  else
     $requete = mysql_query("SELECT art_id, titre_".$lang.", date, date_update_".$lang.", texte_".$lang.", art_img FROM tc_articles");

  $num = mysql_num_rows($requete);
  $items ='';
  while($news = mysql_fetch_array($requete))
  {
    $titre = utf8_encode(str_replace("&", "&amp;", $news['titre_'.$lang]));
    $lien = ROOTPATH.'/index.php?page=6&amp;article='.$news['art_id'].'&amp;lang='.$lang;
    $description = utf8_encode('<![CDATA[<img src="'.ROOTPATH.'/img/articles_big/'.$news['art_img'].'" alt="" />'.str_replace("<br />", "<br/>", $news['texte_'.$lang]).']]>');
    if ($news['date_update_'.$lang] == "") $news['date_update_'.$lang] = $news['date'];
    $items = $items.'
    
      <entry>
        <author>
          <name>'.NAME.'</name>
        </author>
        <title>'.$titre.'</title>
        <link href="'.$lien.'" />
        <id>'.$lien.'</id>
        <summary type="html">'.$description.'</summary>
        <published>'.date(DATE_ATOM, $news['date']).'</published>
        <updated>'.date(DATE_ATOM, $news['date_update_'.$lang]).'</updated>
      </entry>';
  }
  $rss = $debut_fichier.$items.$fin_fichier;
  if($num != 0)
    file_put_contents ("rss/".$categorie."_".$lang.".xml", $rss);
}
function update_sitemap() {
$head ='<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$links = "";
$languages = array("fr", "en");
foreach ($languages as $language)
{
  $links .= '
  
  <url><loc>
  '.ROOTPATH.'/index.php?lang='.$language.'
  </loc></url>
  <url><loc>
  '.ROOTPATH.'/index.php?page=6&amp;lang='.$language.'
  </loc></url>
  ';
  $requete_art = mysql_query("SELECT art_id, titre_".$language.", date FROM tc_articles ORDER BY date");
  while($art = mysql_fetch_array($requete_art))
    $links .= '<url><loc>'.ROOTPATH.'/index.php?page=6&amp;article='.$art['art_id'].'&amp;lang='.$language.'</loc></url>';

  $links .= '
  <url><loc>
  '.ROOTPATH.'/index.php?page=2&amp;lang='.$language.'
  </loc></url>
  <url><loc>
  '.ROOTPATH.'/index.php?page=5&amp;lang='.$language.'
  </loc></url>
  <url><loc>
  '.ROOTPATH.'/index.php?page=4&amp;lang='.$language.'
  </loc></url>
  <url><loc>
  '.ROOTPATH.'/index.php?page=sitemap&amp;lang='.$language.'
  </loc></url>';
}
$eof ='</urlset>';
$sitemap = $head.$links.$eof;
file_put_contents ("sitemap.xml", $sitemap);
}
function parse($text) {
  $text = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0" target="_blank">$0</a>', $text);
  $text = preg_replace('#@([a-z0-9_]+)#i', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $text);
  $text = preg_replace('# \#([a-z0-9_-]+)#i', ' <a href="http://search.twitter.com/search?q=%23$1" target="_blank">#$1</a>', $text);
  return $text;
}
?>
