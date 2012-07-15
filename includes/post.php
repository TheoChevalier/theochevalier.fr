<?php
$passage_ligne = "\n";
$to = 'contact@theochevalier.fr';
$subject = 'Message de '.htmlspecialchars($_POST["nom"], ENT_QUOTES).' à partir de www.theochevalier.fr' . $passage_ligne;
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
$headers .= 'From: "Théo Chevalier" <contact@theochevalier.fr>' . $passage_ligne;
$headers .= 'Reply-To: "'.stripslashes(htmlspecialchars($_POST["nom"], ENT_QUOTES)).'"<'.stripslashes(htmlspecialchars($_POST["email"], ENT_QUOTES)).'>' . $passage_ligne;

mail($to, $subject, $mail, $headers);
echo "Votre message a été envoyé à Théo Chevalier.";
 ?>