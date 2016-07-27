<?php
include("locales/unsubscribe.php");
$page_titre = utf8_encode($art['titre_'.$lang]);
// Header & menu
include("pages/header.php");
include("pages/body.php");

// Check the key
if(isset($_GET['key']) && !empty($_GET['key'])) {
  $_GET['key'] = mysqli_real_escape_string($_GET['key']);
  
  if(preg_match("#^[a-f0-9]{16}$#", strtolower($_GET['key']))) {
    
    // Check the email
    if(isset($_GET['e']) && !empty($_GET['e'])) {
      $_GET['e'] = mysqli_real_escape_string($_GET['e']);
       // Check the article
      if(isset($_GET['a']) && !empty($_GET['a'])) {
        $_GET['a'] = mysqli_real_escape_string($_GET['a']);     
        $requete_email_art = mysqli_query("SELECT count(*) as verif FROM tc_follow WHERE email = '".$_GET['e']."' AND article = '".$_GET['a']."'");
        $email_art = mysqli_fetch_array($requete_email_art);
        if ($email_art['verif'] > 0) {
          $requete_key = mysqli_query("SELECT keygen FROM tc_keys WHERE email = '".$_GET['e']."'");
          $key = mysqli_fetch_array($requete_key);
          if($key['keygen'] == $_GET['key']) {
            mysqli_query("UPDATE tc_follow SET follow = 0 WHERE email = '".$_GET['e']."' AND article = '".$_GET['a']."'");
            echo '<div class="warning">'.$langage['unsub_ok'][$lang].'</div>';
          } else
            echo '<div class="warning">'.$langage['unsub_no_match_key'][$lang].'</div>';
        } else
          echo '<div class="warning">'.$langage['unsub_bad_email'][$lang].'</div>';
      } else
        echo '<div class="warning">'.$langage['unsub_no_article'][$lang].'</div>';
    } else
      echo '<div class="warning">'.$langage['unsub_no_email'][$lang].'</div>';
  } else
    echo '<div class="warning">'.$langage['unsub_bad_key'][$lang].'</div>';
} else
  echo '<div class="warning">'.$langage['unsub_no_key'][$lang].'</div>';
