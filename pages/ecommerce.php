<?php
include("locales/creations.php");
$page_titre="Ligue de paintball de Lorraine";
$page_desc = $langage['page_desc'][$lang];
include("pages/header.php");
include("pages/body.php");
 ?>
  <article id="creations">
    <div class="titre">Portfolio</div>
    <div class="cadre_titre"></div>
    <div class="texte details">
      <h1 class="portfolio_h1">Ligue de paintball de Lorraine</h1>
      <div class="container">
        <div class="portfolio-shadow curved"><img src="img/creations/ppe.jpg" alt="" /></div>
      </div>
      <p><a href="img/creations/ppe_full.jpg"><img src="img/creations/ppe_mini.jpg" alt="" /></a> Présentation de l’interface</p>
      <p class="competences">Compétences acquises :
      <br/>- Intégration de services
      <br/>- Répondre à des besoins précis
      <br/>- Élaboration d’un dossier de propositions
      <br/>- PHP, SQL, CSS3, AJAX
      </p>
      <p>Fonctionnalités implémentées :
      <br/>
      <!--
      <p>&#8226; La création de comptes utilisateurs, (vérification des données, enregistrement bdd, envoi de mail pour activation, activation)</p>
    <p>&#8226; La connexion au compte utilisateur (vérification pseudo/mdp, envoi de $_SESSION) et la déconnexion.</p>
    <p>&#8226; L'affichage de produits d'une catégorie, avec cookie mémorisant le nombre d'articles affichés par page (affichage dynamique en pages), récupération des données produits dans la bdd, tri par prix, catégories.</p>
    <p>&#8226; Gestion des équipes (affichage des équipes, puis du profil de l'équipe avec la liste des joueurs)</p>
    <p>&#8226; Envoi de message via un formulaire à un joueur d'une équipe. (En étant connecté à un compte)</p>
    <p>&#8226; Affichage des résultats sur la page d'accueil, avec mise en évidence du vainqueur et du perdant, plus affichage des scores.</p>
    <p>&#8226; Affichage des news: apperçu à l'accueil, présentation sur plusieurs pages sur la page des news.</p>
    <p>&#8226; Ajout de produits, avec choix de quantité dans le panier (cookie id/nb produits), vérification de la quantité commandée en stock, signature numérique du panier pour éviter les ajouts multiples.</p>
    <p>&#8226; Fonctions vider panier, et valider le panier (Vérification des données de livraison, paiement en ligne non-sécurisé pour cette version factice.).</p>
    <p>&#8226; Page de contact de la LPL via un formulaire.</p>-->

    
    <p>&#8226; Enregistrement des utilisateurs, récupération des mots de passe, modification du profil</p>
    <p>&#8226; Connexion spéciale pour les représentants, pour passer commande au nom des clients, appliquer des réductions, consulter le planning généré par les demandes clients</p>
    <p>&#8226; Affichage des produits en plsieurs catégories, recherche</p>
    <p>&#8226; Gestion hors connexion du panier, modification des quantités, enregistrement des commandes, paiement (non-sécurisé sur cette version factice)</p>
    <p>&#8226; Prise en charge de plusieurs fournisseurs pour chaque produit, avec mise à jour utilisant AJAX pour la mise à jour des informations</p>
    </p>
      <p>Temps de développement nécessaire : deux mois.</p>

      <p>Maquettes de l’interface réalisées sur papier</p>

      <p class="portfolio_files">
        <a href="files/paintball/dossier_projet.pdf" target="_blank">
          <img src="img/fichiers/pdf_mini.png" alt="" align="middle"/>Dossier du projet
        </a>
        </p>
      <p><a href="http://www.paintball-lorraine.theochevalier.fr/">Serveur de test</a></p>
      <p><a href="https://github.com/TheoChevalier/projet_bts">Dépôt Github du code source</a></p>
</article>
