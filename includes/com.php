<?php
header('Content-type: text/html; charset=utf-8');
include("fonctions.php");
include("../locales/articles.php");
connexionbdd();
$i=0;
$i_msg=0;
$separateur='%☺%';
$lang = mysqli_real_escape_string(utf8_decode($_POST['lang']));
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
  if(isset($_POST['g-recaptcha-response']))
    $captcha=$_POST['g-recaptcha-response'];

    if(!$captcha) {
        $i_msg++;
        $msg[$i_msg] = $langage['com_captcha_erreur'][$lang];
        $i++;
      exit;
    }
    $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . PRIVATE_KEY . "&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

    if($response['success'] == false) {
        $i_msg++;
        $msg[$i_msg] = "Recaptacha error.";
        $i++;
    }
  if($i == 0)
  {
    $mail = strtolower(mysqli_real_escape_string(utf8_decode($_POST['email'])));
    $nom = mysqli_real_escape_string(utf8_decode($_POST['nom']));
    $message = utf8_decode(mysqli_real_escape_string(stripslashes(nl2br(htmlspecialchars($_POST['message'])))));
    $follow = mysqli_real_escape_string(utf8_decode($_POST['follow']));
    $time = time();
    $art = intval($_POST['article']);
    $site = mysqli_real_escape_string(utf8_decode($_POST['site']));
    $count_message = intval($_POST['count_message']);
    mysqli_query('INSERT INTO tc_com(com_mail, com_nom, com_msg, com_art, com_date, com_lang)
    VALUES("'.$mail.'", "'.$nom.'", "'.$message.'", "'.$art.'", "'.$time.'", "'.$lang.'")');
    $id = mysqli_insert_id();
    if ($follow == "follow")
      $follow_bool = '1';
    else
      $follow_bool = '0';

    $requete_suivi = mysqli_query('SELECT email FROM tc_follow WHERE email = "'.$mail.'" AND article = '.$art);
    $suivi = mysqli_fetch_array($requete_suivi);
    if ($suivi)
      mysqli_query("UPDATE tc_follow SET follow = '".$follow_bool."' WHERE email = '".$mail."' AND article = ".$art);
    else {
      mysqli_query("INSERT INTO tc_follow (follow, email, article) VALUES ('".$follow_bool."', '".$mail."', '".$art."')");
      $requete_email_exists = mysqli_query("SELECT email FROM tc_keys WHERE email = '".$mail."'");
      
      if(!$requete_email_exists) {
        $caracteres = array("a", "b", "c", "d", "e", "f", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        shuffle($caracteres);
        $key = "";
        for($n=0; $n <= 15; $n++)
        {
          $key .= $caracteres[$n];
        }
        mysqli_query("INSERT INTO tc_keys (email, keygen) VALUES ('".$mail."', '".$key."')");
      }
    }
      
    if(isset($_POST['site']) && $_POST['site'] != "")
      mysqli_query('UPDATE tc_com SET com_site = "'.$site.'" WHERE com_id = '.$id);

    $req_com = mysqli_query('SELECT DISTINCT com_mail, com_lang, keygen FROM tc_com, tc_follow, tc_keys
    WHERE follow = 1 AND article = '.$art.' AND com_mail != "'.$mail.'"
    AND tc_follow.email = com_mail AND tc_follow.email = tc_keys.email');
    if($req_com)
    {
      while($com = mysqli_fetch_array($req_com))
      {
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
        <p>'.$langage['com_mail_unsubscribe'][$com_lang].' <a href="'.ROOTPATH.'/index.php?page=unsubscribe&amp;e='.$com['com_mail'].'&amp;a='.$art.'&amp;key='.$com['keygen'].'">'.ROOTPATH.'/index.php?page=unsubscribe&amp;e='.$com['com_mail'].'&amp;a='.$art.'&amp;key='.$com['keygen'].'</a></p>
        </body>
        </html>';
        $headers  = 'MIME-Version: 1.0' . $passage_ligne;
        $headers .= 'Content-type: text/html; charset=utf-8' . $passage_ligne;
        $headers .= 'From: "'.WEB_SERVER.'" <no-reply@'.WEB_SERVER.'>' . $passage_ligne;
        @mail($com['com_mail'], '=?UTF-8?B?'.base64_encode($subject).'?=', $mail_notif, $headers);
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
