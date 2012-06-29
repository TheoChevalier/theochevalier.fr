<?php
header('Content-type: text/html; charset=utf-8');
include("fonctions.php");
include("../locales/articles.php");
connexionbdd();
$i=0;
$i_msg=0;
$separateur='%☺%';
$lang = mysql_real_escape_string(utf8_decode($_POST['lang']));
if($lang == 'fr'){
  setlocale(LC_TIME, 'fr_FR');
  date_default_timezone_set('Europe/Paris');
}else
{
  setlocale(LC_TIME, 'en_US');
  date_default_timezone_set('America/Los_Angeles');
}
if(isset($_POST['nom']) && $_POST['nom'] !="" && isset($_POST['email']) && $_POST['email'] !="" && isset($_POST['message']) && $_POST['message'] !="")
{
  if(!preg_match("^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$^", $_POST['email']))
  {
    $i_msg++;
    $msg[$i_msg] = $langage['mail_erreur'][$lang];
    $i++;
  }
  if(!preg_match("/^.{2,100}$/i", $_POST['nom']))
  {
    $i_msg++;
    $msg[$i_msg] = $langage['com_nom_erreur'][$lang];
    $i++;
  }
  if(isset($_POST['site']) && !empty($_POST['site']))
  {
    $regex = "(https?\:\/\/)?"; // SCHEME
    $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass
    $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP
    $regex .= "(\:[0-9]{2,5})?"; // Port
    $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path
    $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
    $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor
    if(!preg_match("/^$regex$/", utf8_decode($_POST['site'])))
    {
      $i_msg++;
      $msg[$i_msg] = $langage['com_url_erreur'][$lang];
      $i++;
    }
  }
  if($i == 0)
  {
    $mail = strtolower(mysql_real_escape_string(utf8_decode($_POST['email'])));
    $nom = mysql_real_escape_string(utf8_decode($_POST['nom']));
    $message = utf8_decode(mysql_real_escape_string(stripslashes(nl2br(htmlspecialchars($_POST['message'])))));
    $follow = mysql_real_escape_string(utf8_decode($_POST['follow']));
    $time = time();
    $art = intval($_POST['article']);
    $site = mysql_real_escape_string(utf8_decode($_POST['site']));
    $count_message = intval($_POST['count_message']);
    mysql_query('INSERT INTO tc_com(com_mail, com_nom, com_msg, com_art, com_date, com_lang)
    VALUES("'.$mail.'", "'.$nom.'", "'.$message.'", "'.$art.'", "'.$time.'", "'.$lang.'")');
    $id = mysql_insert_id();
    if ($follow == "follow")
      $follow_bool = '1';
    else
      $follow_bool = '0';

    $requete_suivi = mysql_query('SELECT email FROM tc_follow WHERE email = "'.$mail.'" AND article = '.$art);
    $suivi = mysql_fetch_array($requete_suivi);
    if ($suivi)
      mysql_query("UPDATE tc_follow SET follow = '".$follow_bool."' WHERE email = '".$mail."' AND article = ".$art);
    else
      mysql_query("INSERT INTO tc_follow (follow, email, article) VALUES ('".$follow_bool."', '".$mail."', '".$art."')");
      
    if(isset($_POST['site']) && $_POST['site'] != "")
      mysql_query('UPDATE tc_com SET com_site = "'.$site.'" WHERE com_id = '.$id);

    $req_com = mysql_query('SELECT DISTINCT com_mail, com_lang, follow FROM tc_com, tc_follow WHERE com_art = '.$art.' AND com_mail != "'.$mail.'"
    AND email = com_mail');
    if($req_com)
    {
      while($com = mysql_fetch_array($req_com))
      {
        if($com['follow'] == 1) {
          $com_lang = $com['com_lang'];
          if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $com['com_mail']))
            $passage_ligne = "\r\n";
          else
            $passage_ligne = "\n";
          $subject = $langage['com_mail_1'][$com_lang].utf8_encode($nom).$passage_ligne;
          $mail_notif = '<html>
          <head>
          <title>'.$langage['com_mail_1'][$com_lang].utf8_encode($nom).'</title>
          </head>
          <body>
          <p>'.utf8_encode($nom).$langage['com_mail_2'][$com_lang].'<br />
          <a href="'.ROOTPATH.'/index.php?page=6&amp;article='.$art.'#c'.$id.'">'.ROOTPATH.'/index.php?page=6&amp;article='.$art.'#c'.$id.'</a></p>
          <p>'.$langage['com_mail_auto'][$com_lang].'</p>
          </body>
          </html>';
          $headers  = 'MIME-Version: 1.0' . $passage_ligne;
          $headers .= 'Content-type: text/html; charset=utf-8' . $passage_ligne;
          $headers .= 'From: "'.WEB_SERVER.'" <no-reply@'.WEB_SERVER.'>' . $passage_ligne;
          @mail($com['com_mail'], '=?UTF-8?B?'.base64_encode($subject).'?=', $mail_notif, $headers);
        }
      }
    }
    $passage_ligne = "\n";
    $subject = $langage['com_mail_1'][$lang].utf8_encode($nom).$passage_ligne;
    $mail_notif = '<html>
    <head>
    <title>'.$langage['com_mail_1'][$lang].utf8_encode($nom).'</title>
    </head>
    <body>
    <p>'.utf8_encode($nom).' a laissé un nouveau message sur l\'article '.$art.'.</p>
    </body>
    </html>';
    $headers  = 'MIME-Version: 1.0' . $passage_ligne;
    $headers .= 'Content-type: text/html; charset=utf-8' . $passage_ligne;
    $headers .= 'From: "'.NAME.'" <no-reply@'.WEB_SERVER.'>' . $passage_ligne;
    $i_msg++;
    if(!@mail(EMAIL, '=?UTF-8?B?'.base64_encode($subject).'?=', $mail_notif, $headers))
      $msg[$i_msg] =  $langage['message_erreur_mail'][$lang];
    else 
      $msg[$i_msg] = $langage['com_ok'][$lang];

    $count_message++;
    echo addslashes(html_entity_decode(add_com($count_message,$id,$mail,$site,$nom,$time,$message,$lang)));
  }
}
else
{
  $i_msg++;
  $msg[$i_msg] = $langage['com_champs'][$lang];
}
echo $separateur;
if($i_msg > 0)
{
  for($i = 1; $i <= $i_msg;$i++)
  {
    if($i > 1) echo "<br/>";
    echo $msg[$i];
  }
}
echo '<button id="bouton_ok" class="submit" onClick="document.getElementById(\'resultats\').style.display = \'none\';document.getElementById(\'bouton_submit\').style.display = \'block\';">OK</button>';