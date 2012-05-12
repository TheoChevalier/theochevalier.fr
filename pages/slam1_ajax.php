<?php
set_time_limit(0);
include("../includes/image.php");
$service = mysqli_connect(NOM_SERVEUR, LOGIN, MOT_DE_PASSE, NOM_BD);
//Si on reçoit le code requete 1, on nous demande de retourner les familles
if(isset($_POST['requete']) && $_POST['requete'] == 1)
{
  //On retourne les fonctions javascript qui seront exécutées et qui ajoutent une première ligne dans
  //la combobox avec "Choisissez..." ...
  echo 'var o = null;'; 
  echo 'var s = document.forms["'.$_POST["form"].'"].elements["'.$_POST["select"].'"];'; 
  echo 's.options.length = 0;'; 
  echo 's.options[s.options.length] = new Option("Choisissez votre famille");';
  //... puis on récupère toutes les familles de l'ordre
  $requete = mysqli_prepare($service, "SELECT nom_famille FROM ppe_famille WHERE ordre = ?");
  mysqli_stmt_bind_param($requete, 's', $_POST["ordre"]);
  mysqli_stmt_execute($requete);
  mysqli_stmt_bind_result($requete, $famille);
  //... puis enfin on boucle pour ajouter les différentes lignes à la combobox
  while(mysqli_stmt_fetch($requete))
    echo 's.options[s.options.length] = new Option("'.$famille.'");';
//Si on reçoit le code requete = 2, on nous demande de retourner les espèces d'une famille
}elseif(isset($_POST['requete']) && $_POST['requete'] == 2)
{
  //On affiche la première ligne du tableau
  echo '<table><tr><th>Photo</th><th>Nom latin</th><th>Nom français</th></tr>';
  //On sélectionne les espèces en fonction de l'ordre et de la famille
  $requete = mysqli_prepare($service, "SELECT nom_latin, nom_francais, ppe_famille.nom_famille, ordre, image 
  FROM ppe_especes, ppe_famille 
  WHERE ordre = ? AND ppe_famille.nom_famille = ? AND ppe_especes.nom_famille = ppe_famille.nom_famille;");
  mysqli_stmt_bind_param($requete, 'ss', $_POST['ordre'], $_POST['famille']);
  mysqli_stmt_execute($requete);
  mysqli_stmt_bind_result($requete, $nla, $nfr, $nfam, $ord, $bool);
  while(mysqli_stmt_fetch($requete))
  {
    //On éfface la variable $chemin_ext sinon il contient la valeur de l'image précédente
    //et n'est pas mis à jour si il n'y a pas d'image pour l'espèce courante
    //ou si il n'y en avait pas et que l'on en trouve une.
    unset($chemin_ext);
    $nom = str_replace(' ', '+', $nla);
    //On retire l'espace à la fin de l'ordre s'il y en a un
    $ord = str_replace(' ','',$ord);
    //Définition du chemin d'enregistrement
    $dir = "../img/oiseaux/".strtolower($ord."/".$nfam);
    $chemin = $dir."/".strtolower(str_replace('+', '_', $nom));
    if($bool == NULL) //Si null: pas d'image
    {
      //Génération de la requête Google pour avoir les résultats pour l'espèce courante
      //Optimisation en faisant appel à Google Mobile à la place du Google classique qui renvoie plus de résultats
      //En plus dans les deux cas, il s'agit de la même image, à la même taille
      //imgtype=photo permet de filtrer les résultats pour n'afficher que les photos
      $code_source = file_get_contents("http://www.google.com/m/search?dc=gorganic&source=mobileproducts&site=images&q=".$nom."&imgtype=photo");
      //On isole la balise image
      $lien = preg_match_all("#<img(.*?)(src.*?)>#is",$code_source,$mat,PREG_PATTERN_ORDER) or die ();
      //Si la page a retourné au moins un résultat (or die() retourne 1 en cas d'erreur)
      if($lien > 1)
      {
        //On ne récupère que le lien
        preg_match('#src=\"(.*?)\"#i',$mat[2][1],$tr);
        //On retire src=
        $tr[0] = str_replace('src=','',$tr[0]);
        //On retire les "
        $tr[0] = str_replace('"','',$tr[0]);
        //Si le sous répertoire pour cet ordre n'existe pas, on le créé
        if(!file_exists("../img/oiseaux/".strtolower($ord)))
          mkdir("../img/oiseaux/".strtolower(utf8_decode($ord)));
        //Si le sous répertoire pour la famille dans le repertoire de l'odre n'existe pas, on le créé
        //(Je n'ai pas réussi à faire fonctionner le mkdir récurssif sous Windows...)
        if(!file_exists($dir))
          mkdir($dir);
        //Ouverture de l'image à partir du serveur Google
        $image_google = fopen($tr[0], 'r');
        //Copie de l'image dans le repertoire d'enregistrement
        file_put_contents($chemin, $image_google);
        //On prend les informations de l'image (On veut le type, c'est le paramètre 2)
        $type = getimagesize($chemin);
        //On ajoute l'extention au chemin
        $chemin_ext = $chemin.image_type_to_extension($type[2]);
        //on renomme le fichier avec le nouveau chemin
        rename($chemin, $chemin_ext);
        //Instanciation de l'objet Image
        $image = new Image($chemin_ext);
        $x = 100;
        $y = 100;
        //Récupération des informations du fichier
        $size = getimagesize($chemin_ext);
        //On choisi quel côté redimensionner, afin que le plus grand côté mesure 100px
        if($size[0] >= $size[1]) $y = ($size[1] * 100)/$size[0];
        else $x = ($size[0] * 100)/$size[1];
        //Utilisation des méthodes de l'objet Image pour redimensionner et enregistrer
        $image->resize_to($x, $y);
        $image->save_as($chemin_ext);
        //On a enregistré l'image, on sauvegarde son extention, ce qui signifira aussi que cet oiseau possède une image
        $bool = image_type_to_extension($type[2], false);
        //On ouvre une nouvelle connexion pour sauvegarder l'extention
        $service_u = mysqli_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe, $bd_nom_bd);
        $update = mysqli_prepare($service_u, "UPDATE ppe_especes SET image = ? WHERE nom_famille = ? AND nom_latin = ?;");
        mysqli_stmt_bind_param($update, 'sss', $bool, $nfam, $nla);
        mysqli_stmt_execute($update);
        mysqli_close($service_u);
      }
    }
    //Si on a une image
    if($bool != NULL)
    {
      //On retire ../ pour obtenir le chemin relatif correct à envoyer à la page (située à la racine)
      if(!isset($chemin_ext))$chemin_ext = str_replace('../','',$chemin).".".$bool;
      else $chemin_ext = str_replace('../','',$chemin_ext);
    }
    //Sinon on affiche l'image par défaut
    else $chemin_ext = 'img/oiseaux/default.jpg';
    //On affiche le résultat (la ligne du tableau)
    echo '<tr><td><img src="'.utf8_encode($chemin_ext).'" alt="'.utf8_encode($nla).'" /></td><td>'.utf8_encode($nla).'</td><td>'.utf8_encode($nfr).'</td></tr>';
  }
  echo '</table>';
}
elseif(isset($_GET['requete']) && $_GET['requete'] == 3)
{
  $auto = urldecode($_GET['s']).'%';
  $requete = mysqli_prepare($service, "SELECT nom_francais
  FROM ppe_especes WHERE nom_famille = ? AND nom_francais LIKE ? LIMIT 10;");
  mysqli_stmt_bind_param($requete, 'ss', $_GET['fam'], $auto);
  mysqli_stmt_execute($requete);
  mysqli_stmt_bind_result($requete, $nfr);
  while(mysqli_stmt_fetch($requete))
  {
    echo utf8_encode($nfr.'|');
  }
}
mysqli_close($service);
?>