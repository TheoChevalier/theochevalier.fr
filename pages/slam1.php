<?php
$page_titre ="TP PHP - BDD oiseaux";
include("pages/header.php");
include("pages/body.php");
$service = mysqli_connect(NOM_SERVEUR, LOGIN, MOT_DE_PASSE, NOM_BD2);

?>
<style>
td, th{padding: 10px;border:1px solid #333;}
table{margin-left:auto;margin-right:auto;border:1px solid #333;}
#loading{display:none;margin-left:220px;text-align:left;}
#canvasloader-container{display:inline-block;text-align:left;}
#results > div{ margin: 0; background-color:#fff; color: #000;text-shadow: none;border: none;padding: 0 5px;
  -moz-transition-duration: .1s;
  -webkit-transition-duration: .1s;
  -o-transition-duration: .1s;
  transition-duration: .1s; }
.result_focus, #results > div:hover{background-color:#333!important; color: #fff!important;}
#results {box-shadow: 0 0 3px #333;max-width: 300px;cursor:pointer;margin-left: 1px;}
input, input:focus, select, select:focus, textarea {background-color:#fff;}
input[type="text"]{width: 290px;}

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
    var url = 'pages/slam1_ajax.php';
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
      if(document.getElementById('modifsup') != null)
      document.getElementById('modifsup').hidden = true;
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
      document.getElementById('search').hidden = false;
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
    $requete_ordre = mysqli_prepare($service, "SELECT * FROM ppe_ordre");
    mysqli_stmt_execute($requete_ordre);
    mysqli_stmt_bind_result($requete_ordre, $ordre);
    while(mysqli_stmt_fetch($requete_ordre))
    {
      echo "<option value='".$ordre."'>";
      echo $ordre."</option>\n\r";
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
</form>
<?php
if(isset($_POST['n_fr_h']))
{
  if(isset($_POST['keep_img'])) $img = $_POST['keep_img'];
  else $img = 'NULL';
  echo "image:".$img;
  $n_fr = utf8_decode($_POST['n_fr']);
  $requete = mysqli_prepare($service, "UPDATE ppe_especes SET nom_latin = ?, nom_francais = ?, nom_famille = ?, image = ?
  WHERE nom_francais = ?;");
  mysqli_stmt_bind_param($requete, 'sssss', $_POST['n_ln'], $n_fr, $_POST['n_fm'], $img, $_POST['n_fr_h']);
  mysqli_stmt_execute($requete);
  
}
else{
  if(isset($_POST['search']) && $_POST['search'] != "")
  {
    $nom_fr = utf8_decode($_POST['search']);
    $requete = mysqli_prepare($service, "SELECT COUNT(*)
    FROM ppe_especes WHERE nom_francais = ?;");
    mysqli_stmt_bind_param($requete, 's', $nom_fr);
    mysqli_stmt_execute($requete);
    mysqli_stmt_bind_result($requete, $nb);
    mysqli_stmt_fetch($requete);
    mysqli_close($service);
    if($nb > 0)
    {
      $service = mysqli_connect(NOM_SERVEUR, LOGIN, MOT_DE_PASSE, NOM_BD2);
      $requete_2 = mysqli_prepare($service, "SELECT *
      FROM ppe_especes WHERE nom_francais = ?;");
      mysqli_stmt_bind_param($requete_2, 's', $nom_fr);
      mysqli_stmt_execute($requete_2);
      mysqli_stmt_bind_result($requete_2, $nln, $nfr, $nfm, $img);
      mysqli_stmt_fetch($requete_2);
      mysqli_close($service);
      $service = mysqli_connect(NOM_SERVEUR, LOGIN, MOT_DE_PASSE, NOM_BD2);
      $requete_ordre = mysqli_prepare($service, "SELECT ordre
      FROM ppe_famille WHERE nom_famille = ?;");
      mysqli_stmt_bind_param($requete_ordre, 's', $nfm);
      mysqli_stmt_execute($requete_ordre);
      mysqli_stmt_bind_result($requete_ordre, $ord);
      mysqli_stmt_fetch($requete_ordre);
  ?>
<form id="modifsup" name="modifsup" action="" method="post">
  <p>
    <label for="n_fr">Nom français:</label> <input type="text" id="n_fr" name="n_fr" value="<?php echo utf8_encode($nfr); ?>" required="" />
    <input type="hidden" id="n_fr_h" name="n_fr_h" value="<?php echo utf8_encode($nfr); ?>" />
  </p>
  <p>
    <label for="n_ln">Nom latin:</label> <input type="text" id="n_ln" name="n_ln" value="<?php echo $nln; ?>" required=""/>
  </p>
  <p>
    <label for="n_fm">Famille:</label> <input type="text" id="n_fm" name="n_fm" value="<?php echo $nfm; ?>" required=""/>
  </p>
  <p>
    <img src="<?php
    if($img) echo "img/oiseaux/".strtolower($ord)."/".strtolower($nfm)."/".str_replace(' ', '_', $nln).".".$img;
    else echo "img/oiseaux/default.jpg"; ?>" />
    <p><label for="keep_img">Conserver l'image: </label><input type="checkbox" id="keep_img" name="keep_img" checked="checked" value="<?php echo $img; ?>" /></p>
  </p>
  <button type="submit">Envoyer</button>
  </form>
  <?php
    }
    else echo "L'oiseau n'existe pas dans la base de données.";
  }else{
?>
<form name="modification" method="post" action="" id="form_search">
  <input id="search" name="search" type="text" <?php if(isset($_POST['search']) && $_POST['search'] != "") echo 'hidden="true"'; ?> autocomplete="off" />
  <div id="results" onClick="this.form.submit();"></div>
<p>
</p>
</form>
<?php } } ?>

<script type="text/Javascript">
  
  (function() {
  var searchElement = document.getElementById('search'),
  results = document.getElementById('results'),
  selectedResult = -1, // Permet de savoir quel résultat estsélectionné : -1 signifie "aucune sélection"
  previousRequest, // On stocke notre précédente requête dans cette variable
  previousValue = searchElement.value; // On fait de même avec la précédente valeur
  function getResults(keywords, fam) { // Effectue une requête et récupère les résultats
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './pages/slam1_ajax.php?s='+encodeURIComponent(keywords)+'&fam='+encodeURIComponent(fam)+'&requete=3');
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
      displayResults(xhr.responseText);
      }
    };
    xhr.send(null);
    return xhr;
  }
  function displayResults(response) { // Affiche les résultats d'une requête
    results.style.display = response.length ? 'block' : 'none';
    // On cache le conteneur si on n'a pas de résultats
    if (response.length) { // On ne modifie les résultats quesi on en a obtenu
    response = response.split('|');
    var responseLen = response.length;
    results.innerHTML = ''; // On vide les résultats
    for (var i = 0, div ; i < responseLen ; i++) {
      div = results.appendChild(document.createElement('div'));
      div.innerHTML = response[i];
      div.onclick = function() {
        chooseResult(this);
        };
      }
    }
  }
  function chooseResult(result) { // Choisi un des résultats d'une requête et gère tout ce qui y est attaché
  searchElement.value = previousValue = result.innerHTML; // On change le contenu du champ de recherche et on enregistre en tant que précédente valeur
  results.style.display = 'none'; // On cache les résultats
  result.className = ''; // On supprime l'effet de focus
  selectedResult = -1; // On remet la sélection à "zéro"
  searchElement.focus(); // Si le résultat a été choisi par le biais d'un clique alors le focus est perdu, donc on le réattribue
  }
  searchElement.onkeyup = function(e) {
  var famille = document.forms["formulaire"].elements["famille"];
  var indexf = famille.selectedIndex;
  var fam = escape(famille.options[indexf].value);
  e = e || window.event; // On n'oublie pas la compatibilité pour IE
  var divs = results.getElementsByTagName('div');
  if (e.keyCode == 38 && selectedResult > -1) { // Si la touche pressée est la flèche "haut"
    divs[selectedResult--].className = '';
    if (selectedResult > -1) { // Cette condition évite une modification de childNodes[-1], qui n'existe pas, bien entendu
    divs[selectedResult].className = 'result_focus';
    }
  }
  else if (e.keyCode == 40 && selectedResult < divs.length - 1) { // Si la touche pressée est la flèche "bas"
  results.style.display = 'block'; // On affiche les résultats
  if (selectedResult > -1) { // Cette condition évite une modification de childNodes[-1], qui n'existe pas, bien entendu
  divs[selectedResult].className = '';
  }
  divs[++selectedResult].className = 'result_focus';
  }
  else if (e.keyCode == 13 && selectedResult > -1) { // Si la touche pressée est "Entrée"
  chooseResult(divs[selectedResult]);
  }
  else if (searchElement.value != previousValue) { // Si le contenu du champ de recherche a changé
  previousValue = searchElement.value;
  if (previousRequest && previousRequest.readyState < 4) {
  previousRequest.abort(); // Si on a toujours une requête en cours, on l'arrête
  }
  previousRequest = getResults(previousValue, fam); // Onstocke la nouvelle requête
  selectedResult = -1; // On remet la sélection à "zéro" à chaque caractère écrit
  }
  };
})();
</script>

<div id="loading"><div id="canvasloader-container"></div><span>Chargement en cours ...</span></div>
<script type="text/javascript">
var cl = new CanvasLoader('canvasloader-container');
cl.setColor('#333333'); // default is '#0099ff'
cl.setDiameter(25); // default is 40
cl.setDensity(50); // default is 40
cl.setRange(1); // default is 1.3
cl.setSpeed(1); // default is 2
cl.setFPS(60); // default is 24
cl.show(); // Hidden by default
</script>
<div id="result"></div>

</div>