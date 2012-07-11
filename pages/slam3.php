<?php
$page_titre ="TP PHP - BDD oiseaux";
include("pages/header.php");
include("pages/body.php");
$bd_nom_serveur='localhost';
$bd_login='root';
$bd_mot_de_passe='';
$bd_nom_bd='oiseaux';

$service = mysqli_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe, $bd_nom_bd);

?>
<style>
td, th{padding: 10px;border:1px solid #fff;}
table{margin-left:auto;margin-right:auto;border:1px solid #fff;}
#loading{display:none;margin-left:220px;text-align:left;}
#canvasloader-container{display:inline-block;text-align:left;}
</style>
<div class="titre">
	<h1><?=$page_titre?></h1> 
</div>
<div class="cadre_titre"></div>
<div class="texte">
<form name="formulaire" method="post" action="">
<p>
	<script src="js/libs/canvasloader.min.js"></script>
	<script type="text/javascript">
	//Requête pour initialiser l'objet XHR en fonction du navigateur
	function creerRequete() {
		try {
		requete = new XMLHttpRequest();
		}
		catch (microsoft) {
			try {
			requete = new ActiveXObject('Msxml2.XMLHTTP');
			} catch(autremicrosoft) {
				try {
				requete = new ActiveXObject('Microsoft.XMLHTTP');
				} catch(echec) {
				requete = null;
				}
			}
		}
		if(requete == null) {
		alert('Votre navigateur ne supporte pas les requêtes XHR...');
		}
	}
	//Fonction pour envoyer l'ordre et recevoir les familles
	function envoi_ordre(f)
	{
		//Instanciation de la requête XHR
		creerRequete();
		//f est le formulaire qui contient la combobox, passé en paramètres
		var ordre = f.elements["ordre"];
		var famille = f.elements["famille"];
		//url du script à qui envoyer
		var url = 'pages/slam3_ajax.php';
		//Numéro de la ligne sélectionnée dans la CB
		var index = ordre.selectedIndex;
		//On empêche les cas négatifs
		if(index < 1)
			famille.options.length = 0;
		else {
			//On initialise la connexion, et on définit le mode d'envoi (POST)
			requete.open('POST', url, true);
			//On regarde quand la connexion change d'état (reception d'une réponse)
			requete.onreadystatechange = function anonymous() {
			//Si l'état de la connexion est 4 (réponse reçue)
			if(this.readyState == 4) { 
			//On affiche l'élément contenant la CB des familles
			document.getElementById('p_famille').hidden = false;
			//On exécute les instruction JS contenues dans la réponse (voir slam1_ajax.php)
			eval(this.responseText);
			}
			};
			//Définition du type de contenu qui sera envoyé (en-tête)
			requete.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			//Création de la requête à envoyer au script
			var data = "ordre="+escape(ordre.options[index].value)+"&form="+f.name+"&select=famille&requete=1"; 
			//On envoie ces données
			requete.send(data);
		}
	}
	//Fonction pour envoyer la famille et recevoir les espèces
	function envoi_famille(f)
	{
		//Instanciation de la requête XHR
		creerRequete();
		//f est le formulaire qui contient la combobox, passé en paramètres
		var ordre = f.elements["ordre"];
		var famille = f.elements["famille"];
		//url du script à qui envoyer
		var url = 'pages/slam1_ajax.php';
		//Numéros des lignes sélectionnées dans les deux CB
		var indexf = famille.selectedIndex;
		var indexo = ordre.selectedIndex;
		//On empêche les cas négatifs
		if(indexf < 1)
			famille.options.length = 0;
		else {
			//On initialise la connexion, et on définit le mode d'envoi (POST)
			requete.open('POST', url, true);
			//On regarde quand la connexion change d'état (reception d'une réponse)
			requete.onreadystatechange = function anonymous() {
			//Si l'état de la connexion est 4 (réponse reçue)
			if(this.readyState == 4) { 
			//On cache l'élement contenant le loader ("chargement ...") qui utilise canvas
			document.getElementById('loading').style.display = 'none';
			//On affiche la div où l'on va mettre le tableau des résultats
			document.getElementById('result').hidden = false;
			//On met tout le texte reçu de la réponse dans cette div
			document.getElementById('result').innerHTML = this.responseText;
			}
			};
			//Définition du type de contenu qui sera envoyé (en-tête)
			requete.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			//Création de la requête à envoyer au script(on envoie les deux valeurs sélectionnées dans les CB, et le code requête -voir slam1_ajax.php-)
			var data = "ordre="+escape(ordre.options[indexo].value)+"&famille="+escape(famille.options[indexf].value)+"&requete=2"; 
			//On envoie ces données
			requete.send(data);
		}
	}
	</script>
	<label for="ordre">Ordre :</label>
	<select id="ordre" name="ordre" size="1" onchange="envoi_ordre(this.form);
	document.getElementById('result').hidden = true;
	document.getElementById('p_famille').hidden = true;">
		<option></option>
		<?php
		//On génère les ordres avec une requête SQL
		$requete_ordre = mysqli_query($service, "SELECT * FROM ppe_ordre");
		while($ordre = mysqli_fetch_array($requete_ordre))
		{
			echo "<option value='".$ordre['ordre']."'>";
			echo $ordre['ordre']."</option>\n\r";
		}
		?>
	</select>
</p>
<p id="p_famille" hidden="true">
	<label for="famille">Famille :</label>
	<select id="famille" name="famille" size="1" onchange="envoi_famille(this.form);
	document.getElementById('loading').style.display = 'inline-block';
	document.getElementById('result').hidden = true;" >
		<option></option>
	</select>
</p>
<p>
	<label for="auto">Autocompletion :</label>
	<input id="auto" type="text" autocomplete="off" />
	<div id="results"></div>
</p>
</form>
<div id="loading"><div id="canvasloader-container"></div><span>Chargement en cours ...</span></div>
<script type="text/javascript">
var cl = new CanvasLoader('canvasloader-container');
cl.setColor('#ffffff'); // default is '#0099ff'
cl.setDiameter(25); // default is 40
cl.setDensity(50); // default is 40
cl.setRange(1); // default is 1.3
cl.setSpeed(1); // default is 2
cl.setFPS(60); // default is 24
cl.show(); // Hidden by default
</script>
<div id="result"></div>
</div>