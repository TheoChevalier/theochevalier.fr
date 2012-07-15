<?php
include("locales/contact.php");
$page_titre = "Contact";
$page_desc = $langage['informations'][$lang];
include("pages/header.php");
include("pages/body.php");
if(isset($_POST["nom"]) && !empty($_POST["nom"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["message"]) && !empty($_POST["message"]))
{
  $passage_ligne = "\n";
  $to = EMAIL;
  $subject = 'Message de '.htmlspecialchars($_POST["nom"], ENT_QUOTES).' à partir de '.WEB_SERVER . $passage_ligne;
  $mail = '<html>
  <head>
  <title>Message de '.htmlspecialchars($_POST["nom"], ENT_QUOTES).'</title>

  </head>
  <body>
  '.stripslashes(htmlspecialchars($_POST["message"], ENT_QUOTES)).'
  </body>
  </html>' . $passage_ligne;

  $headers  = 'MIME-Version: 1.0' . $passage_ligne;
  $headers .= 'Content-type: text/html; charset=utf-8' . $passage_ligne;
  $headers .= 'From: "'.stripslashes(htmlspecialchars($_POST["nom"], ENT_QUOTES)).'"<'.stripslashes(htmlspecialchars($_POST["email"], ENT_QUOTES)).'>' . $passage_ligne;
  $headers .= 'Reply-To: "'.stripslashes(htmlspecialchars($_POST["nom"], ENT_QUOTES)).'"<'.stripslashes(htmlspecialchars($_POST["email"], ENT_QUOTES)).'>' . $passage_ligne;

  if(!@mail($to, $subject, $mail, $headers))
    $resultat =  $langage['message_erreur_mail'][$lang];
  else 
    $resultat = $langage['message_ok'][$lang];
}
else if(isset($_POST["verif"]) && $_POST["verif"] == '1')
  $resultat = $langage['message_erreur'][$lang];
?>

  <article id="contact">
    <div class="titre"><?=$langage['titre'][$lang]?></div>
    <div class="cadre_titre"></div>
    <div class="texte">
    <p><?=$langage['informations'][$lang]?></p><br />
    <?php if(isset($resultat)) echo '<div class="warning">'.$resultat.'</div>'; ?>
        <form method="post" action="index.php?page=4" name="formulaire" id="form_contact">
      <div><label for="nom"><?=$langage['nom'][$lang]?></label> <input type="text" name="nom" id="nom" required=""/></div>
      <div><label for="email"><?=$langage['email'][$lang]?></label> <input type="text" name="email" id="email"  required=""/></div>
      <div><label for="message"><?=$langage['message'][$lang]?></label> <textarea id="message" name="message" rows="4" required=""></textarea></div>
      <input type="hidden" name="verif" id="verif" value="1" />
      <button class="submit submit_contact" type="submit" ><?=$langage['envoyer'][$lang]?></button>
      </form>
      <p><?=$langage['phone'][$lang]?></p>
      
    </div>
  </article>
