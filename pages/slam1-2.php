<?php
set_time_limit(0);
$page_titre ="TP 2 PHP - Import d'images";
include("pages/header.php");
include("pages/body.php");
include("includes/image.php");
$service = mysqli_connect(NOM_SERVEUR, LOGIN, MOT_DE_PASSE, NOM_BD);
$requete = mysqli_prepare($service, "SELECT nom_latin, ppe_famille.nom_famille, ordre, image FROM ppe_especes, ppe_famille WHERE ppe_especes.nom_famille = ppe_famille.nom_famille");
mysqli_stmt_execute($requete);
mysqli_stmt_bind_result($requete, $nla, $nfam, $ord, $bool);
while(mysqli_stmt_fetch($requete)) {
	if($bool == NULL)
	{
		$nom = str_replace(' ', '+', $nla);
		//$code_source = file_get_contents("http://www.google.com/search?tbm=isch&q=Abeillia+abeillei&tbs=itp:photo");
		$code_source = file_get_contents("http://www.google.com/m/search?dc=gorganic&source=mobileproducts&site=images&q=".$nom."&imgtype=photo");
		//On isole la balise image
		$lien = preg_match_all("#<img(.*?)(src.*?)>#is",$code_source,$mat,PREG_PATTERN_ORDER) or die ();
		//Si la page a retourné au moins un résultat
		if($lien != 1)
		{
			//On ne récupère que le lien
			preg_match('#src=\"(.*?)\"#i',$mat[2][1],$tr);
			//On retire src=
			$tr[0] = str_replace('src=','',$tr[0]);
			//On retire les "
			$tr[0] = str_replace('"','',$tr[0]);
			//On retire l'espace à la fin de l'ordre
			$ord = str_replace(' ','',$ord);
			//Définition du chemin d'enregistrement
			$dir = "img/oiseaux/".strtolower($ord."/".$nfam."/");
			$chemin = $dir.strtolower(str_replace('+', '_', $nom));
			if(!is_dir("img/oiseaux/".strtolower($ord)."/"))
				mkdir("img/oiseaux/".strtolower($ord)."/");
			if(!is_dir($dir))
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
			$service_u = mysqli_connect(NOM_SERVEUR, LOGIN, MOT_DE_PASSE, NOM_BD);
			$update = mysqli_prepare($service_u, "UPDATE ppe_especes SET image = ? WHERE nom_famille = ? AND nom_latin = ?;");
			mysqli_stmt_bind_param($update, 'sss', image_type_to_extension($type[2], false), $nfam, $nla);
			mysqli_stmt_execute($update);
			mysqli_close($service_u);
		}
	}
}
mysqli_close($service);
?>